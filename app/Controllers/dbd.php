<?php

namespace App\Controllers;

use App\Models\InputDataPasienModel;
use App\Models\PelaporanModel; // <-- DITAMBAHKAN: Panggil Model Pelaporan
use App\Models\FunfactModel;
use Dompdf\Dompdf;
use Dompdf\Options;

class Dbd extends BaseController
{
    protected FunfactModel $funfact;
    protected PelaporanModel $pelaporanModel; // <-- DITAMBAHKAN: Variabel untuk model
    protected $db; 
    // <-- DITAMBAHKAN: Constructor untuk inisialisasi model
    public function __construct()
    {
        $this->pelaporanModel = new PelaporanModel();
        $this->funfact = new FunfactModel();
        $this->db = \Config\Database::connect();
    }

    public function inputData()
    {
            $db = \Config\Database::connect();

            $chart = $db->query("
                SELECT 
                    CASE
                        WHEN umur <= 5 THEN 'Balita'
                        WHEN umur <= 12 THEN 'Anak'
                        WHEN umur <= 17 THEN 'Remaja'
                        WHEN umur <= 59 THEN 'Dewasa'
                        ELSE 'Lansia'
                    END AS kelompok,
                    COUNT(*) as total
                FROM pasien
                GROUP BY kelompok
            ")->getResultArray();

            $label = [];
            $total = [];

            foreach($chart as $c){

                $label[] = $c['kelompok'];
                $total[] = $c['total'];
            }

            return view('gol_a/input_data', [

                'menu' => 'inputdata',

                'penyakit' => 'dbd',

                'judul' => 'Input Data Pasien',

                'labelChart' => json_encode($label),

                'totalChart' => json_encode($total)
            ]);
        }

        public function hasil_data()
        {
            $pasien = session()->get('pasien') ?? [];

            return view('gol_a/hasil_data_pasien/hasil_data_a', [
                'menu' => 'hasil',
                'penyakit' => 'dbd',
                'judul' => 'Hasil Data Pasien',
                'pasien' => $pasien
            ]);
        }

    public function simpandatapasien()
    {
        $model = new InputDataPasienModel();

        $data = [

            // ID PETUGAS LOGIN
            'id_petugas' => session()->get('id_petugas'),

            // ======================
            // DATA WILAYAH
            // ======================
            'provinsi' => $this->request->getPost('provinsi'),
            'kabupaten' => $this->request->getPost('kabupaten'),
            'kecamatan' => $this->request->getPost('kecamatan'),
            'desa' => $this->request->getPost('desa'),

            'rt' => $this->request->getPost('rt'),
            'rw' => $this->request->getPost('rw'),

            'alamat' => $this->request->getPost('alamat'),

            'lat' => $this->request->getPost('lat'),
            'lng' => $this->request->getPost('lng'),

            // ======================
            // DATA PASIEN
            // ======================
            'nama' => $this->request->getPost('nama'),

            'tanggal' => $this->request->getPost('tanggal'),

            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),

            'usia' => $this->request->getPost('usia'),

            'catatan' => $this->request->getPost('catatan'),
        ];

        $simpan = $model->simpanSemua($data);

        if ($simpan) {

            return redirect()
                ->back()
                ->with('success', 'Data pasien berhasil disimpan');

        } else {

            return redirect()
                ->back()
                ->with('error', 'Data gagal disimpan');
        }
    }

    public function export()
    {
        $pasien = session()->get('pasien') ?? [];

        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=data_pasien.xls");

        echo "<table border='1'>";
        echo "<tr>
                <th>No</th>
                <th>Kecamatan</th>
                <th>Desa</th>
                <th>Jenis Kelamin</th>
                <th>Usia</th>
                <th>Kasus</th>
              </tr>";

        $no = 1;
        foreach ($pasien as $p) {
            echo "<tr>
                    <td>{$no}</td>
                    <td>{$p['kecamatan']}</td>
                    <td>{$p['desa']}</td>
                    <td>{$p['jk']}</td>
                    <td>{$p['usia']}</td>
                    <td>1</td>
                  </tr>";
            $no++;
        }

        echo "</table>";
    }

   //FORM KADER PSN

    public function riwayat_jentik()
    {
        // 1. Ambil data dari database
        $dataPelaporan = $this->pelaporanModel->orderBy('created_at', 'DESC')->findAll();

        // 2. Mapping ID Kelurahan menjadi Teks
        $kelurahanMap = [
            1 => 'Sumbersari',
            2 => 'Wirolegi',
            3 => 'Antirogo',
            4 => 'Tegal Gede',
            5 => 'Karangrejo'
        ];

        // 3. Format data (Mengubah ID angka menjadi teks yang bisa dibaca)
        foreach ($dataPelaporan as &$row) {
            $row['nama_puskesmas'] = ($row['id_puskesmas'] == 1) ? 'PKM Sumbersari' : '-';
            $row['kelurahan'] = isset($kelurahanMap[$row['id_kelurahan']]) ? $kelurahanMap[$row['id_kelurahan']] : '-';
            $row['nama_posyandu']  = 'Catleya ' . $row['id_posyandu'];
        }

        // 4. Bungkus data untuk dikirim ke View
        $data = [
            'title'     => 'Pelaporan Kader',
            'judul'     => 'Pelaporan Kader',
            'menu'      => 'riwayat_jentik', // Sesuai dengan menu sidebar Anda
            'pelaporan' => $dataPelaporan    // Variabel berisi data database
        ];

        // 5. Tampilkan ke file View yang tepat
        // Pastikan Anda menaruh kode HTML tabel riwayat di dalam file ini:
        return view('gol_a/formkader/riwayat_lapor_jentik', $data);
    }
    // ==============================================================
    // FUNGSI BARU: PELAPORAN KADER (READ & TAMPILKAN TABEL)
    // ==============================================================
    public function pelaporan()
{
    $dataPelaporan = $this->pelaporanModel->orderBy('created_at', 'DESC')->findAll();

    $kelurahanMap = [
        1 => 'Sumbersari',
        2 => 'Wirolegi',
        3 => 'Antirogo',
        4 => 'Tegal Gede',
        5 => 'Karangrejo'
    ];

    foreach ($dataPelaporan as &$row) {
        // Logika Puskesmas
        $row['nama_puskesmas'] = ($row['id_puskesmas'] == 1) ? 'PKM Sumbersari' : '-';
        
        // Logika Kelurahan yang diperbarui: 
        // Cek apakah 'kelurahan' ada dan tidak kosong di database. 
        // Jika kosong, gunakan $kelurahanMap (sebagai fallback untuk data lama).
        if (!empty($row['kelurahan'])) {
            $row['kelurahan'] = $row['kelurahan'];
        } else {
            $row['kelurahan'] = isset($kelurahanMap[$row['id_kelurahan']]) ? $kelurahanMap[$row['id_kelurahan']] : '-';
        }

        // Logika Posyandu
        $row['nama_posyandu']  = 'Catleya ' . $row['id_posyandu'];
    }

    $data = [
        'title'     => 'Riwayat Pelaporan Kader',
        'menu'      => 'pelaporan',
        'pelaporan' => $dataPelaporan 
    ];

    return view('riwayat_pelaporan', $data);
}

