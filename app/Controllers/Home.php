<?php

namespace App\Controllers;
use App\Models\IklanModel;
use App\Models\FunfactModelD;
class Home extends BaseController
{
    public function index()
    {
        $iklanModel = new IklanModel();

        $data['iklan'] = $iklanModel
            ->where('status', 'aktif')
            ->orderBy('urutan', 'ASC')
            ->findAll();

        return view('home', $data);
    }

    public function kontak()
    {
        return view('gol_d/kontak');
    }

    public function pneumonia()
    {
        return view('gol_c/pneumonia');
    }
    public function dbd()
    {
    return redirect()->to('/dbd');
    }
    public function tbc()
    {
        return view('gol_b/tbc');
    }

    public function diare()
    {
        return view('gol_d/diare');

    }
    public function skrining_diare()
    {
    return view('gol_d/skrining_diare');
    }

public function grafikPneumonia()
{
    return view('gol_c/grafik_pneumonia');
}
public function diare_detail($id = null)
{
    $funfactModel = new \App\Models\FunfactModelD();

    if ($id) {
        $data['funfact'] = $funfactModel->find($id);
    } else {
        $data['funfact'] = $funfactModel
            ->where('id_penyakit', 4)
            ->where('status_funfact', 'publish')
            ->orderBy('tanggal_funfact', 'DESC')
            ->first();
    }

    return view('gol_d/diare_detail', $data);
}
public function tbc_detail()
{
    return view('gol_b/tbc_detail');

}

public function cekdb()
{
    try {
        $db = \Config\Database::connect();
        $db->initialize();

        echo "Koneksi berhasil";
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
}
public function tentangKami()
{
    return view('tentang_kami');
}
}