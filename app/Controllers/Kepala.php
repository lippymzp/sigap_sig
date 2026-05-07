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
        'menu' => 'dashboard',
        'judul' => 'Dashboard Kepala',
        'nama_puskesmas' => 'Puskesmas Panti, Jember',

        'total_kasus' => 20,
        'kasus_baru' => 2,
        'wilayah' => 6,

        'grafik' => $grafik, // 🔥 TAMBAH
        'dbd' => $dbd        // 🔥 TAMBAH
    ]);}
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
public function pelaporan_kader()
    {
        
        $model = new \App\Models\PelaporanModel();

        $data = [
            'title' => 'Pelaporan Kader',
            'judul' => 'Pelaporan Kader',
            'menu'  => 'pelaporan_kader',
            'pelaporan' => $model->findAll()
        ];

        return view('gol_a/rekap_kader', $data);
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
        'Sumbersari' => ['1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31','32','33','34','35'],
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

    public function edit_laporan(int $id)
    {
    $model = new \App\Models\PelaporanModel();
    
    // Ambil data berdasarkan ID laporan
    $data['laporan'] = $model->find($id);

    if (!$data['laporan']) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Data tidak ditemukan");
    }

    return view('gol_a/edit_kader', $data); // Sesuaikan dengan nama file view edit kamu
    }

    public function delete_laporan(int $id)
{
    // 1. Inisialisasi Model (pastikan nama model sesuai dengan file model kamu)
    $model = new \App\Models\PelaporanModel();

    // 2. Cek apakah data dengan ID tersebut ada di database
    $cekData = $model->find($id);

    if ($cekData) {
        // 3. Jika ada, hapus datanya
        $model->delete($id);

        // 4. Redirect kembali ke halaman daftar dengan pesan sukses
        return redirect()->to(base_url('pelaporan-kader/daftar'))
                         ->with('success', 'Data laporan berhasil dihapus.');
    } else {
        // 5. Jika data tidak ditemukan
        return redirect()->to(base_url('pelaporan-kader/daftar'))
                         ->with('error', 'Gagal menghapus! Data tidak ditemukan.');
    }
}

}