    public function hapus_pelaporan(int $id)
    {
        // 1. Cari data berdasarkan ID
        $data = $this->pelaporanModel->find($id);
        
        if ($data) {
            // 2. Hapus file foto dari folder (opsional, tapi sangat disarankan agar memori server tidak penuh)
            if (!empty($data['foto'])) {
                $fotoArray = json_decode($data['foto'], true);
                if (is_array($fotoArray)) {
                    foreach ($fotoArray as $foto) {
                        $pathFoto = FCPATH . 'uploads/pelaporan/' . $foto;
                        if (file_exists($pathFoto)) {
                            unlink($pathFoto); // Perintah untuk menghapus file fisik
                        }
                    }
                }
            }
            
            // 3. Hapus data dari database
            $this->pelaporanModel->delete($id);
            
            // 4. Kembali ke halaman riwayat dengan pesan sukses
            return redirect()->to(base_url('dbd/pelaporan'))->with('success', 'Data pelaporan berhasil dihapus!');
        }

        // Jika data tidak ditemukan
        return redirect()->to(base_url('dbd/pelaporan'));
    }

    // ==============================================================
    // FUNGSI BARU: HALAMAN TAMBAH PELAPORAN
    // ==============================================================
    public function tambah_pelaporan()
    {
        $data = [
            'title' => 'Tambah Pelaporan Kader',
            'judul' => 'Pelaporan Kader',
            'menu'  => 'pelaporan'
        ];

        return view('gol_a/formkader/formulir_tambah_data', $data);
    }

    // ==============================================================
    // FUNGSI BARU: SIMPAN DATA DARI FORM (INSERT KE DATABASE)
    // ==============================================================
    public function simpanpsn()
    {
        $periodeLengkap = $this->request->getPost('periode'); 
        $idPuskesmas    = $this->request->getPost('id_puskesmas');
        $idKelurahan    = $this->request->getPost('id_kelurahan');
        
        // --- DIUBAH: Menangkap atribut kelurahan dari view ---
        $kelurahan      = $this->request->getPost('kelurahan'); 
        
        $idPosyandu     = $this->request->getPost('id_posyandu');
        $diperiksa      = $this->request->getPost('diperiksa');
        $positif        = $this->request->getPost('positif');
        $bagian         = $this->request->getPost('bagian');

        $minggu = '';
        $bulan  = '';
        if (strpos($periodeLengkap, '(') !== false) {
            $parts = explode('(', $periodeLengkap);
            $minggu = trim($parts[0]); 
            
            $datePart = str_replace(')', '', $parts[1]); 
            $dateArray = explode(' ', $datePart);
            if (count($dateArray) >= 3) {
                $bulan = $dateArray[count($dateArray) - 2]; 
            }
        }

        $abj = 0;
        if ($diperiksa > 0) {
            $abj = (($diperiksa - $positif) / $diperiksa) * 100;
        }

        $namaFotoArray = [];
        if ($imagefile = $this->request->getFiles()) {
            if (array_key_exists('foto', $imagefile)) {
                foreach ($imagefile['foto'] as $img) {
                    if ($img->isValid() && ! $img->hasMoved()) {
                        $newName = $img->getRandomName();
                        $img->move(FCPATH . 'uploads/pelaporan', $newName);
                        $namaFotoArray[] = $newName;
                    }
                }
            }
        }
        $fotoJson = json_encode($namaFotoArray);

        $this->pelaporanModel->insert([
            'bulan'           => $bulan,
            'minggu'          => $minggu,
            'periode_lengkap' => $periodeLengkap,
            'id_puskesmas'    => $idPuskesmas,
            'id_kelurahan'    => $idKelurahan,
            
            // --- DIUBAH: Menyimpan ke kolom 'kelurahan' di database ---
            'kelurahan'       => $kelurahan, 
            
            'id_posyandu'     => $idPosyandu,
            'diperiksa'       => $diperiksa,
            'positif'         => $positif,
            'bagian'          => $bagian,
            'foto'            => $fotoJson,
            'abj'             => $abj
        ]);

        return redirect()->to(base_url('dbd/pelaporan'))->with('success', 'Data pelaporan jentik berhasil disimpan!');
    }


