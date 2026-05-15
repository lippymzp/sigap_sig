<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('home');
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
public function diare_detail()
{
    return view('gol_d/diare_detail');

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