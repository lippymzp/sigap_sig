<?php

namespace App\Controllers;

use Dompdf\Dompdf;
use App\Models\SkriningModel;
use App\Libraries\DiareDecisionTree;
use App\Models\PasienSkriningModel;
use App\Models\BeritaModelDD;
use App\Models\FunfactModelD;

// use Dompdf\Dompdf;
// use App\Models\SkriningModel;
// use App\Libraries\DiareDecisionTree;
// use App\Models\PasienSkriningModel;
// use App\Models\BeritaModelDD;
//

class Diare extends BaseController
{
    // =========================
    // STEP 1 - FORM IDENTITAS
    // =========================
    public function skrining()
    {
        session()->remove('skrining_diare');
        return view('gol_d/skrining_diare');
    }

    // =========================
    // STEP 2 - IDENTITAS -> PERTANYAAN 1
    // =========================
    public function step2()
    {
        $identitas = $this->request->getPost();

        if (empty($identitas)) {
            return redirect()->back()->with('error', 'Data identitas belum diisi');
        }

        session()->set('skrining_diare', [
            'identitas' => $identitas,
            'jawaban'   => []
        ]);

        return view('gol_d/pertanyaan_diare_1');
    }

    // =========================
    // STEP 3 - PERTANYAAN 1-5 -> 6-10
    // =========================
 public function step3()
{
    $session = session()->get('skrining_diare');

    if (!$session) {
        return redirect()->to('/skrining-diare');
    }

    $jawabanBaru = $this->request->getPost();

    $session['jawaban'] = array_merge(
        $session['jawaban'],
        $jawabanBaru
    );

    session()->set('skrining_diare', $session);

    /*
    CEK DIARE DULU
    */
    $tree = new DiareDecisionTree();
    $prediksi = $tree->predict($session['jawaban']);

    /*
    Kalau tidak diare → langsung hasil
    */
    if ($prediksi['diare'] === 'Tidak Diare') {
        return redirect()->to('/skrining-diare-hasil');
    }

    /*
    Kalau diare → lanjut dehidrasi
    */
    return view('gol_d/pertanyaan_diare_2');
}

    // =========================
    // STEP 4 - PERTANYAAN 6-10 -> 11-15
    // =========================
    public function step4()
    {
        $session = session()->get('skrining_diare');

        if (!$session) {
            return redirect()->to('/skrining-diare');
        }

        $jawabanBaru = $this->request->getPost();

        $session['jawaban'] = array_merge(
            $session['jawaban'],
            $jawabanBaru
        );

        session()->set('skrining_diare', $session);

        return view('gol_d/pertanyaan_diare_3');
    }

