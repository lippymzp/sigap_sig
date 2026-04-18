<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function skrining1()
    {
        return view('skrining1');
    }

    public function skrining2()
    {
        $data['q1'] = $this->request->getPost('q1');
        return view('skrining2', $data);
    } // ✅ INI YANG TADI KURANG

    public function skrining3()
    {
        $data['q1'] = $this->request->getPost('q1');
        $data['q2'] = $this->request->getPost('q2');
        return view('skrining3', $data);
    }

    public function hasil()
    {
        $q1 = $this->request->getPost('q1');
        $q2 = $this->request->getPost('q2');
        $q3 = $this->request->getPost('q3');

        // pastikan angka
        $q1 = (int) $q1;
        $q2 = (int) $q2;
        $q3 = (int) $q3;

        $total = $q1 + $q2 + $q3;

        if ($total >= 5) {
            $hasil = "Risiko Tinggi DBD";
        } elseif ($total >= 3) {
            $hasil = "Risiko Sedang";
        } else {
            $hasil = "Risiko Rendah";
        }

        return view('hasil', [
            'hasil' => $hasil,
            'total' => $total
        ]);
    }
}