    // ==============================================================
    // FUNGSI BARU: PROSES UPDATE DATA (DATABASE)
    // ==============================================================
    public function edit_pelaporan(int $id)
    {
        $laporan = $this->pelaporanModel->find($id);

        if (!$laporan) {
            return redirect()->to(base_url('dbd/pelaporan'))->with('error', 'Data tidak ditemukan.');
        }

        $data = [
            'title'   => 'Edit Pelaporan Kader',
            'judul'   => 'Edit Pelaporan',
            'menu'    => 'riwayat_jentik',
            'laporan' => $laporan
        ];

        return view('gol_a/formkader/edit_pelaporan', $data);
    }

    // FUNGSI BARU: PROSES UPDATE DATA (DATABASE)
    // ==============================================================
    public function update_pelaporan(int $id)
    {
        $periodeLengkap = $this->request->getPost('periode'); 
        $idPuskesmas    = $this->request->getPost('id_puskesmas');
        $idKelurahan    = $this->request->getPost('id_kelurahan');
        $Kelurahan      = $this->request->getPost('kelurahan');
        $idPosyandu     = $this->request->getPost('id_posyandu');
        $diperiksa      = $this->request->getPost('diperiksa');
        $positif        = $this->request->getPost('positif');
        $bagian         = $this->request->getPost('bagian');

        // 1. Ekstrak ulang Bulan dan Minggu
        $minggu = ''; $bulan = '';
        if (strpos($periodeLengkap, '(') !== false) {
            $parts = explode('(', $periodeLengkap);
            $minggu = trim($parts[0]);
            $datePart = str_replace(')', '', $parts[1]);
            $dateArray = explode(' ', $datePart);
            if (count($dateArray) >= 3) { $bulan = $dateArray[count($dateArray) - 2]; }
        }

        // 2. Hitung ulang ABJ
        $abj = ($diperiksa > 0) ? (($diperiksa - $positif) / $diperiksa) * 100 : 0;

        // 3. Kelola Foto (Jika ada upload baru, kita gabungkan atau ganti)
        // Untuk saat ini, kita gunakan logika: jika ada upload baru, maka ganti semua foto lama.
        $laporanLama = $this->pelaporanModel->find($id);
        $fotoFinal = $laporanLama['foto'];

        $imagefile = $this->request->getFiles();
        if (!empty($imagefile['foto'][0]->getName())) {
            $namaFotoArray = [];
            foreach ($imagefile['foto'] as $img) {
                if ($img->isValid() && ! $img->hasMoved()) {
                    $newName = $img->getRandomName();
                    $img->move(FCPATH . 'uploads/pelaporan', $newName);
                    $namaFotoArray[] = $newName;
                }
            }
            $fotoFinal = json_encode($namaFotoArray);
        }

        // 4. Update Database
        $this->pelaporanModel->update($id, [
            'bulan'           => $bulan,
            'minggu'          => $minggu,
            'periode_lengkap' => $periodeLengkap,
            'id_puskesmas'    => $idPuskesmas,
            'id_kelurahan'    => $idKelurahan,
            'id_posyandu'     => $idPosyandu,
            'diperiksa'       => $diperiksa,
            'positif'         => $positif,
            'bagian'          => $bagian,
            'foto'            => $fotoFinal,
            'abj'             => $abj
        ]);

        return redirect()->to(base_url('dbd/pelaporan'))->with('success', 'Perubahan data berhasil disimpan!');
    }

    // ================= REKAP + FILTER =================
    public function rekappsn()
    {
        $session = session();
        $laporanpsn = $session->get('laporanpsn') ?? [];

        $posyandu = [];
        for ($i = 1; $i <= 95; $i++) {

        // Tambahkan nomor utama
        $posyandu[] = "CATLEYA $i";

        // Sisipkan bayangan setelah nomor tertentu
        if ($i == 36) {
            $posyandu[] = "CATLEYA 36A (BAYANGAN)";
        }

        if ($i == 58) {
            $posyandu[] = "CATLEYA 58A (BAYANGAN)";
        }

        if ($i == 65) {
            $posyandu[] = "CATLEYA 65A (BAYANGAN)";
        }

        if ($i == 78) {
            $posyandu[] = "CATLEYA 78A (BAYANGAN)";
        }

        if ($i == 88) {
            $posyandu[] = "CATLEYA 88A (BAYANGAN)";
        }

        if ($i == 92) {
            $posyandu[] = "CATLEYA 92A (BAYANGAN)";
        }

        if ($i == 95) {
            $posyandu[] = "CATLEYA 95B (BAYANGAN)";
        }
        }

        // FILTER
        $start = $this->request->getGet('start');
        $end   = $this->request->getGet('end');
        $statusFilter = $this->request->getGet('status');
        $kelFilter = strtolower((string) ($this->request->getGet('kelurahan') ?? ''));
        $posFilter = strtolower((string) ($this->request->getGet('posyandu') ?? ''));

        $filtered = [];
        $totalPositif = 0;
        $totalDiperiksa = 0;

        foreach ($posyandu as $pos) {

            $data = $laporanpsn[$pos] ?? null;
            $status = $data ? 'sudah' : 'belum';

            // filter posyandu
            if ($posFilter && strpos(strtolower((string) $pos), $posFilter) === false) continue;
            // filter status
            if ($statusFilter && $status != $statusFilter) continue;

            // filter kelurahan
            if ($kelFilter && strpos(strtolower((string) ($data['kelurahan'] ?? '')), $kelFilter) === false) continue;

            // filter tanggal (AMAN)
            $tanggal = $data['tanggalinput'] ?? null;
            $t = $tanggal ? strtotime($tanggal) : null;
            $s = $start ? strtotime($start) : null;
            $e = $end ? strtotime($end) : null;

            if (($s || $e) && !$t) continue;
            if ($s && $t < $s) continue;
            if ($e && $t > $e) continue;

            $filtered[$pos] = $data;

            $totalPositif += (int)($data['positif'] ?? 0);
            $totalDiperiksa += (int)($data['diperiksa'] ?? 0);
        }

        return view('gol_a/formkader/rekap', [
            'laporanpsn' => $filtered,
            'totalPositif' => $totalPositif,
            'totalDiperiksa' => $totalDiperiksa
        ]);
    }

