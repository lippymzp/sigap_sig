<?php

namespace App\Controllers\AdminTbc;

use App\Models\SkriningTBCModel;
use App\Controllers\BaseController;

class Riwayat extends BaseController
{
    public function index()
    {
        return view('gol_b/skrining_form');
    }

    public function proses()
    {
        // Ambil input
        $batuk = $this->request->getPost('batuk');
        $berat = $this->request->getPost('berat');
        $benjol = $this->request->getPost('benjol');
        $punggung = $this->request->getPost('punggung');
        $lemas = $this->request->getPost('lemas');
        $demam = $this->request->getPost('demam');
        $darah = $this->request->getPost('darah');
        $dahak = $this->request->getPost('dahak');
        $nafsu = $this->request->getPost('nafsu');
        $kelenjar = $this->request->getPost('kelenjar');
        $keringat = $this->request->getPost('keringat');
        $dada = $this->request->getPost('dada');
        $sesak = $this->request->getPost('sesak');

        // ===== DECISION TREE =====
        if ($batuk == 0) {
            $hasil = "Tidak TB";
        } else {

            if ($berat == 1) {
                $hasil = "TB";
            }
            elseif ($darah == 1) {
                $hasil = "TB";
            }
            elseif ($kelenjar == 1 && $demam == 1) {
                $hasil = "TB";
            }
            elseif ($keringat == 1 && $dada == 1) {
                $hasil = "TB";
            }
            elseif ($sesak == 1) {
                $hasil = "TB";
            }
            else {
                $hasil = "Tidak TB";
            }
        }

        // ===== SIMPAN KE DATABASE =====
        $model = new SkriningTBCModel();

        $data = [
            'batuk' => $batuk,
            'berat' => $berat,
            'benjol' => $benjol,
            'punggung' => $punggung,
            'lemas' => $lemas,
            'demam' => $demam,
            'darah' => $darah,
            'dahak' => $dahak,
            'nafsu' => $nafsu,
            'kelenjar' => $kelenjar,
            'keringat' => $keringat,
            'dada' => $dada,
            'sesak' => $sesak,
            'hasil' => $hasil
        ];

        $model->insert($data);

        // ===== KIRIM KE VIEW =====
        return view('gol_b/hasil', ['hasil' => $hasil]);
    }

    // ===== RIWAYAT =====
    public function riwayat()
    {
        $model = new SkriningTBCModel();
        $data['riwayat'] = $model->findAll();

        return view('gol_b/riwayat', $data);
    }
}