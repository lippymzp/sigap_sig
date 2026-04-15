<?php

namespace App\Controllers;

class Dashboard extends BaseController
{

    public function dbd()
    {
        return view('gol_b/dashboard_dbd');
    }

    public function tbc()
    {
        return view('gol_b/dashboard_tbc');
    }

    public function pneumonia()
    {
        return view('gol_b/dashboard_pneumonia');
    }

    public function diare() 
    {
        return view('gol_b/dashboard_diare');
    }

    

}