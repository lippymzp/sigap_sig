<?php

namespace App\Controllers;

use App\Models\BeritaTbcModel;
use App\Models\FunfactTbcModel;

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

    public function funfact()
    {
        $model = new FunfactTbcModel();

        $data['artikel'] = $model->where('status_artikel', 'Publish')
                                 ->orderBy('tanggal_artikel', 'DESC')
                                 ->findAll();

        return view('gol_b/funfact', $data);
    }

   public function dbd()
{
    $db = \Config\Database::connect();

    $selectedKelurahan = $this->request->getGet('kelurahan');

    $kelurahan = $db->query("
        SELECT DISTINCT kelurahan
        FROM wilayah
        ORDER BY kelurahan ASC
    ")->getResultArray();

    $builder = $db->table('pasien p');
    $builder->select('MONTH(p.tgl_kunjungan) as bulan, COUNT(*) as total');
    $builder->join('wilayah w', 'w.id_wilayah = p.id_wilayah');

    if (!empty($selectedKelurahan)) {
        $builder->where('w.kelurahan', $selectedKelurahan);
    }

    $builder->groupBy('MONTH(p.tgl_kunjungan)');
    $builder->orderBy('MONTH(p.tgl_kunjungan)', 'ASC');

    $grafik = $builder->get()->getResultArray();

    return view('gol_a/dashboard_dbd', [
        'menu' => 'dashboard',
        'artikels' => [],
        'grafik' => $grafik,
        'kelurahan' => $kelurahan
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
    
    public function dashboard_diare()
    {
        return view('gol_d/dashboard_diare', [
            'menu' => 'dashboard',
            'artikels' => []
        ]);
    }
}