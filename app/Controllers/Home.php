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
        return view('gol_a/dbd');
    }

    public function tbc()
    {
        return view('gol_b/tbc');
    }

    public function diare()
    {
        return view('gol_d/diare');

        
         $data = $this->request->getPost();
         return view('gol_a/skrining3', $data);
    }
    public function skrining_diare()
    {
    return view('gol_d/skrining_diare');
    }
public function diare_detail()
{
    return view('gol_d/diare_detail');

}
 public function rekap_skrining_dbd()
    {
    return view('gol_a/rekap_skrining_dbd');
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
public function skriningpneumonia3()
{
    $data = $this->request->getPost();
    return view('gol_c/skrining3', $data);
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
}