    // ================= DETAIL =================
    public function detail_pelaporan(int $id)
    {
        // 1. Ambil data dari database berdasarkan ID
        $laporan = $this->pelaporanModel->find($id);

        if (!$laporan) {
            return redirect()->to(base_url('dbd/pelaporan'))->with('error', 'Data tidak ditemukan.');
        }

        // 2. Mapping ID Kelurahan & Puskesmas ke Nama Teks
        $kelurahanMap = [
            1 => 'Sumbersari',
            2 => 'Wirolegi',
            3 => 'Antirogo',
            4 => 'Tegal Gede',
            5 => 'Karangrejo'
        ];

        $laporan['nama_puskesmas'] = ($laporan['id_puskesmas'] == 1) ? 'PKM Sumbersari' : '-';
        $laporan['nkelurahan'] = isset($kelurahanMap[(string)$laporan['id_kelurahan']])
        ? $kelurahanMap[(string)$laporan['id_kelurahan']]
          : '-';
        $laporan['nama_posyandu']  = 'CATLEYA ' . $laporan['id_posyandu'];

        $data = [
            'title'   => 'Detail Pelaporan Kader',
            'judul'   => 'Detail Pelaporan',
            'menu'    => 'riwayat_jentik',
            'laporan' => $laporan
        ];

        return view('gol_a/formkader/detail_pelaporan', $data);
    }

    public function exportrekappsn()
    {
        $session = session();
        $laporanpsn = $session->get('laporanpsn') ?? [];

        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=rekap_posyandu.xls");

        echo "<table border='1'>";
        echo "<tr style='background:#D9EAD3; font-weight:bold;'>
                <th>Posyandu</th>
                <th>Kelurahan</th>
                <th>Tanggal</th>
                <th>Diperiksa</th>
                <th>Positif</th>
                <th style='width:200px;'>Foto</th>
            </tr>";

        // daftar posyandu (biar urut)
        $posyandu = [];

        for ($i = 1; $i <= 95; $i++) {

            $posyandu[] = "CATLEYA $i";

            if ($i == 36) $posyandu[] = "CATLEYA 36A (BAYANGAN)";
            if ($i == 58) $posyandu[] = "CATLEYA 58A (BAYANGAN)";
            if ($i == 65) $posyandu[] = "CATLEYA 65A (BAYANGAN)";
            if ($i == 78) $posyandu[] = "CATLEYA 78A (BAYANGAN)";
            if ($i == 88) $posyandu[] = "CATLEYA 88A (BAYANGAN)";
            if ($i == 92) $posyandu[] = "CATLEYA 92A (BAYANGAN)";
            if ($i == 95) $posyandu[] = "CATLEYA 95B (BAYANGAN)";
        }

        foreach ($posyandu as $pos) {

            $data = $laporanpsn[$pos] ?? null;

            // cek foto
            $foto = '-';
            if (!empty($data['foto'])) {
                $url = base_url('uploads/' . $data['foto']);
                $foto = "<img src='$url' width='80'>";
            }

            // warna merah kalau belum diisi
            $bg = !$data ? "style='background-color:#f4cccc'" : "";

            echo "<tr $bg>
                    <td>{$pos}</td>
                    <td>".($data['kelurahan'] ?? '-')."</td>
                    <td>".($data['tanggalinput'] ?? '-')."</td>
                    <td>".($data['diperiksa'] ?? '0')."</td>
                    <td>".($data['positif'] ?? '0')."</td>
                    <td>{$foto}</td>
                </tr>";
        }

        echo "</table>";
    }

   public function dashboard()
    {
        $db = \Config\Database::connect();
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
    return view('gol_a/dashboard_kader', [
        'menu' => 'dashboard',
        'judul' => 'Dashboard Kader',
        'nama_puskesmas' => 'Puskesmas Panti, Jember',

        'total_kasus' => 20,
        'kasus_baru' => 2,
        'wilayah' => 6,

        'grafik' => $grafik, // 🔥 TAMBAH
        'dbd' => $dbd        // 🔥 TAMBAH
    ]);}


    public function peta()
    {
        // ... (Logika untuk mengambil data $dbd Anda jika ada) ...
        
        $data = [
            'title' => 'Peta Sebaran DBD',
            'judul' => 'Peta Sebaran',
            'menu'  => 'peta_sebaran', // <--- Harus sama dengan yang ada di pengecekan if ($menu == '...')
            'dbd'   => [] // Isi array data dbd Anda di sini
        ];

        // Ganti 'peta_view' dengan nama file view peta Anda (misalnya 'kader/peta_view')
        return view('gol_a/dashboard_kader', $data); 
    }