    public function hasil()
{
    $session = session()->get('skrining_diare');

    if (!$session || !isset($session['identitas'])) {
        return redirect()->to('/skrining-diare');
    }

    $jawabanBaru = $this->request->getPost();

    $semuaJawaban = array_merge(
        $session['jawaban'],
        $jawabanBaru
    );

    $identitas = $session['identitas'];

    // =========================
    // DECISION TREE
    // =========================
    $tree = new DiareDecisionTree();
$prediksi = $tree->predict($semuaJawaban);

$statusDiare = $prediksi['diare'];
$statusDehidrasi = $prediksi['dehidrasi'];

$hasil = $statusDiare . ' | Dehidrasi: ' . $statusDehidrasi;

$warna = 'info';

if ($statusDiare === 'Tidak Diare') {
    $rekomendasi = 'Gejala Anda tidak memenuhi kriteria diare. Tetap jaga hidrasi, pola makan sehat, dan pantau kondisi tubuh.';
}

elseif ($statusDehidrasi === 'Berat') {
    $warna = 'danger';
    $rekomendasi = 'Terdapat indikasi dehidrasi berat. Segera ke fasilitas kesehatan untuk penanganan medis dan rehidrasi intensif.';
}

elseif ($statusDehidrasi === 'Sedang') {
    $warna = 'warning';
    $rekomendasi = 'Terdapat indikasi dehidrasi sedang. Disarankan rehidrasi oral menggunakan oralit, banyak minum, dan observasi kondisi.';
}

elseif ($statusDehidrasi === 'Ringan') {
    $warna = 'primary';
    $rekomendasi = 'Terdapat indikasi dehidrasi ringan. Perbanyak cairan, istirahat cukup, dan konsumsi makanan yang mudah dicerna.';
}

else {
    $warna = 'success';
    $rekomendasi = 'Anda mengalami diare tanpa tanda dehidrasi signifikan. Tetap jaga cairan tubuh dan pola makan sehat.';
}

$pasienModel = new PasienSkriningModel();
$skriningModel = new SkriningModel();
/*
|-----------------------------------
| SIMPAN IDENTITAS PASIEN
|-----------------------------------
*/
$pasienModel->insert([
    'nik' => $identitas['nik'] ?? '',
    'nama_pasien_skrining' => $identitas['nama'] ?? '',
    'jenis_kelamin' => $identitas['jk'] ?? '',
    'tanggal_lahir' => $identitas['tgl'] ?? '',
    'usia' => $identitas['usia'] ?? '',
    'no_hp' => $identitas['hp'] ?? '',
    'id_wilayah' => 1
]);

$idPasien = $pasienModel->getInsertID();


/*
|-----------------------------------
| SIMPAN HASIL SKRINING
|-----------------------------------
*/
$skriningModel->insert([
    'id_pasien_skrining' => $idPasien,
    'id_penyakit'        => 4,
    'tanggal'            => date('Y-m-d'),

    'var1'  => ($semuaJawaban['q0'] ?? 0) ? 'Iya' : 'Tidak',
    'var2'  => ($semuaJawaban['q1'] ?? 0) ? 'Iya' : 'Tidak',
    'var3'  => ($semuaJawaban['q2'] ?? 0) ? 'Iya' : 'Tidak',
    'var4'  => ($semuaJawaban['q3'] ?? 0) ? 'Iya' : 'Tidak',
    'var5'  => ($semuaJawaban['q4'] ?? 0) ? 'Iya' : 'Tidak',
    'var6'  => ($semuaJawaban['q5'] ?? 0) ? 'Iya' : 'Tidak',
    'var7'  => ($semuaJawaban['q6'] ?? 0) ? 'Iya' : 'Tidak',
    'var8'  => ($semuaJawaban['q7'] ?? 0) ? 'Iya' : 'Tidak',
    'var9'  => ($semuaJawaban['q8'] ?? 0) ? 'Iya' : 'Tidak',
    'var10' => ($semuaJawaban['q9'] ?? 0) ? 'Iya' : 'Tidak',
    'var11' => ($semuaJawaban['q10'] ?? 0) ? 'Iya' : 'Tidak',
    'var12' => ($semuaJawaban['q11'] ?? 0) ? 'Iya' : 'Tidak',
    'var13' => ($semuaJawaban['q12'] ?? 0) ? 'Iya' : 'Tidak',
    'var14' => ($semuaJawaban['q13'] ?? 0) ? 'Iya' : 'Tidak',
    'var15' => ($semuaJawaban['q14'] ?? 0) ? 'Iya' : 'Tidak',

    'hasil' => $hasil,
    'rekomendasi' => $rekomendasi
]);

    // =========================
    // SESSION PDF
    // =========================
    session()->set('skrining_diare', [
        'identitas'   => $identitas,
        'jawaban'     => $semuaJawaban,
        'hasil'       => $hasil,
        'warna'       => $warna,
        'rekomendasi' => $rekomendasi
    ]);

    return view('gol_d/hasil_diare', [
    'identitas'        => $identitas,
    'jawaban'          => $semuaJawaban,
    'hasil'            => $hasil,
    'statusDiare'      => $statusDiare,
    'statusDehidrasi'  => $statusDehidrasi,
    'warna'            => $warna,
    'rekomendasi'      => $rekomendasi
]); 
}

