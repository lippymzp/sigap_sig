<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\FunfactTbcModel;

class LandingTbc extends BaseController
{
    public function index()
    {
        $funfactModel = new FunfactTbcModel();

        $data['funfact'] = $funfactModel
            ->where('id_penyakit', 2)
            ->where('status_funfact', 'Publish')
            ->findAll();

        return view('gol_b/tbc', $data);
    }

    public function detailFunfact($id)
{
    $model = new \App\Models\FunfactTbcModel();

    $funfact = $model->find($id);

    if(!$funfact){
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }

    return view('gol_b/tbc_detailfunfact', [
        'funfact' => $funfact
    ]);
}
}