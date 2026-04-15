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
        return view('kontak');
    }

    public function pneumonia()
    {
        return view('pneumonia');
    }
public function dbd()
{
    return view('dbd');
}

public function tbc()
{
    return view('tbc');
}

public function diare()
{
    return view('diare');
}
public function skrining()
{
    return view('skrining');
}
}