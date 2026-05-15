<?php

namespace App\Controllers;

use Dompdf\Dompdf;
use App\Models\SkriningModel;
use App\Libraries\DiareDecisionTree;

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

    switch ($prediksi) {
        case 'tinggi':
            $hasil = 'Risiko Tinggi Diare';
            $warna = 'danger';
            $rekomendasi = 'Segera periksa ke fasilitas kesehatan terdekat karena terdapat indikasi dehidrasi berat.';
            break;

        case 'sedang':
            $hasil = 'Risiko Sedang Diare';
            $warna = 'warning';
            $rekomendasi = 'Perbanyak cairan, oralit, istirahat cukup, dan pantau kondisi tubuh.';
            break;

        default:
            $hasil = 'Risiko Rendah Diare';
            $warna = 'success';
            $rekomendasi = 'Tetap jaga pola hidup sehat, kebersihan makanan, dan hidrasi tubuh.';
            break;
    }

    // =========================
    // SIMPAN KE DATABASE
    // =========================
    $skriningModel = new SkriningModel();

    $skriningModel->insert([
        'id_pasien_skrining' => null,
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
        'identitas'   => $identitas,
        'jawaban'     => $semuaJawaban,
        'hasil'       => $hasil,
        'warna'       => $warna,
        'rekomendasi' => $rekomendasi
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

        $dompdf = new Dompdf();

        $html = view('gol_d/pdf_diare', [
            'identitas'   => $session['identitas'],
            'jawaban'     => $session['jawaban'],
            'hasil'       => $session['hasil'],
            'rekomendasi' => $session['rekomendasi']
        ]);

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream("hasil-diare.pdf", ["Attachment" => false]);
    }

    // =========================
    // LANDING PAGE DIARE
    // =========================
    public function index()
    {
        $model = new \App\Models\DiareModel();

        $data['diare'] = $model->findAll();

        return view('gol_d/diare', $data);
    }

    // =========================
    // INPUT DATA
    // =========================
    public function inputData()
    {
        return view('gol_d/input_data', [
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

        return view('gol_d/hasil_data', [
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

        return redirect()->to('/diare/hasil');
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
    return view('gol_d/kalkulator_air');
}

public function hitungAir()
{
    $usia = (int)$this->request->getPost('usia');
    $berat = (float)$this->request->getPost('berat');
    $aktivitas = (int)$this->request->getPost('aktivitas');
    $kondisi = $this->request->getPost('kondisi');

    $air = $berat * 35;

    if ($usia < 18) {
        $air = $berat * 45;
    }

    if ($aktivitas > 50) {
        $air += 500;
    }

    switch ($kondisi) {
        case 'ringan':
            $air += 500;
            break;
        case 'sedang':
            $air += 1000;
            break;
        case 'berat':
            $air += 1500;
            break;
    }

    return view('gol_d/kalkulator_air', [
        'hasil' => round($air / 1000, 1)
    ]);
}
}
