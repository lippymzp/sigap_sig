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
}