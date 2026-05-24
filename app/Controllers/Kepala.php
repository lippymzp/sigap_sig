<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Kepala extends Controller
{

    private function getDashboardLayout()
        {
            // Mengambil id_jabatan dari session login petugas
            $id_jabatan = session()->get('id_jabatan');

            // Melakukan mapping layout berdasarkan id_jabatan dari tabel petugas/jabatan
            switch ($id_jabatan) {
                case 1:
                    return 'layout/dashboard_layout_kepala';   // id_jabatan 1 -> Admin
                case 2:
                    return 'layout/dashboard_layout_kader';   // id_jabatan 2 -> Kader
                case 3:
                    return 'layout/dashboard_layout_admin';  // id_jabatan 3 -> Kepala
                default:
                    // Fallback jika id_jabatan berupa superadmin (4) atau belum login
                    return 'layout/dashboard_layout_admin'; 
            }
    }

    public function dashboard()
    {
        $db = \Config\Database::connect();

        // Tetap pertahankan session internal Kepala Puskesmas
        $id_petugas = session()->get('id_petugas');
        $id_penyakit = 1; // Difokuskan untuk indikator dan data DBD

        // ==========================================
        // 1. TANGKAP PARAMETER FILTER (DASHBOARD & PETA)
        // ==========================================
        $wilayah   = $this->request->getGet('wilayah');
        $bulan     = $this->request->getGet('bulan');
        $tahun     = $this->request->getGet('tahun');
        $usia      = $this->request->getGet('usia');
        $jk        = $this->request->getGet('jk');
        
        $bulanMap  = $this->request->getGet('bulan_map');
        $tahunMap  = $this->request->getGet('tahun_map');
        

        // Default tahun jika kosong
        if (empty($tahunMap)) {
            $tahunMap = date('Y');
        }

        // ==========================================
        // 2. QUERY UTAMA: DATA PETA & DETAIL DESA (TERFILTER)
        // ==========================================
        $builderMape = $db->table('wilayah w');

        $penyakitFilter = "AND p.id_penyakit = 1";
        $bulanMapFilter = !empty($bulanMap) ? "AND MONTH(p.tgl_kunjungan) = " . $db->escape($bulanMap) : "";
        $tahunMapFilter = !empty($tahunMap) ? "AND YEAR(p.tgl_kunjungan) = " . $db->escape($tahunMap) : "";
        
        $jkFilter = "";
        if (!empty($jk)) {
            $gender   = ($jk == 'L') ? 'Laki-laki' : 'Perempuan';
            $jkFilter = "AND p.jenis_kelamin = " . $db->escape($gender);
        }

        $usiaFilter = "";
        if (!empty($usia)) {
            if ($usia == 'anak') $usiaFilter = "AND p.umur BETWEEN 0 AND 6";
            elseif ($usia == 'remaja') $usiaFilter = "AND p.umur BETWEEN 7 AND 18";
            elseif ($usia == 'dewasa') $usiaFilter = "AND p.umur BETWEEN 19 AND 59";
            elseif ($usia == 'lansia') $usiaFilter = "AND p.umur >= 60";
        }

        $allFilters = "$penyakitFilter $bulanMapFilter $tahunMapFilter $jkFilter $usiaFilter";

        $builderMape->select("
            w.kelurahan as desa,
            COUNT(DISTINCT CASE WHEN p.id_pasien IS NOT NULL $allFilters THEN p.id_pasien END) as kasus,
            COUNT(DISTINCT CASE WHEN p.jenis_kelamin = 'Laki-laki' $allFilters THEN p.id_pasien END) as laki,
            COUNT(DISTINCT CASE WHEN p.jenis_kelamin = 'Perempuan' $allFilters THEN p.id_pasien END) as perempuan,
            
            COUNT(DISTINCT CASE WHEN p.umur BETWEEN 0 AND 6 $allFilters THEN p.id_pasien END) as anak,
            COUNT(DISTINCT CASE WHEN p.umur BETWEEN 7 AND 18 $allFilters THEN p.id_pasien END) as remaja,
            COUNT(DISTINCT CASE WHEN p.umur BETWEEN 19 AND 59 $allFilters THEN p.id_pasien END) as dewasa,
            COUNT(DISTINCT CASE WHEN p.umur >= 60 $allFilters THEN p.id_pasien END) as lansia,
            
            COUNT(DISTINCT CASE WHEN p.status_akhir = 'Sembuh' $allFilters THEN p.id_pasien END) as sembuh,
            COUNT(DISTINCT CASE WHEN p.status_akhir = 'Meninggal' $allFilters THEN p.id_pasien END) as meninggal,
            
            COALESCE(dp.total_penduduk, 0) as jumlah_penduduk
        ");

        $builderMape->join('pasien p', 'p.id_wilayah = w.id_wilayah', 'left');

        // Subquery jumlah penduduk khusus id_penyakit = 1
        $subQueryPenduduk = $db->table('data_penduduk')
            ->select('kelurahan, SUM(total_penduduk) as total_penduduk')
            ->where('id_penyakit', 1)
            ->groupBy('kelurahan')
            ->getCompiledSelect();
        $builderMape->join("($subQueryPenduduk) dp", 'LOWER(REPLACE(dp.kelurahan, " ", "")) = LOWER(REPLACE(w.kelurahan, " ", ""))', 'left');

        $builderMape->whereIn('w.kelurahan', ['Sumbersari', 'Wirolegi', 'Antirogo', 'Tegal Gede', 'Karangrejo']);
        $builderMape->groupBy('w.kelurahan, dp.total_penduduk');
        $dbdData = $builderMape->get()->getResultArray();

        // ==========================================
        // 3. PROSES DATA DETAIL DESA & INTEGRASI ABJ KADER
        // ==========================================
        $detailDesa = [];
        $list_kelurahan = ['Sumbersari', 'Wirolegi', 'Antirogo', 'Tegal Gede', 'Karangrejo'];

        // Mapping Nama Bulan Angka ke String untuk ABJ
        $bulanMapString = '';
        if (!empty($bulanMap)) {
            $namaBulanArray = [
                1=>'Januari', 2=>'Februari', 3=>'Maret', 4=>'April', 5=>'Mei', 6=>'Juni',
                7=>'Juli', 8=>'Agustus', 9=>'September', 10=>'Oktober', 11=>'November', 12=>'Desember'
            ];
            $bulanMapString = $namaBulanArray[$bulanMap] ?? '';
        }

        foreach ($dbdData as $row) {
            $namaKel = $row['desa'];
            $key = preg_replace('/[^a-z0-9]/', '', strtolower($namaKel));

            // Ambil Angka Bebas Jentik (ABJ) per kelurahan secara spesifik
            $builderABJ = $db->table('rekap_pelaporan_kader')
                ->select('AVG(abj) as avg_abj, SUM(diperiksa) as rumah_diperiksa, SUM(positif) as rumah_jentik')
                ->where("LOWER(REGEXP_REPLACE(kelurahan, '[^a-zA-Z0-9]', ''))", $key);

            if (!empty($tahunMap)) {
                $builderABJ->like('periode_lengkap', $tahunMap);
            }
            if (!empty($bulanMapString)) {
                $builderABJ->where('bulan', $bulanMapString);
            }

            $resABJ = $builderABJ->get()->getRow();
            $avg_abj = $resABJ->avg_abj ?? 0;
            $rmh_periksa = $resABJ->rumah_diperiksa ?? 0;
            $rmh_jentik = $resABJ->rumah_jentik ?? 0;

            // Hitung Rentang Usia Tertinggi
            $usiaData = [
                'Bayi dan Anak Pra-sekolah (0–6 Tahun)' => (int)$row['anak'],
                'Anak Sekolah dan Remaja (>6–18 Tahun)' => (int)$row['remaja'],
                'Dewasa (>18–59 Tahun)'                 => (int)$row['dewasa'],
                'Lansia (≥60 Tahun)'                    => (int)$row['lansia'],
            ];
            arsort($usiaData);
            $usiaTertinggi = ($row['kasus'] > 0) ? array_key_first($usiaData) : '-';

            $detailDesa[$key] = [
                'jumlah_penduduk' => (int)$row['jumlah_penduduk'],
                'jumlah_kasus'    => (int)$row['kasus'],
                'sembuh'          => (int)$row['sembuh'],
                'meninggal'       => (int)$row['meninggal'],
                'anak'            => (int)$row['anak'],
                'remaja'          => (int)$row['remaja'],
                'dewasa'          => (int)$row['dewasa'],
                'lansia'          => (int)$row['lansia'],
                'laki'            => (int)$row['laki'],
                'perempuan'       => (int)$row['perempuan'],
                'usia_tertinggi'  => $usiaTertinggi,
                'abj'             => round($avg_abj, 2),
                'rumah_diperiksa' => (int)$rmh_periksa,
                'rumah_jentik'    => (int)$rmh_jentik
            ];
        }

        // Tentukan desa tertinggi kasusnya
        $desa_tertinggi = '-';
        if (!empty($dbdData)) {
            $tempDbd = $dbdData;
            usort($tempDbd, function($a, $b) {
                return $b['kasus'] <=> $a['kasus'];
            });
            $desa_tertinggi = ($tempDbd[0]['kasus'] > 0) ? $tempDbd[0]['desa'] : '-';
        }

        // ==========================================
        // 4. DATA GRAFIK KASUS (DENGAN FILTER MULTI-OPSI)
        // ==========================================
        $builderGrafik = $db->table('wilayah w');
        $builderGrafik->select("
            w.kelurahan as wilayah,
            COUNT(DISTINCT CASE WHEN p.umur BETWEEN 0 AND 6 AND p.id_penyakit = 1 THEN p.id_pasien END) as anak,
            COUNT(DISTINCT CASE WHEN p.umur BETWEEN 7 AND 18 AND p.id_penyakit = 1 THEN p.id_pasien END) as remaja,
            COUNT(DISTINCT CASE WHEN p.umur BETWEEN 19 AND 59 AND p.id_penyakit = 1 THEN p.id_pasien END) as dewasa,
            COUNT(DISTINCT CASE WHEN p.umur >= 60 AND p.id_penyakit = 1 THEN p.id_pasien END) as lansia
        ");
        $builderGrafik->join('pasien p', 'p.id_wilayah = w.id_wilayah', 'left');
        $builderGrafik->whereIn('w.kelurahan', ['Sumbersari', 'Wirolegi', 'Antirogo', 'Tegal Gede', 'Karangrejo']);

        if (!empty($bulan)) $builderGrafik->where('MONTH(p.tgl_kunjungan)', $bulan);
        if (!empty($tahun)) $builderGrafik->where('YEAR(p.tgl_kunjungan)', $tahun);
        if (!empty($jk)) $builderGrafik->where('p.jenis_kelamin', $jk == 'L' ? 'Laki-laki' : 'Perempuan');
        if (!empty($usia)) {
    if ($usia == 'anak')         $builderGrafik->where('p.umur >=', 0)->where('p.umur <=', 6);
    elseif ($usia == 'remaja')   $builderGrafik->where('p.umur >=', 7)->where('p.umur <=', 18);
    elseif ($usia == 'dewasa')   $builderGrafik->where('p.umur >=', 19)->where('p.umur <=', 59);
    elseif ($usia == 'lansia')   $builderGrafik->where('p.umur >=', 60);
}
        
        if (!empty($wilayah)) {
            $namaWilayah = ($wilayah === 'Tegalgede') ? 'Tegal Gede' : $wilayah;
            $builderGrafik->where('w.kelurahan', $namaWilayah);
        }

        $builderGrafik->groupBy('w.kelurahan');
        $grafikDataMapped = $builderGrafik->get()->getResultArray();

        // Ambil data tabel Master Penduduk untuk Modal Penduduk di Halaman Kepala
        $pendudukData = $db->table('data_penduduk')
            ->where('id_penyakit', 1)
            ->get()
            ->getResultArray();
// ==========================================
// 4b. DATA GRAFIK MORTALITAS PER BULAN (BARU)
// ==========================================
$builderMort = $db->table('wilayah w');
$builderMort->select("
    MONTH(p.tgl_kunjungan) as bulan_angka,
    w.kelurahan as wilayah,
    COUNT(DISTINCT CASE WHEN p.status_akhir = 'Meninggal' AND p.id_penyakit = 1 THEN p.id_pasien END) as meninggal
");
$builderMort->join('pasien p', 'p.id_wilayah = w.id_wilayah', 'left');
$builderMort->whereIn('w.kelurahan', ['Sumbersari', 'Wirolegi', 'Antirogo', 'Tegal Gede', 'Karangrejo']);
$builderMort->where('p.id_penyakit', 1);

if (!empty($this->request->getGet('tahun_mort'))) {
    $builderMort->where('YEAR(p.tgl_kunjungan)', $this->request->getGet('tahun_mort'));
}
if (!empty($this->request->getGet('jk_mort'))) {
    $jkMort = $this->request->getGet('jk_mort') == 'L' ? 'Laki-laki' : 'Perempuan';
    $builderMort->where('p.jenis_kelamin', $jkMort);
}
if (!empty($this->request->getGet('wilayah_mort'))) {
    $namaWilMort = ($this->request->getGet('wilayah_mort') === 'Tegalgede') ? 'Tegal Gede' : $this->request->getGet('wilayah_mort');
    $builderMort->where('w.kelurahan', $namaWilMort);
}

$builderMort->groupBy('MONTH(p.tgl_kunjungan), w.kelurahan');
$builderMort->orderBy('MONTH(p.tgl_kunjungan)', 'ASC');
$grafikMortalitas = $builderMort->get()->getResultArray();
// ==========================================
// 4c. DATA GRAFIK ABJ PER WILAYAH (DENGAN FILTER ABJ)
// ==========================================
$wilayahAbj = $this->request->getGet('wilayah_abj');
$bulanAbj   = $this->request->getGet('bulan_abj');
$tahunAbj   = $this->request->getGet('tahun_abj');

$listKelurahanAbj = ['Sumbersari', 'Wirolegi', 'Antirogo', 'Tegal Gede', 'Karangrejo'];
if (!empty($wilayahAbj)) {
    $namaWilAbj = ($wilayahAbj === 'Tegalgede') ? 'Tegal Gede' : $wilayahAbj;
    $listKelurahanAbj = [$namaWilAbj];
}

$bulanAbjString = '';
if (!empty($bulanAbj)) {
    $namaBulanArrayAbj = [
        1=>'Januari', 2=>'Februari', 3=>'Maret', 4=>'April', 5=>'Mei', 6=>'Juni',
        7=>'Juli', 8=>'Agustus', 9=>'September', 10=>'Oktober', 11=>'November', 12=>'Desember'
    ];
    $bulanAbjString = $namaBulanArrayAbj[$bulanAbj] ?? '';
}

$grafikAbj = [];
foreach ($listKelurahanAbj as $namaKelAbj) {
    $keyAbj = preg_replace('/[^a-z0-9]/', '', strtolower($namaKelAbj));

    $builderAbjGrafik = $db->table('rekap_pelaporan_kader')
        ->select('AVG(abj) as avg_abj')
        ->where("LOWER(REGEXP_REPLACE(kelurahan, '[^a-zA-Z0-9]', ''))", $keyAbj);

    if (!empty($tahunAbj)) {
        $builderAbjGrafik->like('periode_lengkap', $tahunAbj);
    }
    if (!empty($bulanAbjString)) {
        $builderAbjGrafik->where('bulan', $bulanAbjString);
    }

    $resAbjGrafik = $builderAbjGrafik->get()->getRow();
    $grafikAbj[] = [
        'wilayah' => $namaKelAbj,
        'abj'     => round($resAbjGrafik->avg_abj ?? 0, 2)
    ];
}
        // ==========================================
        // 5. KIRIM DATA KE LAYOUT VIEW KEPALA
        // ==========================================
        return view('gol_a/dashboard_kepala', [
            'menu'           => 'dashboard_kepala', // Menyesuaikan menu active sidebar kepala
            'judul'          => 'Dashboard Kepala Puskesmas',
            'grafik'         => $grafikDataMapped,
            'dbd'            => $dbdData,
            'detailDesa'     => $detailDesa,
            'desaTertinggi'  => $desa_tertinggi,
            'penduduk'       => $pendudukData,
            'grafikMortalitas' => $grafikMortalitas,
            'grafikAbj'        => $grafikAbj,
             'show_footer_maskot' => true,
            'footer_maskot' => 'logodenggisputih.png'
        ]);
        
    }
    public function export()
    {
        $data = [
            'menu' => 'export',
            'judul' => 'Export Data'
        ];

        return view('gol_a/export_kepala', $data);
    }
    public function peta_sebaran()
    {
        return view('gol_a/peta_sebaran_kepala', [
            'menu' => 'peta_sebaran'
        ]);
    }
    public function detail_peta()
    {
        return view('gol_a/detail_peta');
    }

    public function rekap_kader()
    {
        $db = \Config\Database::connect();

        // 1. Ambil Filter dari URL
        $bulan = $this->request->getGet('bulan') ?: date('F');
        $tahun = $this->request->getGet('tahun') ?: date('Y');
        $kelurahan = $this->request->getGet('kelurahan');

        // 2. Query Rekap Data per Posyandu
        $builder = $db->table('pelaporan_kader p');
        $builder->select('nama_posyandu, kelurahan, SUM(jml_rumah_diperiksa) as total_diperiksa, SUM(jml_rumah_bebas) as total_bebas');

        if ($kelurahan) {
            $builder->where('p.kelurahan', $kelurahan);
        }

        $builder->where('p.bulan', $bulan);
        $builder->where('p.tahun', $tahun);
        $builder->groupBy('p.nama_posyandu');

        $rekapData = $builder->get()->getResultArray();

        // 3. Kirim ke View
        $data = [
            'title'      => 'Rekap Pelaporan Kader',
            'rekap'      => $rekapData,
            'bulanAktif' => $bulan,
            'tahunAktif' => $tahun
        ];

        return view('gol_a/rekap_kader', $data);
    }

    public function daftar_laporan()
    {
         $layout_dinamis = $this->getDashboardLayout();
        $model = new \App\Models\PelaporanModel();

        // 1. Tangkap semua input filter dari URL (GET)
        $bulanNama = $this->request->getGet('bulan') ?: 'Mei'; // Default Mei jika kosong
        $tahun     = $this->request->getGet('tahun') ?: date('Y');
        $filterKelurahan = $this->request->getGet('kelurahan');
        $filterPosyandu  = $this->request->getGet('posyandu');

        // 2. Logika Penentuan Daftar Catleya (Sesuai Filter)
        $listCatleya = [];

        // Data mapping Kelurahan ke Posyandu (Sama dengan yang ada di JS View)
        $dataMapping = [
            'Sumbersari' => ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31', '32', '33', '34', '35'],
            'Wirolegi'   => ['36', '36A', '37', '38', '39', '40', '41', '42', '43', '44', '44A', '45', '46', '47', '48', '49', '50', '51', '52', '53', '54'],
            'Karangrejo' => ['75', '76', '77', '78', '78A', '79', '80', '81', '82', '83', '84', '85', '86', '87', '88', '88A', '89', '90', '91', '92', '92A', '93', '94', '95', '95A', '95B'],
            'Tegal Gede'  => ['68', '69', '70', '71', '72', '73', '74', '74A', '74B'],
            'Antirogo'   => ['55', '56', '57', '58', '58A', '59', '60', '61', '62', '63', '64', '65', '65A', '66', '67']
        ];

        if (!empty($filterPosyandu)) {
            // A. JIKA POSYANDU DIPILIH: Hanya tampilkan 1 kolom posyandu tersebut
            // Kita bersihkan string "Catleya " jika ada, agar sesuai dengan ID di DB
            $cleanId = str_replace('Catleya ', '', $filterPosyandu);
            $cleanId = str_replace(' ', '', $cleanId);
            $listCatleya = [$cleanId];
        } elseif (!empty($filterKelurahan) && isset($dataMapping[$filterKelurahan])) {
            // B. JIKA HANYA KELURAHAN DIPILIH: Tampilkan semua posyandu di kelurahan itu
            $listCatleya = $dataMapping[$filterKelurahan];
        } else {
            // C. JIKA TIDAK ADA FILTER: Tampilkan semua (105 Catleya)
            for ($i = 1; $i <= 95; $i++) {
                $listCatleya[] = (string)$i;
            }
            $bayangan = ['36A', '44A', '58A', '65A', '74A', '74B', '78A', '88A', '92A', '95A', '95B'];
            $listCatleya = array_unique(array_merge($listCatleya, $bayangan));
            sort($listCatleya, SORT_NATURAL); // Urutkan biar rapi
        }

        // 3. Logika Mencari Hari Jumat (Tetap seperti sebelumnya)
        $bulanAngka = ['Januari' => 1, 'Februari' => 2, 'Maret' => 3, 'April' => 4, 'Mei' => 5, 'Juni' => 6, 'Juli' => 7, 'Agustus' => 8, 'September' => 9, 'Oktober' => 10, 'November' => 11, 'Desember' => 12];
        $m = $bulanAngka[$bulanNama] ?? date('n');
        $jmlHari = cal_days_in_month(CAL_GREGORIAN, $m, $tahun);

        $listMinggu = [];
        $mingguKe = 1;
        for ($d = 1; $d <= $jmlHari; $d++) {
            $dateStr = sprintf('%04d-%02d-%02d', $tahun, $m, $d);
            if (date('N', strtotime($dateStr)) == 5) {
                $listMinggu[] = "Minggu ke-" . $mingguKe;
                $mingguKe++;
            }
        }


        // 4. Ambil Data Laporan dari DB (Menggunakan YEAR(created_at))
        $laporanDb = $model->where('bulan', $bulanNama)
            ->where('YEAR(created_at)', $tahun, false)
            ->orderBy('id_laporan', 'DESC')
            ->findAll();

        $dataLaporan = [];
        foreach ($laporanDb as $row) {
            $mingguKey = trim((string) ($row['minggu'] ?? ''));
            $posKey    = trim((string) ($row['id_posyandu'] ?? ''));
            $idLaporan = (int) ($row['id_laporan'] ?? 0);

            if ($mingguKey === '' || $posKey === '' || $idLaporan <= 0) {
                continue;
            }

            $posNorm = $posKey;
            if (ctype_digit($posKey)) {
                $posNorm = ltrim($posKey, '0');
                $posNorm = $posNorm === '' ? '0' : $posNorm;
            }
            $posPad = ctype_digit($posNorm) ? str_pad($posNorm, 2, '0', STR_PAD_LEFT) : $posNorm;

            if (
                !isset($dataLaporan[$mingguKey][$posKey]) &&
                !isset($dataLaporan[$mingguKey][$posNorm]) &&
                !isset($dataLaporan[$mingguKey][$posPad])
            ) {
                $dataLaporan[$mingguKey][$posKey]  = $idLaporan;
                $dataLaporan[$mingguKey][$posNorm] = $idLaporan;
                $dataLaporan[$mingguKey][$posPad]  = $idLaporan;
            }
        }

        // 5. Kirim ke View
        $data = [
             'layout'      => $layout_dinamis, 
            'title'       => 'Pelaporan Kader',
            'judul'       => 'Pelaporan Kader', 
            'menu'        => 'pelaporan_kader',
            'bulanAktif'  => $bulanNama,
            'tahunAktif'  => $tahun,
            'listMinggu'  => $listMinggu,
            'listCatleya' => $listCatleya,
            'dataLaporan' => $dataLaporan
        ];

        return view('gol_a/daftar_laporan', $data);
    }

    public function pelaporan_kader()
    {
         $layout_dinamis = $this->getDashboardLayout();
        $model = new \App\Models\PelaporanModel();

        // Ambil parameter GET
        $search     = $this->request->getGet('search');
        $kelurahan  = $this->request->getGet('kelurahan');
        $posyandu   = $this->request->getGet('posyandu');
        $bulan      = $this->request->getGet('bulan');
        $tahun      = $this->request->getGet('tahun') ?: date('Y'); // Tangkap tahun

        $builder = $model;

        // FILTER TAHUN (Solusi Error)
        $builder = $builder->where('YEAR(created_at)', $tahun, false);

        // SEARCH
        if (!empty($search)) {
            $builder = $builder->groupStart()
                ->like('bulan', $search)
                ->orLike('minggu', $search)
                ->orLike('id_posyandu', $search)
                ->groupEnd();
        }

        // FILTER KELURAHAN
        $mapKelurahan = [
            'Antirogo'   => 1,
            'Karangrejo' => 2,
            'Sumbersari' => 3,
            'Tegal Gede'  => 4,
            'Wirolegi'   => 5,
        ];

        if (!empty($kelurahan) && isset($mapKelurahan[$kelurahan])) {
            $builder = $builder->where('id_kelurahan', $mapKelurahan[$kelurahan]);
        }

        // FILTER POSYANDU
        if (!empty($posyandu)) {
            $cleanPosyandu = str_replace('Catleya ', '', $posyandu);
            $builder = $builder->where('id_posyandu', $cleanPosyandu);
        }

        // FILTER BULAN
        if (!empty($bulan)) {
            $builder = $builder->where('bulan', $bulan);
        }

        $data = [
             'layout'      => $layout_dinamis, 
            'title'      => 'Pelaporan Kader',
            'judul'      => 'Pelaporan Kader',
            'menu'       => 'pelaporan_kader',
            'pelaporan'  => $builder->orderBy('id_laporan', 'DESC')->findAll()
        ];

        return view('gol_a/rekap_kader', $data);
    }


    public function view_laporan($id)
    {
         $layout_dinamis = $this->getDashboardLayout();
        $db = \Config\Database::connect();

        // Ambil data detail laporan berdasarkan ID
        $laporan = $db->table('rekap_pelaporan_kader')
            ->where('id_laporan', $id)
            ->get()
            ->getRowArray();

        if (!$laporan) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        $data = [
             'layout'      => $layout_dinamis, 
            'title'   => 'Pratinjau Hasil Pemeriksaan',
            'judul'   => 'Pelaporan Kader',
            'laporan' => $laporan,
            'menu'    => 'pelaporan_kader'
        ];

        return view('gol_a/view_laporan', $data);
    }
    


    public function rekap_skrining()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('skrining as s');

        $builder->select('
            s.id_skrining,
            p.nik,
            p.no_hp,
            p.tanggal_lahir,
            p.nama_pasien_skrining,
            p.jenis_kelamin,
            p.usia,
            w.provinsi,
            w.kabupaten,
            w.kecamatan,
            w.kelurahan,
            w.rt,
            w.rw,
            s.hasil,
            s.tanggal
        ');

        $builder->join('pasien_skrining p', 'p.id_pasien_skrining = s.id_pasien_skrining');
        $builder->join('wilayah w', 'w.id_wilayah = p.id_wilayah');

        // kalau mau khusus dbd
        $builder->where('s.id_penyakit', 1);

        // =========================
        // AMBIL PARAMETER
        // =========================
        $search = $this->request->getGet('search');
        $sort   = $this->request->getGet('sort');
        $filter = $this->request->getGet('filter');

        // =========================
        // SEARCH
        // =========================
        if (!empty($search)) {

            $builder->groupStart()
                    ->like('p.nama_pasien_skrining', $search)
                    ->orLike('p.nik', $search)
                    ->groupEnd();
        }

        // =========================
        // FILTER
        // =========================
        if (!empty($filter) && is_array($filter)) {

            // hari ini
            if (in_array('hariini', $filter)) {
                $builder->where('s.tanggal', date('Y-m-d'));
            }

            // hasil
            $hasilFilter = [];

            if (in_array('baik', $filter)) {
                $hasilFilter[] = 'Kategori Lingkungan Baik';
            }

            if (in_array('cukup', $filter)) {
                $hasilFilter[] = 'Kategori Lingkungan Cukup';
            }

            if (in_array('buruk', $filter)) {
                $hasilFilter[] = 'Kategori Lingkungan Buruk';
            }

            if (!empty($hasilFilter)) {
                $builder->whereIn('s.hasil', $hasilFilter);
            }

            // gender
            $jkFilter = [];

            if (in_array('lakilaki', $filter)) {
                $jkFilter[] = 'Laki-laki';
            }

            if (in_array('perempuan', $filter)) {
                $jkFilter[] = 'Perempuan';
            }

            if (!empty($jkFilter)) {
                $builder->whereIn('p.jenis_kelamin', $jkFilter);
            }

            // =========================
            // FILTER USIA
            // =========================
            $usiaDipilih = [];

            if (in_array('bayi_anak', $filter)) {
                $usiaDipilih[] = ['min' => 0, 'max' => 6];
            }

            if (in_array('remaja', $filter)) {
                $usiaDipilih[] = ['min' => 7, 'max' => 18];
            }

            if (in_array('dewasa', $filter)) {
                $usiaDipilih[] = ['min' => 19, 'max' => 59];
            }

            if (in_array('lansia', $filter)) {
                $usiaDipilih[] = ['min' => 60, 'max' => null];
            }

            if (!empty($usiaDipilih)) {

                $builder->groupStart();

                foreach ($usiaDipilih as $u) {

                    if ($u['max'] !== null) {

                        $builder->orGroupStart()
                                ->where('p.usia >=', $u['min'])
                                ->where('p.usia <=', $u['max'])
                                ->groupEnd();

                    } else {

                        $builder->orGroupStart()
                                ->where('p.usia >=', $u['min'])
                                ->groupEnd();
                    }
                }

                $builder->groupEnd();
            }
        }

        // =========================
        // SORTING
        // =========================
        if ($sort === 'asc') {

            $builder->orderBy('p.nama_pasien_skrining', 'ASC');

        } elseif ($sort === 'desc') {

            $builder->orderBy('p.nama_pasien_skrining', 'DESC');

        } else {

            $builder->orderBy('s.id_skrining', 'DESC');
        }

        // =========================
        // PAGINATION
        // =========================
        $perPage = 10;
        $page = $this->request->getVar('page') ?? 1;

        $totalBuilder = clone $builder;
        $total = $totalBuilder->countAllResults(false);

        $skrining = $builder
            ->limit($perPage, ($page - 1) * $perPage)
            ->get()
            ->getResultArray();

        $pager = \Config\Services::pager();

        $data = [
            'menu' => 'rekap_skrining_kepala',
            'judul' => 'Rekap Skrining',
            'skrining' => $skrining,
            'pagerLinks' => $pager->makeLinks($page, $perPage, $total),
            'page' => $page,
            // mempertahankan value input
            'current_search' => $search,
            'current_sort' => $sort,
            'current_filter' => $filter ?? []
        ];

        return view('gol_a/rekap_skrining_kepala', $data);
    }
    }