    public function skriningdbd()
    {
        return view('gol_a/skrining1');
    }
    public function skriningdbd2()
    {
        $data = $this->request->getPost();
        return view('gol_a/skrining2', $data);
    }
        public function skriningdbd3()
    {
    $nama = $this->request->getPost('nama');
    $jenis_kelamin = $this->request->getPost('jenis_kelamin');
    $tanggal_lahir = $this->request->getPost('tanggal_lahir');
    $kategori_usia = $this->request->getPost('kategori_usia');
    $nik = $this->request->getPost('nik');
    $telepon = $this->request->getPost('telepon');
   $provinsi = $this->request->getPost('provinsi_nama');
$kabupaten = $this->request->getPost('kabupaten_nama');
$kecamatan = $this->request->getPost('kecamatan_nama');
$kelurahan = $this->request->getPost('kelurahan'); // ini sudah nama
if (empty($provinsi) || empty($kabupaten) || empty($kecamatan) || empty($kelurahan)) {
    return redirect()->to('/skriningdbd')->with('error', 'Data wilayah wajib diisi');
}

    // ======================
    // SIMPAN pasien_skrining
    // ======================
$modelWilayah = new \App\Models\WilayahSkriningDbdModel();

$modelWilayah->save([
     'provinsi' => $provinsi ?? '-',
    'kabupaten' => $kabupaten ?? '-',
    'kecamatan' => $kecamatan ?? '-',
    'kelurahan' => $kelurahan ?? '-',
    'rt' => 0,
    'rw' => 0,
    'alamat_lengkap' => $kelurahan . ', ' . $kecamatan . ', ' . $kabupaten
    
]);

$id_wilayah = $modelWilayah->insertID();

 $modelPasien = new \App\Models\PasienSkriningdbdModel();

$modelPasien->save([
    'nik' => $nik,
    'nama_pasien_skrining' => $nama,
    'jenis_kelamin' => $jenis_kelamin,
    'tanggal_lahir' => $tanggal_lahir,
    'usia' => $kategori_usia,
    'no_hp' => $telepon,
    'created_at' => date('Y-m-d H:i:s'),
    'id_wilayah' => $id_wilayah
]);

    $id_pasien_skrining = $modelPasien->insertID();
    // ======================
    // HITUNG SKOR
    // ======================

            $totalSkor = 0;

        $reverse = [14, 15, 16, 17, 18, 19, 20, 21];

        for ($i = 1; $i <= 21; $i++) {
            $nilai = $this->request->getPost("p".$i) ?? 0;

            if (in_array($i, $reverse)) {
                $nilai = ($nilai == 1) ? 0 : 1;
            }

            $totalSkor += $nilai;
        }

        if ($totalSkor >= 0 && $totalSkor <= 6) {
            $hasil = "Kategori Lingkungan Buruk";
            $alasan = "Skor Anda: $totalSkor (0 - 6)";
        }
        elseif ($totalSkor >= 7 && $totalSkor <= 13) {
            $hasil = "Kategori Lingkungan Cukup";
            $alasan = "Skor Anda: $totalSkor (7 - 13)";
        }
        else {
            $hasil = "Kategori Lingkungan Baik";
            $alasan = "Skor Anda: $totalSkor (14 - 21)";
        }

    // ======================
    // SIMPAN tabel skrining
    // ======================

    $modelSkrining = new \App\Models\SkriningdbdModel();
    $p1 = ($this->request->getPost('p1') == 1) ? 'Iya' : 'Tidak';
    $p2 = ($this->request->getPost('p2') == 1) ? 'Iya' : 'Tidak';
    $p3 = ($this->request->getPost('p3') == 1) ? 'Iya' : 'Tidak';
    $p4 = ($this->request->getPost('p4') == 1) ? 'Iya' : 'Tidak';
    $p5 = ($this->request->getPost('p5') == 1) ? 'Iya' : 'Tidak';
    $p6 = ($this->request->getPost('p6') == 1) ? 'Iya' : 'Tidak';
    $p7 = ($this->request->getPost('p7') == 1) ? 'Iya' : 'Tidak';
    $p8 = ($this->request->getPost('p8') == 1) ? 'Iya' : 'Tidak';
    $p9 = ($this->request->getPost('p9') == 1) ? 'Iya' : 'Tidak';
    $p10 = ($this->request->getPost('p10') == 1) ? 'Iya' : 'Tidak';
    $p11 = ($this->request->getPost('p11') == 1) ? 'Iya' : 'Tidak';
    $p12 = ($this->request->getPost('p12') == 1) ? 'Iya' : 'Tidak';
    $p13 = ($this->request->getPost('p13') == 1) ? 'Iya' : 'Tidak';
    $p14 = ($this->request->getPost('p14') == 1) ? 'Iya' : 'Tidak';
    $p15 = ($this->request->getPost('p15') == 1) ? 'Iya' : 'Tidak';
    $p16 = ($this->request->getPost('p16') == 1) ? 'Iya' : 'Tidak';
    $p17 = ($this->request->getPost('p17') == 1) ? 'Iya' : 'Tidak';
    $p18 = ($this->request->getPost('p18') == 1) ? 'Iya' : 'Tidak';
    $p19 = ($this->request->getPost('p19') == 1) ? 'Iya' : 'Tidak';
    $p20 = ($this->request->getPost('p20') == 1) ? 'Iya' : 'Tidak';
    $p21 = ($this->request->getPost('p21') == 1) ? 'Iya' : 'Tidak';
    $modelSkrining->save([
        'id_pasien_skrining' => $id_pasien_skrining,
        'id_penyakit' => 1,
        'tanggal' => date('Y-m-d'),

        'var1' => $p1,
        'var2' => $p2,
        'var3' => $p3,
        'var4' => $p4,
        'var5' => $p5,
        'var6' => $p6,
        'var7' => $p7,
        'var8' => $p8,
        'var9' => $p9,
        'var10' => $p10,
        'var11' => $p11,
        'var12' => $p12,
        'var13' => $p13,
        'var14' => $p14,
        'var15' => $p15,
        'var16' => $p16,
        'var17' => $p17,
        'var18' => $p18,
        'var19' => $p19,
        'var20' => $p20,
        'var21' => $p21,

        'hasil' => $hasil
    ]);

   $data = $this->request->getPost();
$data['provinsi']  = $provinsi;   // sudah berisi nama
$data['kabupaten'] = $kabupaten;
$data['kecamatan'] = $kecamatan;
$data['hasil']     = $hasil;
$data['alasan']    = $alasan;
$data['totalSkor'] = $totalSkor;
return view('gol_a/skrining3', $data);
}
    // Biasaya setelah insert ada return (contoh: return redirect()->to(...);)

public function manajemen_pkm()
{
    // 1. Tambahkan baris koneksi ini
    $db = \Config\Database::connect();
    
    // 2. Gunakan variabel $db (tanpa 'this->') untuk mengambil data dari tabel instansi
    $puskesmas = $db->table('instansi')->get()->getResultArray();

    $data = [
        'title'     => 'Manajemen Puskesmas | SIGAP',
        'judul'     => 'Manajemen Puskesmas',
        'menu'      => 'puskesmas',
        'puskesmas' => $puskesmas
    ];

    return view('gol_a/manajemen_puskesmas', $data);
}

