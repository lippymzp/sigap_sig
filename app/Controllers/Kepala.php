<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Kepala extends Controller
{
    public function dashboard()
    {
        $db = \Config\Database::connect(); // 🔥 WAJIB
        $idPenyakit = session()->get('id_penyakit') ?? 1;

      // ======================
        // 🔥 DATA GRAFIK
        // ======================
        $wilayah = $this->request->getGet('wilayah'); // <-- TAMBAHAN UNTUK MENANGKAP WILAYAH
        $bulan   = $this->request->getGet('bulan');
        $tahun   = $this->request->getGet('tahun');
        $usia    = $this->request->getGet('usia');
        $jk      = $this->request->getGet('jk');

        $builder = $db->table('pasien p');
        $builder->select('w.kelurahan, COUNT(*) as total');
        $builder->join('wilayah w', 'w.id_wilayah = p.id_wilayah', 'left');

        // 🔥 FILTER BERDASARKAN PENYAKIT SESSION
        $builder->where('p.id_penyakit', $idPenyakit);
        // <-- TAMBAHAN LOGIKA FILTER WILAYAH -->
        if (!empty($wilayah)) {
            // Mengubah 'Tegalgede' (dari HTML) menjadi 'Tegal Gede' (agar cocok di Database)
            $namaWilayah = ($wilayah === 'Tegalgede') ? 'Tegal Gede' : $wilayah;
            $builder->where('w.kelurahan', $namaWilayah);
        } else {
            // Tampilkan 5 kelurahan utama jika 'All' dipilih
            $builder->whereIn('w.kelurahan', [
                'Sumbersari',
                'Wirolegi',
                'Antirogo',
                'Tegal Gede',
                'Karangrejo'
            ]);
        }
        
        if (!empty($bulan)) {
            $builder->where('MONTH(p.tgl_kunjungan)', $bulan);
        }

        if (!empty($tahun)) {
            $builder->where('YEAR(p.tgl_kunjungan)', $tahun);
        }

        if (!empty($jk)) {
            if ($jk == 'L') {
                $builder->where('p.jenis_kelamin', 'Laki-laki');
            } elseif ($jk == 'P') {
                $builder->where('p.jenis_kelamin', 'Perempuan');
            }
        }

        if (!empty($usia)) {
            if ($usia == 'anak') {
                $builder->where('p.umur <=', 14);
            } elseif ($usia == 'remaja') {
                $builder->where('p.umur >=', 15);
                $builder->where('p.umur <=', 24);
            } elseif ($usia == 'dewasa') {
                $builder->where('p.umur >=', 25);
                $builder->where('p.umur <=', 59);
            } elseif ($usia == 'lansia') {
                $builder->where('p.umur >=', 60);
            }
        }
        $builder->groupBy('w.kelurahan');

        $grafik = $builder->get()->getResultArray();

        // ======================
        // 🔥 DATA PETA
        // ======================
       $filterTahunMap = $this->request->getGet('tahun_map');

        $builderDbd = $db->table('pasien p');
        $builderDbd->select('w.kelurahan as desa, COUNT(*) as kasus');
        $builderDbd->join('wilayah w', 'w.id_wilayah = p.id_wilayah', 'left');

        // 🔥 FILTER BERDASARKAN PENYAKIT SESSION
        $builderDbd->where('p.id_penyakit', $idPenyakit);
        // 🔥 FILTER HARUS DI SINI (SEBELUM get)
        if (!empty($filterTahunMap)) {
    $builderDbd->where('YEAR(p.tgl_kunjungan)', $filterTahunMap);
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
    SUM(r.positif) as rumah_positif
");

        $builderDetail->join('wilayah w', 'w.id_wilayah = p.id_wilayah', 'left');
        $builderDetail->join(
            'rekap_pelaporan_kader r',
            'r.kelurahan = w.kelurahan',
            'left'
        );

        // 🔥 FILTER BERDASARKAN PENYAKIT SESSION DAN TAHUN
        $builderDetail->where('p.id_penyakit', $idPenyakit);
        if (!empty($filterTahunMap)) {
    $builderDetail->where('YEAR(p.tgl_kunjungan)', $filterTahunMap);
}

        $builderDetail->groupBy('w.kelurahan');

        $rawDetail = $builderDetail->get()->getResultArray();

        $detailDesa = [];
        $maxKasus = 0;
        $desaTertinggi = '-';

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

            $detailDesa[$key] = [
                'jumlah_penduduk' => 0,
                'jumlah_kasus'    => $jumlahKasus,
                'kategori'        => $kategori,

                'anak'            => (int)$row['anak'],
                'dewasa'          => (int)$row['dewasa'],
                'lansia'          => (int)$row['lansia'],

                'usia_tertinggi'  => $usiaTertinggi,

                'laki'            => (int)$row['laki'],
                'perempuan'       => (int)$row['perempuan'],

                'rumah_diperiksa' => (int)$row['rumah_diperiksa'],
                'rumah_positif'   => (int)$row['rumah_positif']
            ];
        }   
        // ======================
        // 🔥 HITUNG TOTAL KASUS KESELURUHAN (BERDASARKAN PENYAKIT SESSION)
        // ======================
        $totalKasus = $db->table('pasien')->where('id_penyakit', $idPenyakit)->countAllResults();
        $kasusBaru  = $db->table('pasien')
                        ->where('id_penyakit', $idPenyakit)
                        ->where('MONTH(tgl_kunjungan)', date('m'))
                        ->where('YEAR(tgl_kunjungan)', date('Y'))
                        ->countAllResults();
        // ======================
        // 🔥 KIRIM KE VIEW
        // ======================
        return view('gol_a/dashboard_kepala', [
            'menu' => 'dashboard_kepala',
            'judul' => 'Dashboard Kepala Puskesmas',
            'nama_puskesmas' => 'Puskesmas Panti, Jember',
            'filterTahunMap' => $filterTahunMap,
            'tahunMap' => [
                    2020 => '2020',
                    2021 => '2021',
                    2022 => '2022',
                    2023 => '2023',
                    2024 => '2024',
                    2025 => '2025',
                ],

            'total_kasus' => 20,
            'kasus_baru' => 2,
            'wilayah' => 6,

            'grafik' => $grafik,
            'dbd' => $dbd,

            // TAMBAHAN
            'detailDesa' => $detailDesa,
            'desaTertinggi' => $desaTertinggi,
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
            'title'      => 'Pelaporan Kader',
            'judul'      => 'Pelaporan Kader',
            'menu'       => 'pelaporan_kader',
            'pelaporan'  => $builder->orderBy('id_laporan', 'DESC')->findAll()
        ];

        return view('gol_a/rekap_kader', $data);
    }

    public function hasil_data_kepala()
    {
        $db = \Config\Database::connect();
        $idPenyakit = session()->get('id_penyakit') ?? 1;
        $builder = $db->table('pasien p');

        // Agregasi Data persis seperti tampilan Admin
        $builder->select("
        MONTH(p.tgl_kunjungan) as bulan_angka,
        w.kelurahan,
        SUM(CASE WHEN p.umur <= 18 THEN 1 ELSE 0 END) as anak,
        SUM(CASE WHEN p.umur > 18 THEN 1 ELSE 0 END) as dewasa,
        SUM(CASE WHEN p.jenis_kelamin = 'Laki-laki' THEN 1 ELSE 0 END) as laki,
        SUM(CASE WHEN p.jenis_kelamin = 'Perempuan' THEN 1 ELSE 0 END) as perempuan,
        COUNT(*) as jumlah
    ");

        // Join tabel wilayah untuk mendapatkan kelurahan
        $builder->join('wilayah w', 'w.id_wilayah = p.id_wilayah', 'left');

        // Kelompokkan berdasarkan Bulan dan Kelurahan
        $builder->groupBy('MONTH(p.tgl_kunjungan), w.kelurahan');
        $builder->orderBy('bulan_angka', 'ASC');

        $dataPasien = $builder->get()->getResultArray();

        // Ubah angka bulan menjadi nama bulan
        $bulanMap = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];

        foreach ($dataPasien as &$d) {
            $d['bulan'] = $bulanMap[$d['bulan_angka']] ?? '-';
        }

        return view('gol_a/hasil_data_pasien_kepala/hasil_data_kepala', [
            'menu' => 'hasil_data_kepala',
            'penyakit' => 'dbd',
            'judul' => 'Hasil Data Pasien',
            'pasien' => $dataPasien // Kirim data rekap ke view
        ]);
    }

    public function view_laporan($id)
    {
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
            'title'   => 'Pratinjau Hasil Pemeriksaan',
            'judul'   => 'Pelaporan Kader',
            'laporan' => $laporan,
            'menu'    => 'pelaporan_kader'
        ];

        return view('gol_a/view_laporan', $data);
    }
    // ==================================
    // HASIL DATA PASIEN EXPORT KEPALA
    // ==================================

    // ================= buat hasil data pasien (versi kepala) =================
    public function get_data_pasien_by_tahun()
    {
        $tahun = $this->request->getGet('tahun');

        $db = \Config\Database::connect();
        $builder = $db->table('pasien p');

        // QUERY UTAMA
        $builder->select("
            MONTH(p.tgl_kunjungan) as bulan_angka,
            w.kelurahan,

            SUM(CASE WHEN p.umur BETWEEN 0 AND 5 THEN 1 ELSE 0 END) as bayi,
            SUM(CASE WHEN p.umur BETWEEN 6 AND 10 THEN 1 ELSE 0 END) as anak,
            SUM(CASE WHEN p.umur BETWEEN 11 AND 18 THEN 1 ELSE 0 END) as remaja,
            SUM(CASE WHEN p.umur BETWEEN 19 AND 59 THEN 1 ELSE 0 END) as dewasa,
            SUM(CASE WHEN p.umur > 59 THEN 1 ELSE 0 END) as lansia,

            SUM(CASE WHEN p.jenis_kelamin = 'Laki-laki' THEN 1 ELSE 0 END) as laki,
            SUM(CASE WHEN p.jenis_kelamin = 'Perempuan' THEN 1 ELSE 0 END) as perempuan,

            COUNT(*) as jumlah
        ");

        // JOIN
        $builder->join('wilayah w', 'w.id_wilayah = p.id_wilayah', 'left');

        // FILTER TAHUN
        if (!empty($tahun)) {
            $builder->where('YEAR(p.tgl_kunjungan)', $tahun);
        }

        // GROUP BY WAJIB (BIAR TIDAK ERROR ONLY_FULL_GROUP_BY)
        $builder->groupBy('MONTH(p.tgl_kunjungan), w.kelurahan');

        // URUT BULAN
        $builder->orderBy('bulan_angka', 'ASC');

        $data = $builder->get()->getResultArray();

        // CONVERT BULAN KE INDONESIA
        $bulanMap = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];

        foreach ($data as &$d) {
            $d['bulan'] = $bulanMap[$d['bulan_angka']] ?? '-';
        }

        return $this->response->setJSON($data);
    }

    // ================= list tahun di export data =================
    public function get_tahun_list()
    {
        $db = \Config\Database::connect();
        $idPenyakit = session()->get('id_penyakit') ?? 1;

        $data = $db->table('pasien')
            ->select('YEAR(tgl_kunjungan) as tahun')
            ->distinct()
            ->orderBy('tahun', 'DESC')
            ->get()
            ->getResultArray();

        return $this->response->setJSON($data);
    }


    // ================= HALAMAN =================
    public function export_hasil_data_pasien()
    {
        $type = $this->request->getGet('type');

        $mode = $this->request->getGet('mode');
        $tahun = $this->request->getGet('tahun');
        $waktu = $this->request->getGet('waktu');
        $kelurahan = $this->request->getGet('kelurahan');

        $model = new \App\Models\InputDataPasienModel();
        $data = $model->getDataExport($mode, $tahun, $waktu, $kelurahan);

        // kalau belum klik export → tampilkan halaman filter
        if (!$type) {
            return view('gol_a/hasil_data_pasien/export_hasil_data_pasien', [
                'menu' => 'export_hasil_data_pasien',
                'penyakit' => 'dbd',
                'judul' => 'Eksport Data Pasien',
                'data' => $data //
            ]);
        }

        // EXPORT EXCEL
        if ($type == 'excel') {
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename=data_pasien.xls");
            echo "
            <html>
            <head>
                <meta charset='UTF-8'>
                <style>
                    body{
                        font-family: Arial;
                        font-size: 12px;
                        color:#333;
                    }
                    h2{
                        text-align:center;
                        margin-bottom:5px;
                    }
                    .sub{
                        text-align:center;
                        font-size:11px;
                        margin-bottom:15px;
                    }
                    table{
                        border-collapse:collapse;
                        width:100%;
                    }
                    th{
                        background:#2c3e50;
                        color:white;
                        padding:8px;
                        text-align:center;
                        border:1px solid #000;
                    }
                    td{
                        border:1px solid #999;
                        padding:6px;
                        vertical-align:top;
                    }
                    .center{
                        text-align:center;
                    }
                    .alamat{
                        width:350px;
                    }
                    .catatan{
                        width:220px;
                    }
                </style>
            </head>
            <body>
            ";
            //judul
            echo "<h2>DATA PASIEN DBD</h2>";

            echo "
            <div class='sub'>
                    Hasil Export Data Pasien DBD <br>
                Dicetak pada : " . date('d-m-Y H:i:s') . "
            </div>
            ";
            //tabel
            echo "
            <table>

                <tr>
                    <th>No</th>
                    <th>Nama Pasien</th>
                    <th>Tgl Kunjungan</th>
                    <th>JK</th>
                    <th>Usia</th>
                    <th>Catatan Klinis</th>
                    <th>Alamat Lengkap</th>
                </tr>
            ";
            $no = 1;
            //jika data ada:
            if (!empty($data)) {
                foreach ($data as $d) {
                    $alamat =
                        ($d['alamat_lengkap'] ?? '-') .
                        ", RT " . ($d['rt'] ?? '-') .
                        "/RW " . ($d['rw'] ?? '-') .
                        ", Kel. " . ($d['kelurahan'] ?? '-') .
                        ", Kec. " . ($d['kecamatan'] ?? '-') .
                        ", " . ($d['kabupaten'] ?? '-') .
                        ", " . ($d['provinsi'] ?? '-');
                    echo "
                    <tr>
                        <td class='center'>
                            {$no}
                        </td>
                        <td>
                            {$d['nama_pasien']}
                        </td>
                        <td class='center'>
                            {$d['tgl_kunjungan']}
                        </td>
                        <td class='center'>
                            {$d['jenis_kelamin']}
                        </td>
                        <td class='center'>
                            {$d['umur']}
                        </td>
                        <td class='catatan'>
                            {$d['ctt_klinis']}
                        </td>
                        <td class='alamat'>
                            {$alamat}
                        </td>
                    </tr>
                    ";
                    $no++;
                }
            }
            // DATA KOSONG
            else {
                echo "
                <tr>
                    <td colspan='7' class='center'>
                        Data tidak tersedia
                    </td>
                </tr>
                ";
            }
            echo "
            </table>
            </body>
            </html>
            ";
            exit;
        }

        // EXPORT PDF
        if ($type == 'pdf') {
            $html = view('gol_a/hasil_data_pasien/export_pdf_pasien', ['data' => $data]);

            $dompdf = new \Dompdf\Dompdf();
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'landscape');
            $dompdf->render();
            $dompdf->stream("data_pasien.pdf", ["Attachment" => true]);
            exit;
        }
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
        $builder->orderBy('s.id_skrining', 'DESC');

        $perPage = 10;
        $page = $this->request->getVar('page') ?? 1;
        $skrining = $builder->limit($perPage, ($page - 1) * $perPage)->get()->getResultArray();
        $total = $db->table('skrining')->countAll();
        $pager = \Config\Services::pager();

        $data = [
            'menu'       => 'rekap_skrining_kepala',
            'judul'      => 'Rekap Skrining',
            'skrining'   => $skrining,
            'pagerLinks' => $pager->makeLinks($page, $perPage, $total)
        ];

        return view('gol_a/rekap_skrining_kepala', $data);
    }

    public function hapus_skrining($id)
    {
        $model = new \App\Models\SkriningdbdModel();
        $model->delete($id);
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}