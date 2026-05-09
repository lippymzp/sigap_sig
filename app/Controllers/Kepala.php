<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Kepala extends Controller
{
   public function dashboard()
    {
    $db = \Config\Database::connect(); // 🔥 WAJIB

    // ======================
    // 🔥 DATA GRAFIK
    // ======================
    $bulan = $this->request->getGet('bulan');
    $tahun = $this->request->getGet('tahun');
    $usia  = $this->request->getGet('usia');
    $jk    = $this->request->getGet('jk');


    $builder = $db->table('pasien p');
    $builder->select('w.kelurahan, COUNT(*) as total');
    $builder->join('wilayah w', 'w.id_wilayah = p.id_wilayah', 'left');

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
    $tahunMap = $this->request->getGet('tahun_map');

    $builderDbd = $db->table('pasien p');
    $builderDbd->select('w.kelurahan as desa, COUNT(*) as kasus');
    $builderDbd->join('wilayah w', 'w.id_wilayah = p.id_wilayah', 'left');

    // 🔥 FILTER HARUS DI SINI (SEBELUM get)
    if (!empty($tahunMap)) {
        $builderDbd->where('YEAR(p.tgl_kunjungan)', $tahunMap);
    }

    $builderDbd->groupBy('w.kelurahan');

    // 🔥 BARU AMBIL DATA
    $dbd = $builderDbd->get()->getResultArray();    // ======================
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
    'dbd' => $dbd
]);
;}
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
        'Sumbersari' => ['01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31','32','33','34','35'],
        'Wirolegi'   => ['36','36A','37','38','39','40','41','42','43','44','44A','45','46','47','48','49','50','51','52','53','54'],
        'Karangrejo' => ['75','76','77','78','78A','79','80','81','82','83','84','85','86','87','88','88A','89','90','91','92','92A','93','94','95','95A','95B'],
        'Tegalgede'  => ['68','69','70','71','72','73','74','74A','74B'],
        'Antirogo'   => ['55','56','57','58','58A','59','60','61','62','63','64','65','65A','66','67']
    ];

    if (!empty($filterPosyandu)) {
        // A. JIKA POSYANDU DIPILIH: Hanya tampilkan 1 kolom posyandu tersebut
        // Kita bersihkan string "Catleya " jika ada, agar sesuai dengan ID di DB
        $cleanId = str_replace('Catleya ', '', $filterPosyandu);
        $listCatleya = [$cleanId];
    } 
    elseif (!empty($filterKelurahan) && isset($dataMapping[$filterKelurahan])) {
        // B. JIKA HANYA KELURAHAN DIPILIH: Tampilkan semua posyandu di kelurahan itu
        $listCatleya = $dataMapping[$filterKelurahan];
    } 
    else {
        // C. JIKA TIDAK ADA FILTER: Tampilkan semua (105 Catleya)
        for ($i = 1; $i <= 95; $i++) { $listCatleya[] = (string)$i; }
        $bayangan = ['36A', '44A', '58A', '65A', '74A', '74B', '78A', '88A', '92A', '95A', '95B'];
        $listCatleya = array_unique(array_merge($listCatleya, $bayangan));
        sort($listCatleya, SORT_NATURAL); // Urutkan biar rapi
    }

    // 3. Logika Mencari Hari Jumat (Tetap seperti sebelumnya)
    $bulanAngka = ['Januari'=>1,'Februari'=>2,'Maret'=>3,'April'=>4,'Mei'=>5,'Juni'=>6,'Juli'=>7,'Agustus'=>8,'September'=>9,'Oktober'=>10,'November'=>11,'Desember'=>12];
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

    // 4. Ambil Data Laporan dari DB
    $laporanDb = $model->where('bulan', $bulanNama)->findAll();
    $dataLaporan = [];
    foreach ($laporanDb as $row) {
        $dataLaporan[$row['minggu']][$row['id_posyandu']] = $row['id_laporan'];
    }

    // 5. Kirim ke View
    $data = [
        'title'       => 'Daftar Laporan Kader',
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

    $builder = $model;

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
        'pelaporan'  => $builder->findAll()
    ];

    return view('gol_a/rekap_kader', $data);
}

