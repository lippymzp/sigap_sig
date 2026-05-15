<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\FunfactPneumoniaModel;

class FunfactPneumoniaLanding extends BaseController
{
    public function index()
    {
        $model = new FunfactPneumoniaModel();

        $funfact = $model
            ->where('status_funfact', 'Publish')
            ->where('id_penyakit', 3)
            ->orderBy('id_funfact', 'DESC')
            ->first();

        return view('gol_c/funfact_landing', [
            'funfact' => $funfact
        ]);
    }
}