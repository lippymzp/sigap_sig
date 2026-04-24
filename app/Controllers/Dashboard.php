<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        return view('gol_b/dashboard', [
            'menu' => 'dashboard',
            'artikels' => [] 
        ]);
    }

    public function input()
    {
        return view('input_data', ['menu' => 'inputdata']);
    }

    public function hasil()
    {
        return view('hasil', ['menu' => 'hasil']);
    }

    public function skrining()
    {
        return view('skrining_1', ['menu' => 'skrining']);
    }

    public function peta()
    {
        return view('peta', ['menu' => 'peta']);
    }

    public function export()
    {
        return view('export', ['menu' => 'export']);
    }

    public function berita()
    {
        return view('berita', ['menu' => 'berita']);
    }

    public function funfact()
    {
        return view('funfact', ['menu' => 'funfact']);
    }

    // ✅ TAMBAHKAN DI DALAM CLASS
   public function dbd()
{
    return view('gol_a/dashboard_dbd', [
        'menu' => 'dashboard',
        'artikels' => []
    ]);
}

public function tbc()
{
    return view('gol_b/dashboard_tbc', [
        'menu' => 'dashboard',
        'artikels' => []
    ]);
}

public function pneumonia()
{
    return view('gol_c/dashboard_pneumonia', [
        'menu' => 'dashboard',
        'artikels' => []
    ]);
}

public function diare()
{
    return view('gol_d/dashboard_diare', [
        'menu' => 'dashboard',
        'artikels' => []
    ]);
}


public function inputData()
{
    return view('input_data');
}
public function hasil_data()
    {
        return view('gol_d/hasil_data');
    }
}