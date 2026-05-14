<?php

namespace App\Controllers;
use App\Models\BeritaDbdModel;
use App\Models\FunfactModel;
use App\Models\VideoDbdModel;
use App\Models\BannerDbdModel;

class LandingpageDbd extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();

        // Ambil filter dari request
        $bulan   = $this->request->getGet('bulan');
        $tahun   = $this->request->getGet('tahun');
        $usia    = $this->request->getGet('usia');
        $jk      = $this->request->getGet('jk');
        $wilayah = $this->request->getGet('wilayah');
        
        // Filter khusus ABJ
        $bulan_abj = $this->request->getGet('bulan_abj');
        $tahun_abj = $this->request->getGet('tahun_abj');
        $wilayah_abj = $this->request->getGet('wilayah_abj');

        // Filter untuk Map
        $tahun_map = $this->request->getGet('tahun_map') ?? date('Y');

        // 1. Ambil Data Grafik Kasus
        $grafik = $this->getGrafik($db, $bulan, $tahun, $usia, $jk, $wilayah);

        // 2. Ambil Data Map & Detail Desa
        [$dbd, $detailDesa, $desaTertinggi] = $this->getMapData($db, $tahun_map);

        // 3. Ambil Data ABJ
        $dataABJ = $this->getABJData($db, $bulan_abj, $tahun_abj, $wilayah_abj);
        // 4. Ambil Funfact
        $funfactModel = new \App\Models\FunfactModel();

        $funfact = $funfactModel
            ->where('status_funfact', 'upload')
            ->orderBy('tanggal_funfact', 'DESC')
            ->findAll(10);

        // ================= VIDEO =================
        $videoModel = new \App\Models\VideoDbdModel();

        $video = $videoModel
            ->where('status_video', 'publish')
            ->orderBy('tanggal_video', 'DESC')
            ->findAll(10);

        $bannerModel = new BannerDbdModel();

        $banner = $bannerModel
            ->where('status_banner', 'publish')
            ->orderBy('urutan', 'ASC')
            ->findAll();

       return view('gol_a/dbd', [
    'grafik'        => $grafik,
    'detailDesa'    => $detailDesa,
    'desaTertinggi' => $desaTertinggi,
    'tahun_map'     => $tahun_map,
    'dataFinalABJ'  => $dataABJ,
    'tab_aktif'     => $this->request->getGet('tab') ?? 'kasus',

    // FUNFACT
    'funfact'       => $funfact,
    'video'         => $video,
    'banner'        => $banner,
    'show_footer_maskot' => true,
    'footer_maskot' => 'logo_denggis.png'
]);
    }

    private function getGrafik($db, $bulan, $tahun, $usia, $jk, $wilayah)
{
    $builder = $db->table('pasien p');
    $builder->select('w.kelurahan as desa, COUNT(*) as kasus');

    $builder->join(
        'wilayah w',
        'w.id_wilayah = p.id_wilayah',
        'left'
    );

    if ($bulan) $builder->where('MONTH(p.tgl_kunjungan)', $bulan);
    if ($tahun) $builder->where('YEAR(p.tgl_kunjungan)', $tahun);
    if ($jk) $builder->where('p.jenis_kelamin', $jk == 'L' ? 'Laki-laki' : 'Perempuan');

    if ($wilayah) {
        $builder->where('w.kelurahan', $wilayah);
    }

    if ($usia) {
        if ($usia == 'anak') $builder->where('p.umur <=', 14);
        elseif ($usia == 'remaja') $builder->where('p.umur BETWEEN 15 AND 24');
        elseif ($usia == 'dewasa') $builder->where('p.umur BETWEEN 25 AND 59');
        elseif ($usia == 'lansia') $builder->where('p.umur >=', 60);
    }

    $builder->groupBy('w.kelurahan');

    return $builder->get()->getResultArray();
}

    private function getMapData($db, $tahun)
{
    $builder = $db->table('wilayah w');

    $builder->select("
    w.kelurahan as desa,
    COUNT(p.id_wilayah) as kasus,

    COALESCE(SUM(CASE 
        WHEN p.jenis_kelamin = 'Laki-laki' THEN 1 
        ELSE 0 
    END),0) as laki,

    COALESCE(SUM(CASE 
        WHEN p.jenis_kelamin = 'Perempuan' THEN 1 
        ELSE 0 
    END),0) as perempuan,

    COALESCE(SUM(CASE 
        WHEN p.umur <= 14 THEN 1 
        ELSE 0 
    END),0) as anak,

    COALESCE(SUM(CASE 
        WHEN p.umur BETWEEN 15 AND 59 THEN 1 
        ELSE 0 
    END),0) as dewasa,

    COALESCE(SUM(CASE 
        WHEN p.umur >= 60 THEN 1 
        ELSE 0 
    END),0) as lansia,

    COALESCE(SUM(r.diperiksa),0) as rumah_periksa,

    COALESCE(SUM(r.positif),0) as rumah_jentik
");

    $builder->join(
        'pasien p',
        "p.id_wilayah = w.id_wilayah 
        AND YEAR(p.tgl_kunjungan) = '$tahun'",
        'left'
    );

    $builder->join(
    'rekap_pelaporan_kader r',
    'LOWER(REPLACE(r.kelurahan, " ", "")) = LOWER(REPLACE(w.kelurahan, " ", ""))',
    'left'
);

    $builder->groupBy('w.kelurahan');

    $dbd = $builder->get()->getResultArray();

        $detailDesa = [];
        $desaTertinggi = '-';
        $maxKasus = -1;
        $penduduk = ['sumbersari'=>35000, 'wirolegi'=>25000, 'antirogo'=>20000, 'tegalgede'=>22000, 'karangrejo'=>28000];

        foreach ($dbd as $row) {
            $key = preg_replace('/[^a-z0-9]/', '', strtolower($row['desa']));
            $kasus = (int)$row['kasus'];

            if ($kasus > $maxKasus) {
                $maxKasus = $kasus;
                $desaTertinggi = $row['desa'];
            }

            $usiaArr = ['Anak-anak' => $row['anak'], 'Dewasa' => $row['dewasa'], 'Lansia' => $row['lansia']];
            arsort($usiaArr);

            $detailDesa[$key] = [
    'nama' => $row['desa'],
    'jumlah_penduduk' => $penduduk[$key] ?? 20000,
    'jumlah_kasus' => $kasus,
    'kategori' => ($kasus >= 20 ? 'tinggi' : ($kasus >= 10 ? 'sedang' : 'rendah')),

    'anak' => (int)$row['anak'],
    'dewasa' => (int)$row['dewasa'],
    'lansia' => (int)$row['lansia'],

    'laki' => (int)$row['laki'],
    'perempuan' => (int)$row['perempuan'],

    'rumah_periksa' => (int)$row['rumah_periksa'],
'rumah_jentik' => (int)$row['rumah_jentik'],

    'usia_tertinggi' => array_key_first($usiaArr)
];
        }
        return [$dbd, $detailDesa, $desaTertinggi];
    }

    private function getABJData($db, $bulan, $tahun, $wilayah)
    {
        $builder = $db->table('rekap_pelaporan_kader');
        $bulanMap = [1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember'];

        if ($bulan && isset($bulanMap[$bulan])) $builder->where('bulan', $bulanMap[$bulan]);
        if ($tahun) $builder->like('periode_lengkap', $tahun);

        $builder->select('id_kelurahan, minggu, AVG(abj) as avg_abj');
        $builder->groupBy('id_kelurahan, minggu');
        $raw = $builder->get()->getResultArray();

        $kelMap = [1=>'Sumbersari', 2=>'Wirolegi', 3=>'Antirogo', 4=>'Tegal Gede', 5=>'Karangrejo'];
        $final = [];
        foreach ($kelMap as $n) { $final[$n] = [0,0,0,0]; }

        foreach ($raw as $row) {
            $namaKel = $kelMap[$row['id_kelurahan']] ?? '';
            if ($namaKel && preg_match('/(\d+)/', $row['minggu'], $m)) {
                $idx = intval($m[1]) - 1;
                if ($idx >= 0 && $idx <= 3) $final[$namaKel][$idx] = round($row['avg_abj'], 2);
            }
        }

        if ($wilayah) {
            foreach ($final as $k => $v) { if ($k !== $wilayah) unset($final[$k]); }
        }
        return $final;
    }

    public function list_berita()
    {
        $beritaModel  = new BeritaDbdModel();
        $funfactModel = new FunfactModel();

        $keyword  = $this->request->getGet('keyword');
        $kategori = $this->request->getGet('kategori');

        $semuaData = [];

        // =========================
        // AMBIL BERITA
        // =========================
        if ($kategori == '' || $kategori == 'Berita Kesehatan') {

            $builder = $beritaModel;

            if (!empty($keyword)) {
                $builder = $builder->like('judul_berita', $keyword)
                                   ->orLike('deskripsi_berita', $keyword);
            }

            $dataBerita = $builder->findAll();

            foreach ($dataBerita as $b) {
                $b['tipe'] = 'berita';
                $semuaData[] = $b;
            }
        }

        // =========================
        // AMBIL FUNFACT
        // =========================
        if ($kategori == '' || $kategori == 'Funfact DBD') {

            $builder = $funfactModel;

            if (!empty($keyword)) {
                $builder = $builder->like('judul_funfact', $keyword)
                                   ->orLike('deskripsi_funfact', $keyword);
            }

            $dataFunfact = $builder->findAll();

            foreach ($dataFunfact as $f) {
                $f['tipe'] = 'funfact';
                $semuaData[] = $f;
            }
        }

        // =========================
        // KIRIM KE VIEW
        // =========================
        return view('gol_a/berita/list_berita', [
            'semuaData' => $semuaData,
            'keyword'   => $keyword,
            'kategori'  => $kategori
        ]);
    }
    public function list_video()
{
    $videoModel = new VideoDbdModel();

    $status = $this->request->getGet('status');

    $video = $videoModel->findAll();

    // =========================
    // SESSION WATCHED VIDEO
    // =========================
    $watched = session()->get('watched_video');

    if (!is_array($watched)) {
        $watched = [];
    }

    // =========================
    // FILTER: SUDAH DITONTON
    // =========================
    if ($status === 'sudah') {

        $video = array_values(array_filter($video, function ($v) use ($watched) {
            return in_array($v['id_video'], $watched);
        }));
    }

    // =========================
    // FILTER: BELUM DITONTON
    // =========================
    elseif ($status === 'belum') {

        $video = array_values(array_filter($video, function ($v) use ($watched) {
            return !in_array($v['id_video'], $watched);
        }));
    }

    // =========================
    // FILTER: BARU (SORT)
    // =========================
    elseif ($status === 'baru') {

        usort($video, function ($a, $b) {
            return $b['id_video'] <=> $a['id_video'];
        });
    }

    return view('gol_a/video/list_video', [
        'video'  => $video,
        'status' => $status
    ]);
}
}