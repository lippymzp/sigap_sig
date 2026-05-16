<?php

namespace App\Controllers;

use App\Models\BeritaTbcModel;
use App\Models\FunfactTbcModel;
use App\Models\profil_sistem;
use App\Models\DataPasienModel;

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

    // =========================
    // QUERY GRAFIK
    // =========================
    $builder = $db->table('pasien p');
    $builder->select('w.kelurahan as desa, COUNT(*) as kasus');
    $builder->join('wilayah w', 'w.id_wilayah = p.id_wilayah', 'left');
    $builder->whereIn('w.kelurahan', [
        'Sumbersari',
        'Wirolegi',
        'Antirogo',
        'Tegal Gede',
        'Karangrejo'
    ]);

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

    //DATA PETA
$builder = $db->table('wilayah w');

$builder->select("
    w.kelurahan as desa,
    COUNT(DISTINCT p.id_pasien) as kasus,

    SUM(CASE WHEN p.jenis_kelamin = 'Laki-laki' THEN 1 ELSE 0 END) as laki,
    SUM(CASE WHEN p.jenis_kelamin = 'Perempuan' THEN 1 ELSE 0 END) as perempuan,

    SUM(CASE WHEN p.umur <= 14 THEN 1 ELSE 0 END) as anak,
    SUM(CASE WHEN p.umur BETWEEN 15 AND 59 THEN 1 ELSE 0 END) as dewasa,
    SUM(CASE WHEN p.umur >= 60 THEN 1 ELSE 0 END) as lansia,

    SUM(COALESCE(rp.diperiksa,0)) AS rumah_diperiksa,
    SUM(COALESCE(rp.positif,0)) AS rumah_positif
");

$builder->join('pasien p', 'p.id_wilayah = w.id_wilayah', 'left');

$builder->join(
    'rekap_pelaporan_kader rp',
    'LOWER(TRIM(rp.kelurahan)) = LOWER(TRIM(w.kelurahan))',
    'left'
);

$builder->groupBy('w.kelurahan');

$dbd = $builder->get()->getResultArray();
    // =========================
    // DETAIL DESA
    // =========================
    $detailDesa = [];
    $desaTertinggi = '-';

    foreach ($dbd as $row) {

        $namaKel = $row['desa'];
        $jumlahKasus = (int)$row['kasus'];

        $wilayah = $db->table('wilayah')
            ->where('kelurahan', $namaKel)
            ->get()
            ->getRowArray();

        $idWilayah = $wilayah['id_wilayah'] ?? null;

        // kategori
        if ($jumlahKasus >= 20) $kategori = 'tinggi';
        elseif ($jumlahKasus >= 10) $kategori = 'sedang';
        else $kategori = 'rendah';

        // demografi
        $demo = $db->table('pasien p')
            ->select("
                COUNT(CASE WHEN umur <= 14 THEN 1 END) as anak,
                COUNT(CASE WHEN umur BETWEEN 15 AND 59 THEN 1 END) as dewasa,
                COUNT(CASE WHEN umur >= 60 THEN 1 END) as lansia,
                COUNT(CASE WHEN jenis_kelamin='Laki-laki' THEN 1 END) as laki,
                COUNT(CASE WHEN jenis_kelamin='Perempuan' THEN 1 END) as perempuan
            ")
            ->join('wilayah w', 'w.id_wilayah = p.id_wilayah')
            ->where('w.kelurahan', $namaKel)
            ->get()
            ->getRowArray();

        // jentik
        $jentik = $db->table('rekap_pelaporan_kader')
            ->select('SUM(diperiksa) as diperiksa, SUM(positif) as positif')
            ->where('id_kelurahan', $idWilayah)
            ->get()
            ->getRowArray();

        // usia tertinggi
        $usiaData = [
            'Anak-anak' => $demo['anak'] ?? 0,
            'Dewasa'    => $demo['dewasa'] ?? 0,
            'Lansia'    => $demo['lansia'] ?? 0,
        ];

        arsort($usiaData);
        $usiaTertinggi = array_key_first($usiaData);

        $key = preg_replace('/[^a-z0-9]/', '', strtolower($namaKel));

        $detailDesa[$key] = [
            'jumlah_penduduk' => 0,
            'jumlah_kasus'    => $jumlahKasus,
            'kategori'        => $kategori,

            'anak'   => (int)($demo['anak'] ?? 0),
            'dewasa' => (int)($demo['dewasa'] ?? 0),
            'lansia' => (int)($demo['lansia'] ?? 0),

            'usia_tertinggi' => $usiaTertinggi,

            'laki'      => (int)($demo['laki'] ?? 0),
            'perempuan' => (int)($demo['perempuan'] ?? 0),

            'rumah_diperiksa' => (int)($jentik['diperiksa'] ?? 0),
            'rumah_jentik'    => (int)($jentik['positif'] ?? 0),
        ];
    }

    // desa tertinggi
    if (!empty($dbd)) {
        usort($dbd, fn($a,$b) => $b['kasus'] <=> $a['kasus']);
        $desaTertinggi = $dbd[0]['desa'];
    }
    $mapKey = [];

    foreach ($detailDesa as $k => $v) {
    $mapKey[$k] = $v;
    }
    
    // =========================
    // RETURN VIEW (WAJIB DI AKHIR)
    // =========================
    return view('gol_a/dashboard_dbd', [
        'menu' => 'dashboard',
        'grafik' => $grafik,
        'dbd' => $dbd,
        'detailDesa' => $detailDesa,
        'desaTertinggi' => $desaTertinggi
    ]);
}
public function tentangkamiDBD()
    {
        $model = new profil_sistem();

        $data['profil'] = $model->first();

        return view('gol_a/tentang', $data);
    }

public function tbc()
{
    $beritaModel = new BeritaTbcModel();
    $funfactModel = new FunfactTbcModel();

    $db = \Config\Database::connect();

    // BERITA
    $berita = $beritaModel
        ->where('status_berita', 'Publish')
        ->orderBy('id_berita', 'DESC')
        ->findAll();

    // FUNFACT
    $funfact = $funfactModel
        ->where('status_funfact', 'Publish')
        ->orderBy('id_funfact', 'DESC')
        ->findAll();

    // DATA PETA
    $builder = $db->table('pasien p');

    $builder->select('
    w.kelurahan as desa,
    w.latitude,
    w.longitude,
    COUNT(*) as kasus
');

    $builder->join(
        'wilayah w',
        'w.id_wilayah = p.id_wilayah',
        'left'
    );

    $builder->where('w.latitude IS NOT NULL');
    $builder->where('w.longitude IS NOT NULL');

    $builder->groupBy('w.kelurahan, w.latitude, w.longitude');

    $tbc = $builder->get()->getResultArray();

    return view('gol_b/dashboard_tbc', [
        'menu' => 'dashboard',
        'berita' => $berita,
        'funfact' => $funfact,
        'tbc' => $tbc
    ]);
}
  // DASHBOARD PNEUMONIA
public function pneumonia()
{
    $db = \Config\Database::connect();

    // AMBIL FILTER DARI URL
    $bulan = $this->request->getGet('bulan');
    $tahun = $this->request->getGet('tahun');
    $jk    = $this->request->getGet('jk');


    // =====================
    // DATA PETA
    // =====================
    $builder = $db->table('pasien p');

    $builder->select("
    w.kelurahan as desa,
    p.jenis_kelamin,
    p.umur,
    p.tgl_kunjungan,
    1 as kasus
");

    $builder->join(
        'wilayah w',
        'w.id_wilayah = p.id_wilayah',
        'left'
    );

    // FILTER BULAN
    if(!empty($bulan)){
        $builder->where(
            'MONTH(p.tgl_kunjungan)',
            $bulan
        );
    }

    // FILTER TAHUN
    if(!empty($tahun)){
        $builder->where(
            'YEAR(p.tgl_kunjungan)',
            $tahun
        );
    }

    // FILTER JK
    if(!empty($jk)){
        $builder->where(
            'p.jenis_kelamin',
            $jk
        );
    }

    

    $pneumonia =
        $builder->get()
        ->getResultArray();


    // TOTAL KASUS
    $totalKasus =
        array_sum(
            array_column(
                $pneumonia,
                'kasus'
            )
        );

    // KASUS HARI INI
    $kasusBaru = $db->table('pasien')
        ->where(
            'DATE(tgl_kunjungan)',
            date('Y-m-d')
        )
        ->countAllResults();

// =====================
// JUMLAH KELURAHAN
// =====================

$builderKel = $db->table('pasien p');

$builderKel->join(
    'wilayah w',
    'w.id_wilayah = p.id_wilayah',
    'left'
);

// FILTER BULAN
if(!empty($bulan)){
    $builderKel->where(
        'MONTH(p.tgl_kunjungan)',
        $bulan
    );
}

// FILTER TAHUN
if(!empty($tahun)){
    $builderKel->where(
        'YEAR(p.tgl_kunjungan)',
        $tahun
    );
}

// FILTER JK
if(!empty($jk)){
    $builderKel->where(
        'p.jenis_kelamin',
        $jk
    );
}

$kelurahanTerdampak = $builderKel
    ->select('COUNT(DISTINCT w.kelurahan) as total')
    ->get()
    ->getRow()
    ->total;


// =====================
// FUNFACT PNEUMONIA
// =====================
    $funfactModel = new \App\Models\FunfactPneumoniaModel();

    $funfact = $funfactModel
        ->where('id_penyakit', 3)
        ->where('status_funfact', 'Publish')
        ->orderBy('tanggal_funfact', 'DESC')
        ->first();

    return view(
        'gol_c/dashboard_pneumonia',
        [

        'menu'=>'dashboard',
        'artikels'=>[],

        'totalKasus'=>$totalKasus,
        'kasusBaru'=>$kasusBaru,
        'kelurahanTerdampak'=>$kelurahanTerdampak,

        'pneumonia'=>$pneumonia,

        'funfact'=>$funfact

        ]
    );
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