<?php

namespace App\Controllers;

class Pegawai extends BaseController
{
    public function index($penyakit = 'pneumonia')
    {
        session()->set('penyakit', $penyakit);

        $data = [
            'title'   => 'Data Pegawai',
            'judul'   => 'Data Pegawai',
            'menu'    => 'pegawai',
            'penyakit'=> $penyakit
        ];

        return view('gol_c/data_pegawai', $data);
    }
}