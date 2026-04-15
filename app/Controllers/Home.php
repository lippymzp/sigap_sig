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
    }
    public function skrining()
    {
        return view('gol_a/skrining');
    }
    public function skrining_diare()
{
    return view('gol_d/skrining_diare');
}
public function diare_detail()
{
    return view('gol_d/diare_detail');
}
}