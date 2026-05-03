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
$bulan = $this->request->getGet('bulan');
    $tahun = $this->request->getGet('tahun');
    $usia  = $this->request->getGet('usia');
    $jk    = $this->request->getGet('jk');

    // 
    $wilayahList = ['Wirolegi', 'Sumbersari', 'Karangrejo', 'Antirogo', 'Tegal Gede'];

    $builder = $db->table('pasien p');
    $builder->select('w.kelurahan, COUNT(*) as total');
    $builder->join('wilayah w', 'w.id_wilayah = p.id_wilayah', 'left');

    $builder->whereIn('w.kelurahan', [
    'Wirolegi',
    'Sumbersari',
    'Karangrejo',
    'Antirogo',
    'Tegal Gede'
                ]);
    
    // FILTER BULAN
    if (!empty($bulan)) {
        $builder->where('MONTH(p.tgl_kunjungan)', $bulan);
    }

    // FILTER TAHUN 
    if (!empty($tahun)) {
        $builder->where('YEAR(p.tgl_kunjungan)', $tahun);
    }

    // FILTER JK
    if (!empty($jk)) {
    if ($jk == 'L') {
        $builder->where('p.jenis_kelamin', 'Laki-laki');
    } elseif ($jk == 'P') {
        $builder->where('p.jenis_kelamin', 'Perempuan');
    }
}


    // FILTER USIA
    if (!empty($usia)) {
    if ($usia == 'anak') {
        $builder->where('p.umur <=', 14);
    } elseif ($usia == 'remaja') {
        $builder->where('p.umur >=', 15);
        $builder->where('p.umur <=', 24);
    } elseif ($usia == 'dewasa') {
        $builder->where('p.umur >=', 25);
        $builder->where('p.umur <=', 59);
    } elseif ($usia == 'lansia') {
        $builder->where('p.umur >=', 60);
    }
}


    $builder->where('p.tgl_kunjungan IS NOT NULL');
    $builder->groupBy('w.kelurahan');
    $builder->orderBy('w.kelurahan', 'ASC');
    
    $grafik = $builder->get()->getResultArray();

    // ambil tahun dulu
    $tahun = $this->request->getGet('tahun');

    // DATA PETA
    $builderDbd = $db->table('pasien p')
        ->select('w.kelurahan as desa, COUNT(*) as kasus')
        ->join('wilayah w', 'w.id_wilayah = p.id_wilayah', 'left');

    if (!empty($tahun)) {
        $builderDbd->where('YEAR(p.tgl_kunjungan)', $tahun);
    }

    $builderDbd->groupBy('w.kelurahan');
$dbd = $builderDbd->get()->getResultArray();



    return view('gol_a/dashboard_dbd', [
        'menu' => 'dashboard',
        'artikels' => [],
        'grafik' => $grafik,
        'dbd' => $dbd
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