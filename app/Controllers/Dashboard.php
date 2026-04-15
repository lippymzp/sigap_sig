<?php

namespace App\Controllers;

class Dashboard extends BaseController
{

    public function index()
    {
        return view('gol_b/dashboard');
    }

}