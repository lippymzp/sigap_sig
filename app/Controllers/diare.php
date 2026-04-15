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
        return view('gol_d/skrining_diare');
    }

    // =========================
    // STEP 2 (PERTANYAAN)
    // =========================
    public function step2()
    {
        // simpan data identitas ke session
        session()->set($this->request->getPost());

        return view('gol_d/pertanyaan_diare');
    }

    // =========================
    // HASIL SKRINING
    // =========================
    public function hasil()
    {
        // ambil data identitas + jawaban
        $data = array_merge(
            session()->get(),
            $this->request->getPost()
        );

        // =====================
        // HITUNG SKOR
        // =====================
        $skor = 0;

        // jumlah pertanyaan = 10 (sesuai view)
        for ($i = 0; $i < 10; $i++) {
            $skor += isset($data["q".$i]) ? $data["q".$i] : 0;
        }

        // =====================
        // ANALISIS
        // =====================
        if ($skor >= 7) {
            $hasil = "Risiko Tinggi Diare";
            $warna = "danger";
        } elseif ($skor >= 4) {
            $hasil = "Risiko Sedang Diare";
            $warna = "warning";
        } else {
            $hasil = "Risiko Rendah Diare";
            $warna = "success";
        }

        // =====================
        // SIMPAN KE SESSION (PENTING BUAT PDF)
        // =====================
        session()->set([
            'data' => $data,
            'hasil' => $hasil,
            'skor' => $skor
        ]);

        return view('gol_d/hasil_diare', [
            'data' => $data,
            'hasil' => $hasil,
            'warna' => $warna,
            'skor' => $skor
        ]);
    }

    // =========================
    // GENERATE PDF
    // =========================
    public function pdf()
    {
        $dompdf = new Dompdf();

        $data  = session()->get('data');
        $hasil = session()->get('hasil');
        $skor  = session()->get('skor');

        // kalau kosong → redirect biar ga error
        if (!$data) {
            return redirect()->to('/skrining-diare');
        }

        $html = view('gol_d/pdf_diare', [
            'data' => $data,
            'hasil' => $hasil,
            'skor' => $skor
        ]);

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // tampil di browser (bukan download langsung)
        $dompdf->stream("hasil-diare.pdf", ["Attachment" => false]);
    }
}