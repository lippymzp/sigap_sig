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
    $builder->join('wilayah wl', 'wl.id_wilayah = p.id_wilayah', 'left');
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

    // =========================
    // 1️⃣ BERITA
    // =========================
    $berita = $beritaModel
        ->where('status_berita', 'Publish')
        ->orderBy('id_berita', 'DESC')
        ->findAll();

    // =========================
    // 2️⃣ FUNFACT
    // =========================
    $funfact = $funfactModel
        ->where('status_funfact', 'Publish')
        ->orderBy('id_funfact', 'DESC')
        ->findAll();

    // =========================
    // 3️⃣ AMBIL DATA PASIEN UNTUK CHART
    // =========================
    $tbc = $db->table('pasien')
        ->where('id_penyakit', 2) // TBC
        ->get()
        ->getResultArray();

    // =========================
    // 4️⃣ AMBIL DATA UNTUK MAP + MODAL
    // =========================
    $mapTbc = $db->table('pasien p')
        ->select('
            p.id_wilayah,
            wl.kelurahan,
            YEAR(p.tgl_kunjungan) as tahun,
            COUNT(p.id_pasien) as kasus,
            SUM(CASE WHEN p.umur <= 12 THEN 1 ELSE 0 END) as anak,
            SUM(CASE WHEN p.umur BETWEEN 13 AND 59 THEN 1 ELSE 0 END) as dewasa,
            SUM(CASE WHEN p.umur >= 60 THEN 1 ELSE 0 END) as lansia,
            COUNT(*) as penduduk
        ')
        ->join('wilayah wl', 'wl.id_wilayah = p.id_wilayah', 'left')
        ->groupBy('p.id_wilayah, YEAR(p.tgl_kunjungan)')
        ->get()
        ->getResultArray();

    // =========================
    // 5️⃣ SIAPKAN DATA UNTUK CHART
    // =========================
    $mappingWilayah = [
        2001 => 'Jemberkidul',
        2002 => 'Tegalbesar',
        2003 => 'Kaliwates',
        2004 => 'Kebonagung',
        2005 => 'Sempusari',
        2006 => 'Mangli',
        2007 => 'Kepatihan'
    ];

    $wilayah = ['Jemberkidul','Tegalbesar','Kaliwates','Kebonagung','Sempusari','Mangli','Kepatihan','Lainnya'];
    $bulanList = ['01','02','03','04','05','06','07','08','09','10','11','12'];
    $kategoriList = ['Balita','Anak-anak','Remaja','Dewasa','Lansia'];
    $statusList = ['Pengobatan Lengkap','Sembuh','Meninggal','Putus Berobat','Pindah'];

    $grafik = [];
    foreach($bulanList as $b){
        foreach(['laki','perempuan'] as $gender){
            foreach($kategoriList as $k){
                foreach($wilayah as $w){
                    foreach($statusList as $s){
                        $grafik[$b][$gender][$k][$w][$s] = 0;
                    }
                }
            }
        }
    }

    foreach($tbc as $p){
        $umur = (int)$p['umur'];
        if($umur <=4) $kategoriUmur='Balita';
        elseif($umur<=9) $kategoriUmur='Anak-anak';
        elseif($umur<=18) $kategoriUmur='Remaja';
        elseif($umur<=59) $kategoriUmur='Dewasa';
        else $kategoriUmur='Lansia';

        $gender = ($p['jenis_kelamin']=='Perempuan') ? 'perempuan' : 'laki';
        $kodeBulan = str_pad(date('m', strtotime($p['tgl_kunjungan'])),2,'0',STR_PAD_LEFT);
        $namaWilayah = $mappingWilayah[$p['id_wilayah']] ?? 'Lainnya';
        $status = $p['status_akhir'] ?? 'Pengobatan Lengkap';

        if($p['id_penyakit'] != 2) continue;
        if(!isset($mappingWilayah[$p['id_wilayah']])) continue;
 

        $grafik[$kodeBulan][$gender][$kategoriUmur][$namaWilayah][$status] 
    = ($grafik[$kodeBulan][$gender][$kategoriUmur][$namaWilayah][$status] ?? 0) + 1;
    }


    // =========================
    // 6️⃣ HITUNG STATUS PASIEN
    // =========================
    $jumlah_sembuh = $db->table('pasien')->where('status_akhir','Sembuh')->countAllResults();
    $jumlah_pengobatan = $db->table('pasien')->where('status_akhir','Pengobatan')->countAllResults();
    $jumlah_meninggal = $db->table('pasien')->where('status_akhir','Meninggal')->countAllResults();

    // =========================
    // 7️⃣ STATISTIK DASHBOARD
    // =========================
$totalKasusAktif = $db->table('pasien')
    ->where('id_penyakit', 2)
    ->countAllResults();
      $kasusBulanIni = $db->table('pasien')
    ->where('id_penyakit', 2)
    ->where('MONTH(tgl_kunjungan)', date('m'))
    ->where('YEAR(tgl_kunjungan)', date('Y'))
    ->countAllResults();
    $kelurahanTerdampak = $db->table('pasien')
        ->where('id_penyakit',2)
        ->select('id_wilayah')
        ->groupBy('id_wilayah')
        ->countAllResults();

    // =========================
    // 8️⃣ RETURN VIEW
    // =========================
    return view('gol_b/dashboard_tbc', [
        'menu' => 'dashboard',
        'berita' => $berita,
        'funfact' => $funfact,
        'tbc' => $tbc,
        'mapTbc' => $mapTbc, // kini lengkap untuk modal
        'grafik' => json_encode($grafik),
        'wilayah' => json_encode($wilayah),
        'bulanList' => json_encode($bulanList),
        'statusList' => json_encode($statusList),
        'jumlah_sembuh' => $jumlah_sembuh,
        'jumlah_pengobatan' => $jumlah_pengobatan,
        'jumlah_meninggal' => $jumlah_meninggal,
        'totalKasusAktif' => $totalKasusAktif,
        'kasusBulanIni' => $kasusBulanIni,
        'kelurahanTerdampak' => $kelurahanTerdampak
    ]);
}
public function grafik()
{
    // Redirect ke dashboard TBC dan scroll ke grafik
    return redirect()->to('/tbc/dashboard#grafik-dashboard');
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
    COUNT(p.id_pasien) as kasus
");

    $builder->join(
        'wilayah w',
        'w.id_wilayah = p.id_wilayah',
        'left'
    );

    $builder->where('p.id_penyakit', 3);

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

$builder->groupBy("
    w.kelurahan,
    p.jenis_kelamin,
    MONTH(p.tgl_kunjungan),
    YEAR(p.tgl_kunjungan)
");

    $pneumonia =
        $builder->get()
        ->getResultArray();

    // =====================
    // LIST TAHUN PERIODE
    // =====================

    $tahunList = [];

    foreach ($pneumonia as $item) {

        if (!empty($item['tgl_kunjungan'])) {

            $tahunData = date(
                'Y',
                strtotime($item['tgl_kunjungan'])
            );

            // hanya tampil 2025 dan 2026
            if (
                $tahunData == '2025' ||
                $tahunData == '2026'
            ) {

                $tahunList[] = $tahunData;
            }
        }
    }

    // hapus duplikat
    $tahunList = array_unique($tahunList);

    // urut terbaru
    rsort($tahunList);

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
    ->where('id_penyakit', 3)
    ->where(
        'DATE(tgl_kunjungan)',
        date('Y-m-d')
    )
    ->where('id_penyakit', 3)
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

    $builderKel->where('p.id_penyakit', 3);

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

    // =====================
    // NOTIFIKASI RISIKO
    // =====================

    $notif = $db->table('skrining s')

        ->select('
            p.nama_pasien_skrining,
            p.jenis_kelamin,
            p.usia,
            s.tanggal,
            s.hasil
        ')

        ->join(
            'pasien_skrining p',
            'p.id_pasien_skrining = s.id_pasien_skrining'
        )

        ->where('s.id_penyakit', 3)

        ->where('s.hasil', 'Berisiko')

        ->orderBy('s.id_skrining', 'DESC')

        ->limit(3)

        ->get()

        ->getResultArray();

    return view(
        'gol_c/dashboard_pneumonia',
        [

            'menu' => 'dashboard',
            'artikels' => [],

            'totalKasus' => $totalKasus,
            'kasusBaru' => $kasusBaru,
            'kelurahanTerdampak' => $kelurahanTerdampak,

            'pneumonia' => $pneumonia,

            // INI YANG BARU
            'tahunList' => $tahunList,

            'funfact' => $funfact,
            'notif' => $notif

        ]
    );
}

public function peta_sebaran_pneumonia()
{
    $db = \Config\Database::connect();

    $bulan = $this->request->getGet('bulan');
    $tahun = $this->request->getGet('tahun');
    $jk    = $this->request->getGet('jk');

    // =====================
    // DATA PETA PNEUMONIA
    // =====================
    $builder = $db->table('pasien p');

    $builder->select("
        w.kelurahan as desa,
        p.jenis_kelamin,
        p.umur,
        p.tgl_kunjungan,
        COUNT(p.id_pasien) as kasus
    ");

    $builder->join(
        'wilayah w',
        'w.id_wilayah = p.id_wilayah',
        'left'
    );

    $builder->where('p.id_penyakit', 3);

    if(!empty($bulan)){
        $builder->where('MONTH(p.tgl_kunjungan)', $bulan);
    }

    if(!empty($tahun)){
        $builder->where('YEAR(p.tgl_kunjungan)', $tahun);
    }

    if(!empty($jk)){
        $builder->where('p.jenis_kelamin', $jk);
    }

    $builder->groupBy("
        w.kelurahan,
        p.jenis_kelamin,
        MONTH(p.tgl_kunjungan),
        YEAR(p.tgl_kunjungan)
    ");

    $pneumonia = $builder->get()->getResultArray();

    // =====================
    // LIST TAHUN
    // =====================
    $tahunQuery = $db->table('pasien')
        ->select('YEAR(tgl_kunjungan) as tahun')
        ->where('id_penyakit', 3)
        ->where('tgl_kunjungan IS NOT NULL')
        ->groupBy('YEAR(tgl_kunjungan)')
        ->orderBy('tahun', 'DESC')
        ->get()
        ->getResultArray();

    $tahunList = [];

    foreach($tahunQuery as $t){
        if(!empty($t['tahun'])){
            $tahunList[] = $t['tahun'];
        }
    }

    // Tahun manual agar tetap muncul di filter
    $tahunList[] = '2026';
    $tahunList[] = '2025';

    // Hilangkan duplikat dan urutkan terbaru
    $tahunList = array_unique($tahunList);
    rsort($tahunList);

    // =====================
    // TOTAL KASUS
    // =====================
    $totalKasus = array_sum(
        array_column($pneumonia, 'kasus')
    );

    // =====================
    // KASUS BARU BULAN INI
    // =====================
    $kasusBaru = $db->table('pasien')
        ->where('id_penyakit', 3)
        ->where('YEAR(tgl_kunjungan)', date('Y'))
        ->where('MONTH(tgl_kunjungan)', date('m'))
        ->countAllResults();

    // =====================
    // NOTIFIKASI RISIKO
    // =====================
    $notif = $db->table('skrining s')
        ->select('
            p.nama_pasien_skrining,
            p.jenis_kelamin,
            p.usia,
            s.tanggal,
            s.hasil
        ')
        ->join(
            'pasien_skrining p',
            'p.id_pasien_skrining = s.id_pasien_skrining'
        )
        ->where('s.id_penyakit', 3)
        ->where('s.hasil', 'Berisiko')
        ->orderBy('s.id_skrining', 'DESC')
        ->limit(3)
        ->get()
        ->getResultArray();

    return view('gol_c/peta_sebaran_pneumonia', [
        'menu'       => 'peta',
        'judul'      => 'Peta Sebaran',
        'pneumonia'  => $pneumonia,
        'tahunList'  => $tahunList,
        'totalKasus' => $totalKasus,
        'kasusBaru'  => $kasusBaru,
        'notif'      => $notif
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