    // 3. Proses Simpan Data
    public function simpan_manajemen_pkm()
    {
        $data = [
            'nama_instansi' => $this->request->getPost('nama_instansi')
        ];

        $this->db->table('instansi')->insert($data);
        return redirect()->to(base_url('manajemen_puskesmas'))->with('success', 'Data berhasil ditambahkan!');
    }

    // 4. Menampilkan Detail
    public function detail_manajemen_pkm($id)
    {
        $puskesmas = $this->db->table('instansi')->where('id_instansi', $id)->get()->getRowArray();

        $data = [
            'title'     => 'Detail Puskesmas | SIGAP',
            'judul'     => 'Detail Puskesmas',
            'menu'      => 'puskesmas',
            'puskesmas' => $puskesmas
        ];

        return view('detail_puskesmas', $data);
    }

    // 5. Menampilkan Form Edit
    public function edit_manajemen_pkm($id)
    {
        $puskesmas = $this->db->table('instansi')->where('id_instansi', $id)->get()->getRowArray();

        $data = [
            'title'     => 'Edit Puskesmas | SIGAP',
            'judul'     => 'Edit Puskesmas',
            'menu'      => 'puskesmas',
            'puskesmas' => $puskesmas
        ];

        return view('edit_puskesmas', $data);
    }

    // 6. Proses Update Data
    public function update_manajemen_pkm($id)
    {
        $data = [
            'nama_instansi' => $this->request->getPost('nama_instansi')
        ];

        $this->db->table('instansi')->where('id_instansi', $id)->update($data);
        return redirect()->to(base_url('manajemen_puskesmas'))->with('success', 'Data berhasil diperbarui!');
    }

    // 7. Proses Hapus Data
    public function hapus_manajemen_pkm($id)
    {
        // Cek relasi ke tabel petugas
        $cekPetugas = $this->db->table('petugas')->where('id_instansi', $id)->countAllResults();
        
        if ($cekPetugas > 0) {
            return redirect()->to(base_url('manajemen_puskesmas'))->with('error', 'Gagal! Puskesmas masih memiliki data petugas.');
        }

        $this->db->table('instansi')->where('id_instansi', $id)->delete();
        return redirect()->to(base_url('manajemen_puskesmas'))->with('success', 'Data berhasil dihapus!');
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

    $builder->join(
        'pasien_skrining p',
        'p.id_pasien_skrining = s.id_pasien_skrining'
    );

    $builder->join(
        'wilayah w',
        'w.id_wilayah = p.id_wilayah'
    );

    $builder->orderBy('s.id_skrining', 'DESC');

    // PAGINATION
    $perPage = 10;
    $page = $this->request->getVar('page') ?? 1;

    $data['skrining'] = $builder
        ->limit($perPage, ($page - 1) * $perPage)
        ->get()
        ->getResultArray();

    // total data
    $total = $db->table('skrining')->countAll();

    // PAGER
    $pager = \Config\Services::pager();

    $data['pagerLinks'] = $pager->makeLinks(
        $page,
        $perPage,
        $total
    );

    $data = [
    'menu' => 'skrining',
    'judul' => 'Rekap Skrining',   
    'skrining' => $data['skrining'],
    'pagerLinks' => $data['pagerLinks']
    ];

    return view('gol_a/rekap_skrining', $data)
    ;
}

public function hapus_skrining(int $id)
{
    $model = new \App\Models\SkriningdbdModel();

    $model->delete($id);

    return redirect()->back()
                     ->with('success', 'Data berhasil dihapus');
}

// ==================================
    // HASIL DATA PASIEN EXPOR PDF EXCEL
    // ==================================

  // ================= buat hasil data pasiennn  =================
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

            SUM(CASE WHEN p.status_akhir = 'Meninggal' THEN 1 ELSE 0 END) as jumlah_kematian,
            COUNT(*) as jumlah
            
        ");

        // JOIN
        $builder->join('wilayah w', 'w.id_wilayah = p.id_wilayah', 'left');

        // FILTER TAHUN
        $builder->where('YEAR(p.tgl_kunjungan)', $tahun);

        // GROUP BY WAJIB (BIAR TIDAK ERROR ONLY_FULL_GROUP_BY)
        $builder->groupBy('MONTH(p.tgl_kunjungan), w.kelurahan');

        // URUT BULAN
        $builder->orderBy('bulan_angka', 'ASC');

        $data = $builder->get()->getResultArray();

        // CONVERT BULAN KE INDONESIA
        $bulanMap = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
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