    // =========================
    // GENERATE PDF
    // =========================
    public function pdf()
{
    $session = session()->get('skrining_diare');

    if (!$session || !isset($session['identitas'])) {
        return redirect()->to('/skrining-diare');
    }

    return view('gol_d/pdf_diare', [
        'identitas'   => $session['identitas'],
        'jawaban'     => $session['jawaban'],
        'hasil'       => $session['hasil'],
        'rekomendasi' => $session['rekomendasi']
    ]);
}
// =========================
// LANDING PAGE DIARE
// =========================
public function index()
{
    helper('text');

    $beritaModel = new BeritaModelDD();
    $funfactModel = new FunfactModelD();
    $diareModel = new DataDiareModel();

    $data['berita'] = $beritaModel
        ->where('id_penyakit', 4)
        ->where('status_berita', 'publish')
        ->orderBy('tanggal_berita', 'DESC')
        ->findAll();

    $data['funfact'] = $funfactModel
        ->where('id_penyakit', 4)
        ->where('status_funfact', 'published')
        ->orderBy('tanggal_funfact', 'DESC')
        ->findAll();

    $data['diare'] = $diareModel->findAll();

    return view('gol_d/diare', $data);
}
   

    // =========================
    // INPUT DATA
    // =========================
    public function inputData()
{
    return view('gol_d/input_d', [
        'menu' => 'inputdata',
        'penyakit' => 'diare'
    ]);
}

    // =========================
    // HASIL DATA
    // =========================
    public function hasil_data()
    {
        $pasien = session()->get('pasien') ?? [];

        return view('gol_d/hasil_d', [
            'menu' => 'hasil',
            'penyakit' => 'diare',
            'pasien' => $pasien
        ]);
    }

    // =========================
    // SIMPAN DATA
    // =========================
    public function simpan()
    {
        $data = [
            'kecamatan' => $this->request->getPost('kecamatan'),
            'desa'      => $this->request->getPost('desa'),
            'jk'        => $this->request->getPost('jk'),
            'usia'      => $this->request->getPost('usia'),
        ];

        $pasien = session()->get('pasien') ?? [];
        $pasien[] = $data;

        session()->set('pasien', $pasien);

        return redirect()->to('/diare/hasil_d');
    }

    // =========================
    // EXPORT EXCEL
    // =========================
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
    public function kalkulatorAir()
{
    return view('gol_d/kalkulator_air', [
        'mode' => 'who',
        'hasil' => 0,
        'bolus' => 0,
        'defisit' => 0,
        'maintenance' => 0,
        'perjam' => 0
    ]);
}

public function hitungAir()
{
    $mode = $this->request->getPost('mode');

    // =========================
    // MODE WHO
    // =========================
    if ($mode === 'who') {

        $berat = (float)$this->request->getPost('berat');
        $dehidrasi = (float)$this->request->getPost('dehidrasi') / 100;

        $bolus = ($dehidrasi >= 0.09) ? 20 * $berat : 0;

        $defisit = $dehidrasi * $berat * 1000;

        // RULE 4-2-1
        if ($berat <= 10) {
            $maintenance = 4 * $berat;
        } elseif ($berat <= 20) {
            $maintenance = 40 + (($berat - 10) * 2);
        } else {
            $maintenance = 60 + (($berat - 20) * 1);
        }

        $total = $defisit + ($maintenance * 24) - $bolus;
        $perjam = $total / 24;

        return view('gol_d/kalkulator_air', [
            'mode' => 'who',
            'hasil' => round($total),
            'bolus' => round($bolus),
            'defisit' => round($defisit),
            'maintenance' => round($maintenance),
            'perjam' => round($perjam, 1)
        ]);
    }

    // =========================
    // MODE AIR NORMAL
    // =========================
    $berat = (float)$this->request->getPost('berat_normal');
    $aktivitas = (int)$this->request->getPost('aktivitas');

    $air = $berat * 35;

    if ($aktivitas > 50) {
        $air += 500;
    }

    return view('gol_d/kalkulator_air', [
        'mode' => 'normal',
        'hasil' => round($air),
        'bolus' => 0,
        'defisit' => 0,
        'maintenance' => 0,
        'perjam' => 0
    ]);
}
public function detailBerita($id)
{
    $beritaModel = new \App\Models\BeritaModelDD();

    $berita = $beritaModel
        ->where('id_berita', $id)
        ->where('status_berita', 'publish')
        ->first();

    if (!$berita) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }

    return view('gol_d/detail_berita', [
        'berita' => $berita
    ]);
}
public function funfact()
{
    $funfactModel = new FunfactModelD();

    $data['funfact'] = $funfactModel
        ->where('id_penyakit', 4)
        ->findAll();

    return view('admind/funfact', $data);
}
}
