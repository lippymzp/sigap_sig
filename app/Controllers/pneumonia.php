<?php

namespace App\Controllers;

use App\Models\InputDataPasienModel;
use App\Models\wilayahskriningpneumonia;
use App\Models\PasienPneumoniaModel;
use App\Models\SkriningPneumoniaModel;

class Pneumonia extends BaseController
{

    public function inputData()
    {
        return view('gol_c/input_data', [
            'menu' => 'inputdata',
            'penyakit' => 'pneumonia',
            'judul' => 'Input Data Pasien'
        ]);
    }

    public function hasil_data()
    {
        $pasien = session()->get('pasien') ?? [];

        return view('gol_c/hasil_data_pasien/hasil_data_c', [
            'menu' => 'hasil',
            'penyakit' => 'pneumonia',
            'judul' => 'Hasil Data Pasien',
            'pasien' => $pasien
        ]);
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

            SUM(CASE WHEN p.umur <= 18 THEN 1 ELSE 0 END) as anak,
            SUM(CASE WHEN p.umur >= 19 THEN 1 ELSE 0 END) as dewasa,

            SUM(CASE WHEN p.jenis_kelamin = 'Laki-laki' THEN 1 ELSE 0 END) as laki,
            SUM(CASE WHEN p.jenis_kelamin = 'Perempuan' THEN 1 ELSE 0 END) as perempuan,

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

        $model = new \App\Models\InputDataPasienModel();
        $data = $model->getDataExport($mode, $tahun, $waktu, $kelurahan);

        // kalau belum klik export → tampilkan halaman filter
        if (!$type) {
            return view('gol_c/hasil_data_pasien/export_hasil_data_pasien', [
                'menu' => 'export_hasil_data_pasien',
                'penyakit' => 'pneumonia',
                'judul' => 'Eksport Data Pasien',
                'data' => $data //
            ]);
        }

    // EXPORT EXCEL
        if ($type == 'excel') {

        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=data_pasien.xls");

        echo "<html>";
        echo "<head>
                <meta charset='UTF-8'>
                <style>
                    body { font-family: Arial; font-size: 12px; }
                    h2 { text-align: center; }
                    .sub { text-align: center; font-size: 11px; margin-bottom: 10px; }
                    table { border-collapse: collapse; width: 100%; }
                    th { background: #2c3e50; color: #fff; padding: 6px; }
                    td { border: 1px solid #ddd; padding: 5px; }
                    .center { text-align: center; }
                </style>
            </head>";

        echo "<body>";

        // Judul
        echo "<h2>DATA PASIEN DBD</h2>";
        echo "<div class='sub'>Hasil Export Berdasarkan Filter</div>";

        // Tabel
        echo "<table border='1'>";
        echo "<tr>
                <th>No</th>
                <th>No RM</th>
                <th>Nama</th>
                <th>Tanggal</th>
                <th>JK</th>
                <th>Usia</th>
                <th>Kelurahan</th>
                <th>Kecamatan</th>
                <th>Alamat</th>
            </tr>";

        $no = 1;

        if (!empty($data)) {
            foreach ($data as $d) {
                echo "<tr>
                        <td class='center'>{$no}</td>
                        <td>{$d['no_rm']}</td>
                        <td>{$d['nama_pasien']}</td>
                        <td class='center'>{$d['tgl_kunjungan']}</td>
                        <td class='center'>{$d['jenis_kelamin']}</td>
                        <td class='center'>{$d['umur']}</td>
                        <td>{$d['kelurahan']}</td>
                        <td>{$d['kecamatan']}</td>
                        <td>{$d['alamat_lengkap']}</td>
                    </tr>";
                $no++;
            }
        } else {
            echo "<tr>
                    <td colspan='9' class='center'>Data tidak tersedia</td>
                </tr>";
        }

        echo "</table>";
        echo "</body></html>";

        exit;
        }

        // EXPORT PDF
        if ($type == 'pdf') {
            $html = view('gol_c/hasil_data_pasien/export_pdf_pasien', ['data' => $data]);

            $dompdf = new \Dompdf\Dompdf();
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'landscape');
            $dompdf->render();
            $dompdf->stream("data_pasien.pdf", ["Attachment" => true]);
            exit;
        }
    }

    public function simpandatapasien()
    {
        $model = new InputDataPasienModel();

        $data = [

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


public function skriningpneumonia()
{
    return view('gol_c/skrining1');
}

public function skriningpneumonia2()
{
    $data = $this->request->getPost();

    return view('gol_c/skrining2', $data);
}

public function rekap_skrining()
{
    $db = \Config\Database::connect();

    $builder = $db->table('skrining s');

    $builder->select('
        s.id_skrining,
        s.hasil,
        s.tanggal,

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
        w.rw
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

    // =========================
    // PAGINATION
    // =========================

    $perPage = 10;
    $page = (int) ($this->request->getVar('page') ?? 1);

    // total data
    $totalBuilder = clone $builder;
    $total = $totalBuilder->countAllResults(false);

    // data tabel
    $skrining = $builder
        ->limit($perPage, ($page - 1) * $perPage)
        ->get()
        ->getResultArray();

    // =========================
    // OVERVIEW
    // =========================

    // skrining hari ini
    $skriningHariIni = $db->table('skrining')
        ->where('DATE(tanggal)', date('Y-m-d'))
        ->countAllResults();

    // total seluruh skrining
    $totalSkrining = $db->table('skrining')
        ->countAll();

    // risiko tinggi
    $risikoTinggi = $db->table('skrining')
        ->where('hasil', 'Risiko Tinggi')
        ->countAllResults();

    // risiko rendah
    $risikoRendah = $db->table('skrining')
        ->where('hasil', 'Risiko Rendah')
        ->countAllResults();

    // =========================
    // PAGER
    // =========================

    $pager = \Config\Services::pager();

    $pagerLinks = $pager->makeLinks(
        $page,
        $perPage,
        $total
    );

    // =========================
    // DATA VIEW
    // =========================

    $data = [
        'menu' => 'skrining',
        'judul' => 'Rekap Skrining',

        // tabel
        'skrining' => $skrining,

        // pagination
        'pagerLinks' => $pagerLinks,

        // overview
        'skriningHariIni' => $skriningHariIni,
        'totalSkrining' => $totalSkrining,
        'risikoTinggi' => $risikoTinggi,
        'risikoRendah' => $risikoRendah
    ];

    return view('gol_a/rekap_skrining', $data);
}

public function skriningpneumonia3()
{
    $nama = $this->request->getPost('nama');
    $jenis_kelamin = $this->request->getPost('jenis_kelamin');
    $tanggal_lahir = $this->request->getPost('tanggal_lahir');
    $kategori_usia = $this->request->getPost('kategori_usia');
    $nik = $this->request->getPost('nik');
    $telepon = $this->request->getPost('telepon');

    // ======================
    // WILAYAH
    // ======================

    $provinsi  = $this->request->getPost('provinsi_nama');
    $kabupaten = $this->request->getPost('kabupaten_nama');
    $kecamatan = $this->request->getPost('kecamatan_nama');
    $kelurahan = $this->request->getPost('kelurahan_nama');

    if (
        empty($provinsi) ||
        empty($kabupaten) ||
        empty($kecamatan) ||
        empty($kelurahan)
    ) {
        return redirect()->to('/skriningpneumonia')
            ->with('error', 'Data wilayah wajib diisi');
    }

    // ======================
    // SIMPAN WILAYAH
    // ======================

    $modelWilayah = new \App\Models\wilayahskriningpneumonia();

    $modelWilayah->save([
        'provinsi' => $provinsi,
        'kabupaten' => $kabupaten,
        'kecamatan' => $kecamatan,
        'kelurahan' => $kelurahan,
        'rt' => 0,
        'rw' => 0,
        'alamat_lengkap' =>
            $kelurahan . ', ' .
            $kecamatan . ', ' .
            $kabupaten . ', ' .
            $provinsi
    ]);

    $id_wilayah = $modelWilayah->insertID();

    // ======================
    // SIMPAN PASIEN
    // ======================

    $modelPasien = new \App\Models\PasienPneumoniaModel();

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
    // LOAD DATASET CSV
    // ======================

    $datasetPath = FCPATH . 'dataset/pneumonia.csv';

    $dataTraining = [];

    if (($handle = fopen($datasetPath, "r")) !== FALSE) {

        $header = fgetcsv($handle, 1000, ";");

        while (($row = fgetcsv($handle, 1000, ";")) !== FALSE) {

            $dataTraining[] = [
                'p1'  => trim($row[0]),
                'p2'  => trim($row[1]),
                'p3'  => trim($row[2]),
                'p4'  => trim($row[3]),
                'p5'  => trim($row[4]),
                'p6'  => trim($row[5]),
                'p7'  => trim($row[6]),
                'p8'  => trim($row[7]),
                'p9'  => trim($row[8]),
                'p10' => trim($row[9]),
                'p11' => trim($row[10]),
                'hasil' => trim($row[11])
            ];
        }

        fclose($handle);
    }

    // ======================
    // INPUT USER
    // ======================

    $input = [
        'p1'  => ($this->request->getPost('p1') == 1) ? 'Iya' : 'Tidak',
        'p2'  => ($this->request->getPost('p2') == 1) ? 'Iya' : 'Tidak',
        'p3'  => ($this->request->getPost('p3') == 1) ? 'Iya' : 'Tidak',
        'p4'  => ($this->request->getPost('p4') == 1) ? 'Iya' : 'Tidak',
        'p5'  => ($this->request->getPost('p5') == 1) ? 'Iya' : 'Tidak',
        'p6'  => ($this->request->getPost('p6') == 1) ? 'Iya' : 'Tidak',
        'p7'  => ($this->request->getPost('p7') == 1) ? 'Iya' : 'Tidak',
        'p8'  => ($this->request->getPost('p8') == 1) ? 'Iya' : 'Tidak',
        'p9'  => ($this->request->getPost('p9') == 1) ? 'Iya' : 'Tidak',
        'p10' => ($this->request->getPost('p10') == 1) ? 'Iya' : 'Tidak',
        'p11' => ($this->request->getPost('p11') == 1) ? 'Iya' : 'Tidak',
    ];

    // ======================
    // FUNCTION ENTROPY
    // ======================

    function entropy($data)
    {
        $total = count($data);

        if ($total == 0) {
            return 0;
        }

        $berisiko = 0;
        $tidak = 0;

        foreach ($data as $d) {

            if ($d['hasil'] == 'Berisiko') {
                $berisiko++;
            } else {
                $tidak++;
            }
        }

        $p1 = $berisiko / $total;
        $p2 = $tidak / $total;

        $entropy = 0;

        if ($p1 > 0) {
            $entropy -= $p1 * log($p1, 2);
        }

        if ($p2 > 0) {
            $entropy -= $p2 * log($p2, 2);
        }

        return $entropy;
    }

    // ======================
    // HITUNG ENTROPY TOTAL
    // ======================

    $entropyTotal = entropy($dataTraining);

    // ======================
    // HITUNG GAIN
    // ======================

    $gainList = [];

    for ($i = 1; $i <= 11; $i++) {

        $atribut = 'p' . $i;

        $iya = [];
        $tidak = [];

        foreach ($dataTraining as $row) {

            if ($row[$atribut] == 'Iya') {
                $iya[] = $row;
            } else {
                $tidak[] = $row;
            }
        }

        $totalData = count($dataTraining);

        $entropyIya = entropy($iya);
        $entropyTidak = entropy($tidak);

        $gain =
            $entropyTotal -
            ((count($iya) / $totalData) * $entropyIya) -
            ((count($tidak) / $totalData) * $entropyTidak);

        $gainList[$atribut] = $gain;
    }

    // ======================
    // ATRIBUT TERBAIK
    // ======================

    arsort($gainList);

    $atributTerbaik = array_key_first($gainList);

    // ======================
    // FILTER DATA SESUAI INPUT
    // ======================

    $matching = [];

    foreach ($dataTraining as $row) {

        if ($row[$atributTerbaik] == $input[$atributTerbaik]) {
            $matching[] = $row;
        }
    }

    // ======================
    // VOTING HASIL
    // ======================

    $jumlahBerisiko = 0;
    $jumlahTidak = 0;

    foreach ($matching as $m) {

        if ($m['hasil'] == 'Berisiko') {
            $jumlahBerisiko++;
        } else {
            $jumlahTidak++;
        }
    }

    if ($jumlahBerisiko >= $jumlahTidak) {

        $hasil = 'Berisiko Pneumonia';
        $hasilDatabase = 'Berisiko';

    } else {

        $hasil = 'Tidak Berisiko Pneumonia';
        $hasilDatabase = 'Tidak Berisiko';
    }

    // ======================
    // DETAIL
    // ======================

    $alasan =
        "Atribut terbaik: " . $atributTerbaik .
        " | Gain: " . round($gainList[$atributTerbaik], 4) .
        " | Berisiko: " . $jumlahBerisiko .
        " | Tidak Berisiko: " . $jumlahTidak;

    // ======================
    // VARIABEL SAVE
    // ======================

    $p1  = $input['p1'];
    $p2  = $input['p2'];
    $p3  = $input['p3'];
    $p4  = $input['p4'];
    $p5  = $input['p5'];
    $p6  = $input['p6'];
    $p7  = $input['p7'];
    $p8  = $input['p8'];
    $p9  = $input['p9'];
    $p10 = $input['p10'];
    $p11 = $input['p11'];

    // ======================
    // SIMPAN HASIL SKRINING
    // ======================

    $modelSkrining = new \App\Models\SkriningPneumoniaModel();

    $modelSkrining->save([

        'id_pasien_skrining' => $id_pasien_skrining,
        'id_penyakit' => 3,
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

        'hasil' => $hasilDatabase
    ]);

    // ======================
    // KIRIM KE VIEW
    // ======================

    $data = $this->request->getPost();

    $data['provinsi'] = $provinsi;
    $data['kabupaten'] = $kabupaten;
    $data['kecamatan'] = $kecamatan;
    $data['kelurahan'] = $kelurahan;

    $data['hasil'] = $hasil;
    $data['alasan'] = $alasan;

    $data['gainList'] = $gainList;
    $data['atributTerbaik'] = $atributTerbaik;

    return view('gol_c/skrining3', $data);
}

   
    public function export()
    {
        $pasien =
            session()->get('pasien') ?? [];

        header(
            "Content-Type: application/vnd.ms-excel"
        );

        header(
            "Content-Disposition: attachment; filename=data_pasien.xls"
        );

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

    return view('gol_c/rekap_skrining', $data)
    ;
}

public function hapus_skrining(int $id)
{
    $model = new \App\Models\SkriningPneumoniaModel();

    $model->delete($id);

    return redirect()->back()
                     ->with('success', 'Data berhasil dihapus');
}
}