  // ================= HALAMAN =================
   public function export_hasil_data_pasien()
{
    $type = $this->request->getGet('type');

    $mode = $this->request->getGet('mode');
    $tahun = $this->request->getGet('tahun');
    $waktu = $this->request->getGet('waktu');
    $kelurahan = $this->request->getGet('kelurahan');

    $model = new InputDataPasienModel();
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
                    <th>NIK</th>
                    <th>Nama Pasien</th>
                    <th>Tgl Kunjungan</th>
                    <th>JK</th>
                    <th>Usia</th>
                    <th>Catatan Klinis</th>
                    <th>Alamat Lengkap</th>
                    <th>Kelurahan</th>
                    <th>Kecamatan</th>
                    <th>Kabupaten</th>
                    <th>Provinsi</th>
                    <th>Status Akhir</th>
                    <th>Tindak Lanjut</th>

                </tr>
            ";
            $no = 1;
            //jika data ada:
            if (!empty($data)) {
                foreach ($data as $d) {
                    $alamat =
                        ($d['alamat_lengkap'] ?? '-') .
                        ", RT " . ($d['rt'] ?? '-') .
                        "/RW " . ($d['rw'] ?? '-') ;
                    echo "
                    <tr>
                        <td class='center'>
                            {$no}
                        </td>
                        <td class='center'>
                            {$d['nik']}
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
                        <td class='center'>
                            {$d['kelurahan']}
                        </td>
                        <td class='center'>
                            {$d['kecamatan']}
                        </td>
                        <td class='center'>
                            {$d['kabupaten']}
                        </td>
                        <td class='center'>
                            {$d['provinsi']}
                        </td>
                        <td class='center'>
                            {$d['status_akhir']}
                        </td>
                        <td class='center'>
                            {$d['tindak_lanjut']}
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
                    <td colspan='8' class='center'>
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


// ======================================================
    // ===================== FUNFACT ========================
    // ======================================================

    // =========================
    // LIST FUNFACT
    // =========================

    public function funfact()
    {
        $model = new FunfactModel();

        $keyword = $this->request->getGet('keyword');
        $status  = $this->request->getGet('status');

        $query = $model;

        if (!empty($keyword)) {

            $query = $query
                ->groupStart()
                ->like('judul_funfact', $keyword)
                ->orLike('isi_funfact', $keyword)
                ->orLike('penulis', $keyword)
                ->groupEnd();
        }

        $funfact = $query
            ->orderBy('id_funfact', 'DESC')
            ->findAll();

        $totalUpload = (new FunfactModel())
            ->where('status_funfact', 'upload')
            ->countAllResults();

        $totalDraft = (new FunfactModel())
            ->where('status_funfact', 'draft')
            ->countAllResults();

        $totalFunfact = (new FunfactModel())
            ->countAllResults();

        $data = [

            'judul'        => 'Kelola Funfact',

            'menu'         => 'funfact',

            'penyakit'     => 'dbd',

            'funfact'      => $funfact,

            'status'       => $status,

            'keyword'      => $keyword,

            'totalUpload'  => $totalUpload,

            'totalDraft'   => $totalDraft,

            'totalFunfact' => $totalFunfact
        ];

        return view('gol_a/funfact', $data);
    }

    // =========================
    // FORM UNGGAH / EDIT
    // =========================

    public function unggahfunfact($id = null)
    {
        $funfact = null;

        if ($id != null) {

            $funfact = $this->funfact->find($id);

            if (!$funfact) {

                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        }

        $data = [

            'judul'    => 'Kelola Funfact',

            'menu'     => 'funfact',

            'penyakit' => 'dbd',

            'f'        => $funfact
        ];

        return view('gol_a/unggahfunfact', $data);
    }

    // =========================
    // SIMPAN FUNFACT
    // =========================

 public function simpanFunfact()
{
    $status = $this->request->getPost('status_funfact');

    $gambar = $this->request->getFile('gambar_funfact');
    $namaGambar = null;

    if($gambar && $gambar->isValid() && !$gambar->hasMoved()){

        $namaGambar = $gambar->getRandomName();

        $gambar->move(
            ROOTPATH . 'public/uploads/funfact',
            $namaGambar
        );
    }

    $data = [

        'judul_funfact'     => $this->request->getPost('judul_funfact'),

        'isi_funfact'       => $this->request->getPost('isi_funfact'),

        'deskripsi_funfact' => $this->request->getPost('deskripsi_funfact'),

        'url'               => $this->request->getPost('url'),

        'penulis'           => $this->request->getPost('penulis'),

        'tanggal_funfact'   => $this->request->getPost('tanggal_funfact'),

        'status_funfact'    => $status,
    ];

    // upload gambar
    if ($namaGambar) {
        $data['gambar_funfact'] = $namaGambar;
    }

    // simpan data
    $this->funfact->insert($data);

    // ambil id terbaru
    $id = $this->funfact->getInsertID();

    /* =========================
       JIKA DRAFT
    ========================= */

    if($status == 'draft'){

        return redirect()->to(
            base_url('funfact?status=draft')
        )->with(
            'success',
            'Funfact berhasil disimpan ke draft'
        );
    }

    /* =========================
       JIKA KLIK LIHAT TAMPILAN
    ========================= */

    if($this->request->getPost('redirect_view')){

        return redirect()->to(
            base_url('funfact/view/'.$id)
        );
    }

    /* =========================
       DEFAULT -> KE KELOLA FUNFACT
    ========================= */

    return redirect()->to(
        base_url('funfact?status=upload')
    )->with(
        'success',
        'Funfact berhasil diunggah'
    );
}

    // =========================
    // EDIT
    // =========================

    public function editFunfact(int $id)
    {
        $f = $this->funfact
            ->where('id_funfact', $id)
            ->first();

        if (!$f) {

            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('gol_a/unggahfunfact', [

            'judul'    => 'Kelola Funfact',

            'menu'     => 'funfact',

            'penyakit' => 'dbd',

            'f'        => $f
        ]);
    }

    // =========================
    // UPDATE
    // =========================

    public function updateFunfact(int $id)
{
    $funfact = $this->funfact->find($id);

    if (!$funfact) {
        return redirect()->to(base_url('funfact'))
            ->with('error', 'Data funfact tidak ditemukan');
    }

    $status = $this->request->getPost('status_funfact');

    $data = [
        'judul_funfact'     => $this->request->getPost('judul_funfact'),
        'isi_funfact'       => $this->request->getPost('isi_funfact'),
        'deskripsi_funfact' => $this->request->getPost('deskripsi_funfact'),
        'url'               => $this->request->getPost('url'),
        'penulis'           => $this->request->getPost('penulis'),
        'tanggal_funfact'   => $this->request->getPost('tanggal_funfact'),
        'status_funfact'    => $status
    ];

    /* =========================
       UPDATE GAMBAR
    ========================= */
    $gambar = $this->request->getFile('gambar_funfact');

    if ($gambar && $gambar->isValid() && !$gambar->hasMoved()) {

        $namaGambar = $gambar->getRandomName();

        $gambar->move(FCPATH . 'uploads/funfact', $namaGambar);

        $data['gambar_funfact'] = $namaGambar;

        if (!empty($funfact['gambar_funfact'])) {
            $path = FCPATH . 'uploads/funfact/' . $funfact['gambar_funfact'];
            if (file_exists($path)) {
                unlink($path);
            }
        }
    }

    $this->funfact->update($id, $data);

  /* =========================
   REDIRECT SESUAI STATUS
========================= */

if ($status == 'draft') {

    return redirect()->to(base_url('funfact?status=draft'))
        ->with('success', 'Funfact berhasil disimpan ke draft');
}

/* =========================
   JIKA KLIK LIHAT TAMPILAN
========================= */

if($this->request->getPost('redirect_view'))
{
    return redirect()->to(
        base_url('funfact/view/'.$id)
    );
}

/* =========================
   JIKA DARI DRAFT -> UPLOAD
========================= */

if($funfact['status_funfact'] == 'draft' && $status == 'upload')
{
    return redirect()->to(base_url('funfact?status=upload'))
        ->with('success', 'Funfact berhasil diunggah');
}

/* =========================
   EDIT FUNFACT UPLOAD
========================= */

return redirect()->to(base_url('funfact?status=upload'))
    ->with('success', 'Funfact berhasil diperbarui');
}

    // =========================
    // HAPUS
    // =========================

    public function hapusFunfact(int $id)
{
    $funfact = $this->funfact->find($id);

    if ($funfact) {

        if (!empty($funfact['gambar_funfact'])) {

            $path = FCPATH . 'uploads/funfact/' . $funfact['gambar_funfact'];

            if (file_exists($path)) {
                unlink($path);
            }
        }

        $this->funfact->delete($id);

        $status = $funfact['status_funfact'];

        return redirect()->to(base_url('funfact?status='.$status))
            ->with('success', 'Funfact berhasil dihapus');
    }

    return redirect()->to(base_url('funfact'))
        ->with('error', 'Funfact tidak ditemukan');
}

    // =========================
    // UPLOAD FUNFACT
    // =========================

    public function uploadFunfact(int $id)
    {
        $model = new FunfactModel();

        $model->update($id, [
            'status_funfact' => 'upload'
        ]);

        return redirect()->to(site_url('funfact?status=upload'))
            ->with('success', 'Funfact berhasil diunggah');
    }

/* =========================
        VIEW
========================= */

 public function view(int $id)
{
    $funfact = $this->funfact->find($id);

    // cek data ada atau tidak
    if (!$funfact) {

        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
            'Data funfact tidak ditemukan'
        );
    }

    return view('gol_a/view_funfact', [

        'judul'    => 'FunFact',

        'menu'     => 'funfact',

        'penyakit' => 'dbd',

        'funfact'  => $funfact
    ]);
}
public function Funfactview(int $id)
{
    $funfact = $this->funfact->find($id);

    // cek data ada atau tidak
    if (!$funfact) {

        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
            'Data funfact tidak ditemukan'
        );
    }

    return view('gol_a/berita/funfact_user', [

        'judul'    => 'FunFact',

        'menu'     => 'funfact',

        'penyakit' => 'dbd',

        'funfact'  => $funfact
    ]);
}


/* =========================
SIMPAN KE DRAFT
========================= */

public function simpanDraft(int $id)
{
    $funfact = $this->funfact->find($id);

    if(!$funfact)
    {
        return redirect()->to(base_url('funfact'));
    }

    $this->funfact->update($id, [

        'status_funfact' => 'draft'
    ]);

    return redirect()->to(base_url('funfact?status=draft'));
}

// ===============================
    // REKAP PELAPORAN KADER DI ADMIN
    // ===============================
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
            'tahunAktif' => $tahun,

            'menu' => 'pelaporan_kader',
            'judul' => 'Pelaporan Kader'
        ];

        return view('gol_a/daftar_laporan_kader_admin/rekap_kader', $data);
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
            ->where('YEAR(created_at)', $tahun)
            ->findAll();
        $dataLaporan = [];
        foreach ($laporanDb as $row) {
            $dataLaporan[$row['minggu']][$row['id_posyandu']] = $row['id_laporan'];
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

        return view('gol_a/daftar_laporan_kader_admin/daftar_laporan', $data);
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
    $builder = $builder->where('YEAR(created_at)', $tahun);

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

    return view('gol_a/daftar_laporan_kader_admin/rekap_kader', $data);
}

    public function view_laporan(int $id)
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

        return view('gol_a/daftar_laporan_kader_admin/view_laporan', $data);
    }

}