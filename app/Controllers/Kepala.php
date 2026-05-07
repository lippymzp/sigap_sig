<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Kepala extends Controller
{
   public function dashboard()
    {
    $db = \Config\Database::connect(); // 🔥 WAJIB

    // ======================
    // 🔥 DATA GRAFIK
    // ======================
    $bulan = $this->request->getGet('bulan');
    $tahun = $this->request->getGet('tahun');
    $usia  = $this->request->getGet('usia');
    $jk    = $this->request->getGet('jk');


    $builder = $db->table('pasien p');
    $builder->select('w.kelurahan, COUNT(*) as total');
    $builder->join('wilayah w', 'w.id_wilayah = p.id_wilayah', 'left');

    if (!empty($bulan)) {
    $builder->where('MONTH(p.tgl_kunjungan)', $bulan);
}

    if (!empty($tahun)) {
        $builder->where('YEAR(p.tgl_kunjungan)', $tahun);
    }

    if (!empty($jk)) {
        if ($jk == 'L') {
            $builder->where('p.jenis_kelamin', 'Laki-laki');
        } elseif ($jk == 'P') {
            $builder->where('p.jenis_kelamin', 'Perempuan');
        }
    }

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
    $builder->groupBy('w.kelurahan');

    $grafik = $builder->get()->getResultArray();

    // ======================
    // 🔥 DATA PETA
    // ======================
    $tahunMap = $this->request->getGet('tahun_map');

    $builderDbd = $db->table('pasien p');
    $builderDbd->select('w.kelurahan as desa, COUNT(*) as kasus');
    $builderDbd->join('wilayah w', 'w.id_wilayah = p.id_wilayah', 'left');

    // 🔥 FILTER HARUS DI SINI (SEBELUM get)
    if (!empty($tahunMap)) {
        $builderDbd->where('YEAR(p.tgl_kunjungan)', $tahunMap);
    }

    $builderDbd->groupBy('w.kelurahan');

    // 🔥 BARU AMBIL DATA
    $dbd = $builderDbd->get()->getResultArray();    // ======================
    // 🔥 KIRIM KE VIEW
    // ======================
    return view('gol_a/dashboard_kepala', [
        'menu' => 'dashboard',
        'judul' => 'Dashboard Kepala',
        'nama_puskesmas' => 'Puskesmas Panti, Jember',

        'total_kasus' => 20,
        'kasus_baru' => 2,
        'wilayah' => 6,

        'grafik' => $grafik, // 🔥 TAMBAH
        'dbd' => $dbd        // 🔥 TAMBAH
    ]);}
    public function export()
    {
        $data = [
            'menu' => 'export',
            'judul' => 'Export Data'
        ];

        return view('gol_a/export_kepala', $data);
    }
    public function peta_sebaran()
{
    return view('gol_a/peta_sebaran_kepala', [
        'menu' => 'peta_sebaran'
    ]);
}
public function detail_peta()
{
    return view('gol_a/detail_peta');
}

}