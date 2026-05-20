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
        $db = \Config\Database::connect(); // 🔥 WAJIB

      // ======================
        // 🔥 DATA GRAFIK
        // ======================
        $wilayah = $this->request->getGet('wilayah'); // <-- TAMBAHAN UNTUK MENANGKAP WILAYAH
        $bulan   = $this->request->getGet('bulan');
        $tahun   = $this->request->getGet('tahun');
        $usia    = $this->request->getGet('usia');
        $jk      = $this->request->getGet('jk');

       $builderGrafik = $db->table('wilayah w');

$builderGrafik->select("
    w.kelurahan as wilayah,
    COUNT(DISTINCT CASE WHEN p.umur BETWEEN 0 AND 6 THEN p.id_pasien END) as anak,
    COUNT(DISTINCT CASE WHEN p.umur BETWEEN 7 AND 18 THEN p.id_pasien END) as remaja,
    COUNT(DISTINCT CASE WHEN p.umur BETWEEN 19 AND 59 THEN p.id_pasien END) as dewasa,
    COUNT(DISTINCT CASE WHEN p.umur >= 60 THEN p.id_pasien END) as lansia
");
$builderGrafik->join(
    'pasien p',
    'p.id_wilayah = w.id_wilayah AND p.id_penyakit = 1',
    'left'
);

if (!empty($bulan)) {
    $builderGrafik->where('MONTH(p.tgl_kunjungan)', $bulan);
}
if (!empty($tahun)) {
    $builderGrafik->where('YEAR(p.tgl_kunjungan)', $tahun);
}
if (!empty($jk)) {
    $builderGrafik->where('p.jenis_kelamin', ($jk == 'L' ? 'Laki-laki' : 'Perempuan'));
}
if (!empty($usia)) {
    if ($usia == 'anak') {
        $builderGrafik->where('p.umur BETWEEN 0 AND 6');
    } elseif ($usia == 'remaja') {
        $builderGrafik->where('p.umur BETWEEN 7 AND 18');
    } elseif ($usia == 'dewasa') {
        $builderGrafik->where('p.umur BETWEEN 19 AND 59');
    } elseif ($usia == 'lansia') {
        $builderGrafik->where('p.umur >=', 60);
    }
}
if (!empty($wilayah)) {
    $namaWilayah = ($wilayah === 'Tegalgede') ? 'Tegal Gede' : $wilayah;
    $builderGrafik->where('w.kelurahan', $namaWilayah);
} else {
    $builderGrafik->whereIn('w.kelurahan', ['Sumbersari', 'Wirolegi', 'Antirogo', 'Tegal Gede', 'Karangrejo']);
}

$builderGrafik->groupBy('w.kelurahan');
$grafik = $builderGrafik->get()->getResultArray();

        // ======================
        // 🔥 DATA PETA
        // ======================
        $tahunMap = $this->request->getGet('tahun_map');

        $builderDbd = $db->table('pasien p');
        $builderDbd->select('w.kelurahan as desa, COUNT(DISTINCT p.id_pasien) as kasus');
        $builderDbd->join(
    'wilayah w',
    'w.id_wilayah = p.id_wilayah',
    'left'
);
        $builderDbd->where('p.id_penyakit', 1);

        // 🔥 FILTER HARUS DI SINI (SEBELUM get)
        if (!empty($tahunMap)) {
            $builderDbd->where('YEAR(p.tgl_kunjungan)', $tahunMap);
        }

        $builderDbd->groupBy('w.kelurahan');

        // 🔥 BARU AMBIL DATA
        $dbd = $builderDbd->get()->getResultArray();
        // ======================
        // 🔥 DETAIL DATA MODAL
        // ======================
 $builderDetail = $db->table('pasien p');

$builderDetail->select("
    w.kelurahan,
    COUNT(*) as jumlah_kasus,
    SUM(CASE WHEN p.umur <= 14 THEN 1 ELSE 0 END) as anak,
    SUM(CASE WHEN p.umur BETWEEN 15 AND 59 THEN 1 ELSE 0 END) as dewasa,
    SUM(CASE WHEN p.umur >= 60 THEN 1 ELSE 0 END) as lansia,
    SUM(CASE WHEN p.jenis_kelamin = 'Laki-laki' THEN 1 ELSE 0 END) as laki,
    SUM(CASE WHEN p.jenis_kelamin = 'Perempuan' THEN 1 ELSE 0 END) as perempuan,
    SUM(r.diperiksa) as rumah_diperiksa,
    SUM(r.positif) as rumah_positif,
    SUM(CASE WHEN p.status_akhir = 'Sembuh' THEN 1 ELSE 0 END) as sembuh,
    SUM(CASE WHEN p.status_akhir = 'Meninggal' THEN 1 ELSE 0 END) as meninggal,
");

$builderDetail->join('wilayah w', 'w.id_wilayah = p.id_wilayah', 'left');
$builderDetail->join(
    'rekap_pelaporan_kader r',
    'r.kelurahan = w.kelurahan',
    'left'
);
$builderDetail->where('p.id_penyakit', 1);

        if (!empty($tahunMap)) {
            $builderDetail->where('YEAR(p.tgl_kunjungan)', $tahunMap);
        }

        $builderDetail->groupBy('w.kelurahan');

        $rawDetail = $builderDetail->get()->getResultArray();

        $detailDesa = [];
        $maxKasus = 0;
        $desaTertinggi = '-';
        $penduduk = [];

        foreach ($rawDetail as $row) {

            $jumlahKasus = (int)$row['jumlah_kasus'];

            if ($jumlahKasus >= 20) {
                $kategori = 'tinggi';
            } elseif ($jumlahKasus >= 10) {
                $kategori = 'sedang';
            } else {
                $kategori = 'rendah';
            }

            // usia tertinggi
            $usiaTertinggi = 'Anak-anak';

            if (
                $row['dewasa'] >= $row['anak'] &&
                $row['dewasa'] >= $row['lansia']
            ) {
                $usiaTertinggi = 'Dewasa';
            } elseif (
                $row['lansia'] >= $row['anak'] &&
                $row['lansia'] >= $row['dewasa']
            ) {
                $usiaTertinggi = 'Lansia';
            }

            $key = strtolower(str_replace(' ', '', $row['kelurahan']));

            $rumahDiperiksa = (int)($row['rumah_diperiksa'] ?? 0);
            $rumahPositif   = (int)($row['rumah_positif'] ?? 0);
            $abj = ($rumahDiperiksa > 0)
                ? round((($rumahDiperiksa - $rumahPositif) / $rumahDiperiksa) * 100, 2)
                : 0;

            $detailDesa[$key] = [
                'nama'            => $row['kelurahan'],
                'jumlah_penduduk' => 0,
                'jumlah_kasus'    => $jumlahKasus,
                'kategori'        => $kategori,

                'anak'            => (int)$row['anak'],
                'dewasa'          => (int)$row['dewasa'],
                'lansia'          => (int)$row['lansia'],

                'usia_tertinggi'  => $usiaTertinggi,

                'laki'            => (int)$row['laki'],
                'perempuan'       => (int)$row['perempuan'],

                'rumah_diperiksa' => $rumahDiperiksa,
                'rumah_positif'   => $rumahPositif,
                'abj'             => $abj,

                'sembuh'    => (int)($row['sembuh'] ?? 0),
                'meninggal' => (int)($row['meninggal'] ?? 0)
                ];
            $penduduk = $db->table('data_penduduk')
                ->where('id_penyakit', 1)
                ->get()
                ->getResultArray();

        }   // ======================
        // 🔥 KIRIM KE VIEW
        // ======================
        return view('gol_a/dashboard_kepala', [
            'menu' => 'dashboard_kepala',
            'judul' => 'Dashboard Kepala Puskesmas',
            'nama_puskesmas' => 'Puskesmas Panti, Jember',

            'total_kasus' => 20,
            'kasus_baru' => 2,
            'wilayah' => 6,

            'grafik' => $grafik,
            'dbd' => $dbd,

            // TAMBAHAN
            'detailDesa' => $detailDesa,
            'desaTertinggi' => $desaTertinggi,
            'penduduk' => $penduduk,
            'show_footer_maskot' => true,
            'footer_maskot' => 'logo_denggis.png'
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
            'Tegalgede'  => ['68', '69', '70', '71', '72', '73', '74', '74A', '74B'],
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
            'Tegalgede'  => 4,
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


    public function view_laporan(int $id)
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
            s.id_skrining, p.nik, p.no_hp, p.tanggal_lahir, 
            p.nama_pasien_skrining, p.jenis_kelamin, p.usia,
            w.provinsi, w.kabupaten, w.kecamatan, w.kelurahan, w.rt, w.rw,
            s.hasil, s.tanggal
        ');
        $builder->join('pasien_skrining p', 'p.id_pasien_skrining = s.id_pasien_skrining');
        $builder->join('wilayah w', 'w.id_wilayah = p.id_wilayah');
        $builder->where('s.id_penyakit', 1);

        $perPage = 10;
        $page = $this->request->getVar('page') ?? 1;
        $skrining = $builder->limit($perPage, ($page - 1) * $perPage)->get()->getResultArray();
        $total = $db->table('skrining')
    ->where('id_penyakit', 1)
    ->countAllResults();
        $pager = \Config\Services::pager();

        $data = [
            'menu'       => 'rekap_skrining_kepala',
            'judul'      => 'Rekap Skrining',
            'skrining'   => $skrining,
            'pagerLinks' => $pager->makeLinks($page, $perPage, $total)
        ];

        return view('gol_a/rekap_skrining_kepala', $data);
    }

    public function hapus_skrining(int $id)
    {
        $model = new \App\Models\SkriningdbdModel();
        $model->delete($id);
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}