public function hasil_data_kepala()
{
    $pasien = session()->get('pasien') ?? [];

    return view('gol_a/hasil_data_pasien_kepala/hasil_data_kepala', [
        'menu' => 'hasil_data_kepala',
        'penyakit' => 'dbd',
        'judul' => 'Hasil Data Pasien',
        'pasien' => $pasien
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

        // QUERY UTAMA (Disesuaikan untuk Kepala: Fokus ke Kecamatan)
        $builder->select("
            MONTH(p.tgl_kunjungan) as bulan_angka,
            w.kecamatan,

            SUM(CASE WHEN p.umur <= 18 THEN 1 ELSE 0 END) as anak,
            SUM(CASE WHEN p.umur >= 19 THEN 1 ELSE 0 END) as dewasa,

            SUM(CASE WHEN p.jenis_kelamin = 'Laki-laki' THEN 1 ELSE 0 END) as laki,
            SUM(CASE WHEN p.jenis_kelamin = 'Perempuan' THEN 1 ELSE 0 END) as perempuan,

            COUNT(*) as jumlah
        ");

        $builder->join('wilayah w', 'w.id_wilayah = p.id_wilayah', 'left');

        // FILTER TAHUN
        if (!empty($tahun)) {
            $builder->where('YEAR(p.tgl_kunjungan)', $tahun);
        }

        // GROUP BY WAJIB (Berdasarkan Bulan dan Kecamatan)
        $builder->groupBy('MONTH(p.tgl_kunjungan), w.kecamatan');

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

        $data = $db->table('pasien')
            ->select('YEAR(tgl_kunjungan) as tahun')
            ->distinct()
            ->orderBy('tahun', 'DESC')
            ->get()
            ->getResultArray();

        return $this->response->setJSON($data);
    }

    // ================= HALAMAN EXPORT =================
    public function export_hasil_data_kepala()
    {
        $type = $this->request->getGet('type');

        $mode = $this->request->getGet('mode');
        $tahun = $this->request->getGet('tahun');
        $waktu = $this->request->getGet('waktu');
        $kecamatan = $this->request->getGet('kecamatan'); // Menggunakan Kecamatan untuk Kepala

        // Asumsi kamu memiliki method di Model untuk filter ini (harus support parameter kecamatan)
        // Jika modelmu bernama InputDataPasienModel:
        $model = new \App\Models\InputDataPasienModel();
        
        // PENTING: Pastikan Model getDataExport / getDataExportKepala bisa menerima $kecamatan
        // Contoh pemanggilan:
        $data = $model->getDataExport($mode, $tahun, $waktu, $kecamatan); 

        // 1. Tampilkan Halaman UI jika belum klik tombol tipe export
        if (!$type) {
            return view('gol_a/hasil_data_pasien_kepala/export_data_kepala', [
                'menu' => 'export_hasil_data_kepala',
                'penyakit' => 'dbd',
                'judul' => 'Eksport Data Pasien',
                'data' => $data
            ]);
        }

        // 2. EXPORT EXCEL
        if ($type == 'excel') {
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename=Rekap_Data_Pasien_Kepala.xls");

            echo "<html>";
            echo "<head>
                    <meta charset='UTF-8'>
                    <style>
                        body { font-family: Arial; font-size: 12px; }
                        h2 { text-align: center; color: #2c3e50; }
                        .sub { text-align: center; font-size: 11px; margin-bottom: 10px; color: #555; }
                        table { border-collapse: collapse; width: 100%; }
                        th { background: #00BBC2; color: #fff; padding: 6px; border: 1px solid #009fa5; }
                        td { border: 1px solid #ddd; padding: 5px; }
                        .center { text-align: center; }
                    </style>
                </head>";

            echo "<body>";
            echo "<h2>REKAPITULASI DATA PASIEN DBD</h2>";
            echo "<div class='sub'>Hasil Export Berdasarkan Filter Kepala</div>";

            echo "<table>";
            echo "<tr>
                    <th>No</th>
                    <th>Kecamatan</th>
                    <th>Desa</th>
                    <th>Jenis Kelamin</th>
                    <th>Usia</th>
                    <th>Jumlah Kasus</th>
                </tr>";

            $no = 1;

            if (!empty($data)) {
                foreach ($data as $d) {
                    $kec = esc((string) ($d['kecamatan'] ?? '-'));
                    $desa = esc((string) ($d['desa'] ?? '-'));
                    $jk = esc((string) ($d['jk'] ?? '-'));
                    $usia = esc((string) ($d['usia'] ?? '-'));

                    echo "<tr>
                            <td class='center'>{$no}</td>
                            <td>{$kec}</td>
                            <td>{$desa}</td>
                            <td class='center'>{$jk}</td>
                            <td class='center'>{$usia}</td>
                            <td class='center'>1</td>
                        </tr>";
                    $no++;
                }
            } else {
                echo "<tr>
                        <td colspan='6' class='center'>Data tidak tersedia</td>
                    </tr>";
            }

            echo "</table>";
            echo "</body></html>";
            exit;
        }

        // 3. EXPORT PDF
        if ($type == 'pdf') {
            // Memanggil file template PDF khusus kepala yang kita buat sebelumnya
            $html = view('gol_a/hasil_data_pasien_kepala/export_pdf_kepala', ['data' => $data]);

            $dompdf = new \Dompdf\Dompdf();
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'portrait'); // Bisa ganti ke 'landscape' jika kurang lebar
            $dompdf->render();
            $dompdf->stream("Rekap_Data_Pasien_Kepala.pdf", ["Attachment" => true]);
            exit;
        }
    }

    // ==================================
    // MANAJEMEN USER (VERSI KEPALA)
    // ==================================
    
    public function manajemen_user()
    {
        $petugasModel = new \App\Models\PetugasModel();
        $jabatanModel = new \App\Models\JabatanModel();

        $keyword = $this->request->getGet('keyword');
        $jabatan = $this->request->getGet('jabatan');

        $perPage = 8;

        // QUERY
        $petugasModel->select('petugas.*, jabatan.nama_jabatan')
                     ->join('jabatan', 'jabatan.id_jabatan = petugas.id_jabatan');

        // SEARCH
        if (!empty($keyword)) {
            $petugasModel->groupStart()
                ->like('nama_petugas', $keyword)
                ->orLike('email', $keyword)
                ->orLike('NIP', $keyword)
            ->groupEnd();
        }

        // FILTER
        if (!empty($jabatan)) {
            $petugasModel->where('petugas.id_jabatan', $jabatan);
        }

        // TOTAL DATA
        $total = $petugasModel->countAllResults(false);

        // PAGINATION
        $petugas = $petugasModel->paginate($perPage, 'default');
        $pager = $petugasModel->pager;
        $currentPage = $pager->getCurrentPage('default');
        $start = ($currentPage - 1) * $perPage + 1;
        $end = min($start + $perPage - 1, $total);

        $data = [
            'petugas' => $petugas,
            'pager' => $pager,
            'total' => $total,
            'start' => $start,
            'end' => $end,
            'jabatan_list' => $jabatanModel->findAll(),
            'keyword' => $keyword,
            'selected_jabatan' => $jabatan,
            'menu' => 'manajemen_user_kepala',
            'judul' => 'Manajemen User'
        ];

        return view('gol_a/manajemen_user_kepala/index', $data);
    }

    public function form_user($id = null, $mode = 'tambah')
    {
        $petugasModel = new \App\Models\PetugasModel();
        $jabatanModel = new \App\Models\JabatanModel();
        $instansiModel = new \App\Models\InstansiModel();

        $data = [
            'jabatan' => $jabatanModel->findAll(),
            'instansi' => $instansiModel->findAll(),
            'mode' => $mode,
            'menu' => 'manajemen_user_kepala',
            'judul' => 'Manajemen User'
        ];

        if ($id) {
            $data['user'] = $petugasModel->find($id);
        }

        return view('gol_a/manajemen_user_kepala/form', $data);
    }

    public function simpan_user()
    {
        $petugasModel = new \App\Models\PetugasModel();

        if ($this->request->getPost('password') != $this->request->getPost('konfirmasi_password')) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Konfirmasi password tidak sama.');
        }

        $petugasModel->save([
            'NIP'           => $this->request->getPost('nip'),
            'nama_petugas'  => $this->request->getPost('nama_petugas'),
            'id_jabatan'    => $this->request->getPost('id_jabatan'),
            'id_instansi'   => $this->request->getPost('id_instansi'),
            'id_penyakit'   => 1, // otomatis
            'no_telp'       => $this->request->getPost('no_telp'),
            'email'         => $this->request->getPost('email'),
            'password'      => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'created_at'    => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/kepala/manajemen_user')
            ->with('success', 'Data berhasil ditambahkan.');
    }

    public function update_user($id)
    {
        $petugasModel = new \App\Models\PetugasModel();

        if ($this->request->getPost('password')) {
            if ($this->request->getPost('password') != $this->request->getPost('konfirmasi_password')) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Konfirmasi password tidak sama.');
            }
        }

        $data = [
            'id_petugas'    => $id,
            'NIP'           => $this->request->getPost('nip'),
            'nama_petugas'  => $this->request->getPost('nama_petugas'),
            'id_jabatan'    => $this->request->getPost('id_jabatan'),
            'id_instansi'   => $this->request->getPost('id_instansi'),
            'id_penyakit'   => 1,
            'no_telp'       => $this->request->getPost('no_telp'),
            'email'         => $this->request->getPost('email'),
        ];

        if ($this->request->getPost('password')) {
            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        $petugasModel->save($data);

        return redirect()->to('/kepala/manajemen_user')
            ->with('success', 'Data berhasil diupdate.');
    }

    public function hapus_user($id)
    {
        $petugasModel = new \App\Models\PetugasModel();
        $db = \Config\Database::connect();

        $jumlahPasien = $db->table('pasien')
            ->where('id_petugas', $id)
            ->countAllResults();

        if ($jumlahPasien > 0) {
            return redirect()->to('/kepala/manajemen_user')
                ->with('error', 'Data petugas tidak bisa dihapus karena masih digunakan pada data pasien.');
        }

        $petugasModel->delete($id);

        return redirect()->to('/kepala/manajemen_user')
            ->with('success', 'Data berhasil dihapus.');
    }

    public function view_user($id)
    {
        $petugasModel = new \App\Models\PetugasModel();
        $jabatanModel = new \App\Models\JabatanModel();   // Panggil model jabatan
        $instansiModel = new \App\Models\InstansiModel(); // Panggil model instansi
        
        $data['user'] = $petugasModel
            ->select('petugas.*, jabatan.nama_jabatan')
            ->join('jabatan', 'jabatan.id_jabatan = petugas.id_jabatan')
            ->find($id);

        // Kirimkan data jabatan dan instansi ke view form.php
        $data['jabatan']  = $jabatanModel->findAll();
        $data['instansi'] = $instansiModel->findAll();
        
        $data['mode']     = 'view';
        $data['menu']     = 'manajemen_user_kepala';
        $data['judul']    = 'Detail User';

        // Arahkan ke file form yang sama
        return view('gol_a/manajemen_user_kepala/form', $data);
    }

    // ... baris-baris kode sebelumnya (seperti view_user, dll) ...

    // TARUH DI SINI (Sebelum tanda kurung kurawal terakhir)
    
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
// <--- INI ADALAH KURUNG KURAWAL PENUTUP CLASS (JANGAN DIHAPUS)

} // Ini adalah penutup class Kepala. Jangan ada apa-apa lagi di bawahnya.