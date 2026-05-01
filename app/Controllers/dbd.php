<?php

namespace App\Controllers;
use App\Models\InputDataPasienModel;
use Dompdf\Dompdf;
use Dompdf\Options;
class Dbd extends BaseController
{
    public function inputData()
    {
        return view('gol_a/input_data', [
            'menu' => 'inputdata',
            'penyakit' => 'dbd',
            'judul' => 'Input Data Pasien'
        ]);
    }

    public function hasil_data()
    {
        $pasien = session()->get('pasien') ?? [];

        return view('gol_a/hasil_data_a', [
            'menu' => 'hasil',
            'penyakit' => 'dbd',
            'judul' => 'Hasil Data Pasien',
            'pasien' => $pasien
        ]);
    }

   public function simpandatapasien()
    {
        $model = new InputDataPasienModel();

        // ambil semua data dari form
        $data = $this->request->getPost();

        // 🔥 panggil model (di sinilah insert terjadi)
        $success = $model->simpanSemua($data);

        // 🔥 respon hasil
        if ($success) {
            return redirect()->back()->with('success', 'Data pasien & wilayah berhasil disimpan');
        } else {
            return redirect()->back()->with('error', 'Gagal menyimpan data');
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

   public function formulirpsn()
{
  
    $data = [
        'title' => 'Pelaporan Kader',
        'judul' => 'Peta Sebaran',
        'menu'  => 'formulirpsn', // <--- TAMBAHKAN BARIS INI
        // data lain yang mungkin Anda kirim...
    ];

    return view('gol_a/formkader/formulir', $data);
}

    public function simpanpsn()
    {
        $session = session();
        $data = $this->request->getPost();

        $file = $this->request->getFile('foto');

        if ($file && $file->isValid()) {
            $namaFile = $file->getRandomName();
            $file->move('uploads/', $namaFile);
            $data['foto'] = $namaFile;
        }

        $laporanpsn = $session->get('laporanpsn') ?? [];

        $laporanpsn[$data['posyandu']] = [
            'kelurahan'    => $data['kelurahan'],
            'tanggalinput' => date('Y-m-d'),
            'diperiksa'    => $data['diperiksa'],
            'positif'      => $data['positif'],
            'bagian'       => $data['bagian'],
            'foto'         => $data['foto'] ?? null
        ];

        $session->set('laporanpsn', $laporanpsn);

        return redirect()->to('formkader/formulir');
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
        $kelFilter = strtolower($this->request->getGet('kelurahan'));
        $posFilter = strtolower($this->request->getGet('posyandu'));

        $filtered = [];
        $totalPositif = 0;
        $totalDiperiksa = 0;

        foreach ($posyandu as $pos) {

            $data = $laporanpsn[$pos] ?? null;
            $status = $data ? 'sudah' : 'belum';

            // filter posyandu
            if ($posFilter && strpos(strtolower($pos), $posFilter) === false) continue;

            // filter status
            if ($statusFilter && $status != $statusFilter) continue;

            // filter kelurahan
            if ($kelFilter && strpos(strtolower($data['kelurahan'] ?? ''), $kelFilter) === false) continue;

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
    public function detailpsn(int $pos)
    {
        $session = session();
        $laporanpsn = $session->get('laporanpsn') ?? [];

        return view('gol_a/formkader/detail', [
            'pos' => $pos,
            'data' => $laporanpsn[$pos] ?? null
        ]);
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
        return view('gol_a/dashboard_kader', [
            'menu' => 'dashboard_kader',
            'penyakit' => 'dbd'
        ]);
    }

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
        return view('gol_a/peta_sebaran_kader', $data); 
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

    $kabupaten = $this->request->getPost('kabupaten');
    $kecamatan = $this->request->getPost('kecamatan');
    $kelurahan = $this->request->getPost('kelurahan');

    // ======================
    // SIMPAN pasien_skrining
    // ======================

 $modelPasien = new \App\Models\PasienSkriningdbdModel();

$modelPasien->save([
    'nama_pasien_skrining' => $nama,
    'jenis_kelamin' => $jenis_kelamin,
    'tanggal_lahir' => $tanggal_lahir,
    'usia' => $kategori_usia,
    'alamat' => $kelurahan . ', ' . $kecamatan . ', ' . $kabupaten,
    'created_at' => date('Y-m-d H:i:s'),
    'id_wilayah' => 1
]);

    $id_pasien_skrining = $modelPasien->insertID();

    // ======================
    // HITUNG SKOR
    // ======================

            $totalSkor = 0;

        $reverse = [14, 15, 16, 17, 18, 19, 20];

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
    $data['hasil'] = $hasil;
    $data['alasan'] = $alasan;
    $data['totalSkor'] = $totalSkor;
    return view('gol_a/skrining3', $data);
}

public function rekap_skrining()
{
    $db = \Config\Database::connect();

    $builder = $db->table('skrining as s');
    $builder->select('
        s.id_skrining,
        p.nama_pasien_skrining,
        p.jenis_kelamin,
        p.usia,
        p.alamat,
        s.hasil,
        s.tanggal
        
    ');
    $builder->join(
        'pasien_skrining p',
        'p.id_pasien_skrining = s.id_pasien_skrining'
    );
    $builder->orderBy('s.id_skrining', 'DESC');

    $data['skrining'] = $builder->get()->getResultArray();
    $data['title'] = 'Rekap Skrining';

    return view('gol_a/rekap_skrining', $data);
}
// ================= HALAMAN EXPORT =================
public function export_hasil_data_pasien()
{
    helper('url');

    $data['data'] = [
        [
            'kecamatan' => 'Sumbersari',
            'desa' => 'Tegal Gede',
            'jenis_kelamin' => 1,
            'umur' => 21,
            'kasus_baru' => 2,
            'total_kasus' => 10
        ],
        [
            'kecamatan' => 'Kaliwates',
            'desa' => 'Kebon Agung',
            'jenis_kelamin' => 0,
            'umur' => 35,
            'kasus_baru' => 1,
            'total_kasus' => 5
        ],
        [
            'kecamatan' => 'Sumbersari',
            'desa' => 'Sumbersari',
            'jenis_kelamin' => 1,
            'umur' => 18,
            'kasus_baru' => 3,
            'total_kasus' => 12
        ]
    ];

    return view('gol_a/export_hasil_data_pasien', $data);
}
// ================= EXPORT PDF =================
public function export_pdf_pasien()
{
    helper('url');

    $data = [
        'data' => [
            [
                'kecamatan' => 'Sumbersari',
                'desa' => 'Tegal Gede',
                'jenis_kelamin' => 1,
                'umur' => 21,
                'kasus_baru' => 2,
                'total_kasus' => 10
            ],
            [
                'kecamatan' => 'Kaliwates',
                'desa' => 'Kebon Agung',
                'jenis_kelamin' => 0,
                'umur' => 35,
                'kasus_baru' => 1,
                'total_kasus' => 5
            ]
        ]
    ];

    $html = view('gol_a/export_pdf_pasien', $data);

    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    $dompdf->stream("data_pasien.pdf", ["Attachment" => false]);
}
// ================= EXPORT EXCEL =================
public function export_excel_pasien()
{
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=export_hasil_data_pasien.xls");

    $data = [
        [
            'kecamatan' => 'Sumbersari',
            'desa' => 'Tegal Gede',
            'jenis_kelamin' => 1,
            'umur' => 21,
            'kasus_baru' => 2,
            'total_kasus' => 10
        ],
        [
            'kecamatan' => 'Kaliwates',
            'desa' => 'Kebon Agung',
            'jenis_kelamin' => 0,
            'umur' => 35,
            'kasus_baru' => 1,
            'total_kasus' => 5
        ]
    ];

    echo "<table border='1'>";
    echo "<tr>
            <th>No</th>
            <th>Kecamatan</th>
            <th>Kelurahan</th>
            <th>Jenis Kelamin</th>
            <th>Umur</th>
            <th>Kasus Baru</th>
            <th>Total Kasus</th>
          </tr>";

    $no = 1;
    foreach ($data as $d) {
        $jk = ($d['jenis_kelamin'] == 1) ? 'Perempuan' : 'Laki-laki';

        echo "<tr>
                <td>{$no}</td>
                <td>{$d['kecamatan']}</td>
                <td>{$d['desa']}</td>
                <td>{$jk}</td>
                <td>{$d['umur']}</td>
                <td>{$d['kasus_baru']}</td>
                <td>{$d['total_kasus']}</td>
              </tr>";

        $no++;
    }

    echo "</table>";
    exit;
}
}





