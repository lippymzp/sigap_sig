<?php

namespace App\Controllers;

use Dompdf\Dompdf;

class Diare extends BaseController
{
    // =========================
    // STEP 1 (FORM IDENTITAS)
    // =========================
    public function skrining()
    {
        // reset session biar bersih tiap mulai
        session()->remove('skrining_diare');

        return view('gol_d/skrining_diare');
    }

    // =========================
    // STEP 2 (SIMPAN IDENTITAS → KE PERTANYAAN)
    // =========================
    public function step2()
    {
        $identitas = $this->request->getPost();

        // VALIDASI sederhana (biar ga kosong)
        if (empty($identitas)) {
            return redirect()->back()->with('error', 'Data identitas belum diisi');
        }

        session()->set('skrining_diare', [
            'identitas' => $identitas
        ]);

        return view('gol_d/pertanyaan_diare');
    }

    // =========================
    // HASIL SKRINING
    // =========================
    public function hasil()
    {
        $session = session()->get('skrining_diare');

        // kalau belum isi step1 → balik
        if (!$session || !isset($session['identitas'])) {
            return redirect()->to('/skrining-diare');
        }

        $jawaban = $this->request->getPost();
        $identitas = $session['identitas'];

        // =====================
        // VALIDASI JAWABAN
        // =====================
        if (empty($jawaban)) {
            return redirect()->to('/skrining-diare')->with('error', 'Jawaban belum diisi');
        }

        // =====================
        // HITUNG SKOR
        // =====================
        $skor = 0;
        $jumlahPertanyaan = 10;

        for ($i = 0; $i < $jumlahPertanyaan; $i++) {
            $skor += isset($jawaban["q".$i]) ? (int)$jawaban["q".$i] : 0;
        }

        // =====================
        // ANALISIS HASIL
        // =====================
        if ($skor >= 7) {
            $hasil = "Risiko Tinggi Diare";
            $warna = "danger";
            $rekomendasi = "Segera periksa ke fasilitas kesehatan terdekat dan jaga hidrasi tubuh.";
        } elseif ($skor >= 4) {
            $hasil = "Risiko Sedang Diare";
            $warna = "warning";
            $rekomendasi = "Perbanyak minum air, jaga pola makan, dan pantau kondisi tubuh.";
        } else {
            $hasil = "Risiko Rendah Diare";
            $warna = "success";
            $rekomendasi = "Pertahankan pola hidup bersih dan sehat.";
        }

        // =====================
        // SIMPAN KE SESSION (UNTUK PDF)
        // =====================
        session()->set('skrining_diare', [
            'identitas'   => $identitas,
            'jawaban'     => $jawaban,
            'hasil'       => $hasil,
            'warna'       => $warna,
            'skor'        => $skor,
            'rekomendasi' => $rekomendasi
        ]);

        // =====================
        // KIRIM KE VIEW (FIX)
        // =====================
        return view('gol_d/hasil_diare', [
            'identitas'   => $identitas,
            'jawaban'     => $jawaban,
            'hasil'       => $hasil,
            'warna'       => $warna,
            'skor'        => $skor,
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
            'skor'        => $session['skor'],
            'rekomendasi' => $session['rekomendasi']
        ]);

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $dompdf->stream("hasil-diare.pdf", ["Attachment" => false]);
    }
    public function index()
{
    $model = new \App\Models\DiareModel();

    $data['diare'] = $model->findAll();

    dd($data['diare']); // 🔥 WAJIB TARUH INI

    return view('gol_d/diare', $data);
}
public function inputData()
{
    return view('gol_d/input_data', [
        'menu' => 'inputdata',
        'penyakit' => 'diare'
    ]);
}
public function hasil_data()
{
    $pasien = session()->get('pasien') ?? [];

    return view('gol_d/hasil_data', [
        'menu' => 'hasil',
        'penyakit' => 'diare',
        'pasien' => $pasien   // 🔥 INI KUNCI
    ]);
}
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
public function export()
{
    $pasien = session()->get('pasien') ?? [];

    // header file excel
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
}}