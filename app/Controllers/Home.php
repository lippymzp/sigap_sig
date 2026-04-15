<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('gol_d/home');
    }

    public function kontak()
    {
        return view('gol_d/kontak');
    }

    public function pneumonia()
    {
        return view('gol_d/pneumonia');
    }
public function dbd()
{
    return view('gol_d/dbd');
}

public function tbc()
{
    return view('gol_d/tbc');
}

public function diare()
{
    return view('gol_d/diare');
}
public function skrining()
{
    return view('skrining');
}
}