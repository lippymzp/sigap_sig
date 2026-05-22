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

        // Ambil Funfact
        $funfactModel = new \App\Models\FunfactModel();

        $funfact = $funfactModel
             ->where('id_penyakit', 1)
            ->where('status_funfact', 'upload')
            ->orderBy('tanggal_funfact', 'DESC')
            ->findAll(10);

        // ================= VIDEO =================
        $videoModel = new \App\Models\VideoDbdModel();

        $video = $videoModel
            ->where('id_penyakit', 1)
            ->where('status_video', 'publish')
            ->orderBy('tanggal_video', 'DESC')
            ->findAll(10);

        $bannerModel = new BannerDbdModel();

        $banner = $bannerModel
            ->where('id_penyakit', 1)
            ->where('status_banner', 'publish')
            ->orderBy('urutan', 'ASC')
            ->findAll();
        
                // Tetap pertahankan session internal Kepala Puskesmas
                $id_petugas = session()->get('id_petugas');
                $id_penyakit = 1; // Difokuskan untuk indikator dan data DBD
        
                // ==========================================
                // 1. TANGKAP PARAMETER FILTER (DASHBOARD & PETA)
                // ==========================================
                $wilayah   = $this->request->getGet('wilayah');
                $bulan     = $this->request->getGet('bulan');
                $tahun     = $this->request->getGet('tahun');
                $usia      = $this->request->getGet('usia');
                $jk        = $this->request->getGet('jk');
                
                $bulanMap  = $this->request->getGet('bulan_map');
                $tahunMap  = $this->request->getGet('tahun_map');
                
        
                // Default tahun jika kosong
                if (empty($tahunMap)) {
                    $tahunMap = date('Y');
                }
        
                // ==========================================
                // 2. QUERY UTAMA: DATA PETA & DETAIL DESA (TERFILTER)
                // ==========================================
                $builderMape = $db->table('wilayah w');
        
                $penyakitFilter = "AND p.id_penyakit = 1";
                $bulanMapFilter = !empty($bulanMap) ? "AND MONTH(p.tgl_kunjungan) = " . $db->escape($bulanMap) : "";
                $tahunMapFilter = !empty($tahunMap) ? "AND YEAR(p.tgl_kunjungan) = " . $db->escape($tahunMap) : "";
                
                $jkFilter = "";
                if (!empty($jk)) {
                    $gender   = ($jk == 'L') ? 'Laki-laki' : 'Perempuan';
                    $jkFilter = "AND p.jenis_kelamin = " . $db->escape($gender);
                }
        
                $usiaFilter = "";
                if (!empty($usia)) {
                    if ($usia == 'anak') $usiaFilter = "AND p.umur BETWEEN 0 AND 6";
                    elseif ($usia == 'remaja') $usiaFilter = "AND p.umur BETWEEN 7 AND 18";
                    elseif ($usia == 'dewasa') $usiaFilter = "AND p.umur BETWEEN 19 AND 59";
                    elseif ($usia == 'lansia') $usiaFilter = "AND p.umur >= 60";
                }
        
                $allFilters = "$penyakitFilter $bulanMapFilter $tahunMapFilter $jkFilter $usiaFilter";
        
                $builderMape->select("
                    w.kelurahan as desa,
                    COUNT(DISTINCT CASE WHEN p.id_pasien IS NOT NULL $allFilters THEN p.id_pasien END) as kasus,
                    COUNT(DISTINCT CASE WHEN p.jenis_kelamin = 'Laki-laki' $allFilters THEN p.id_pasien END) as laki,
                    COUNT(DISTINCT CASE WHEN p.jenis_kelamin = 'Perempuan' $allFilters THEN p.id_pasien END) as perempuan,
                    
                    COUNT(DISTINCT CASE WHEN p.umur BETWEEN 0 AND 6 $allFilters THEN p.id_pasien END) as anak,
                    COUNT(DISTINCT CASE WHEN p.umur BETWEEN 7 AND 18 $allFilters THEN p.id_pasien END) as remaja,
                    COUNT(DISTINCT CASE WHEN p.umur BETWEEN 19 AND 59 $allFilters THEN p.id_pasien END) as dewasa,
                    COUNT(DISTINCT CASE WHEN p.umur >= 60 $allFilters THEN p.id_pasien END) as lansia,
                    
                    COUNT(DISTINCT CASE WHEN p.status_akhir = 'Sembuh' $allFilters THEN p.id_pasien END) as sembuh,
                    COUNT(DISTINCT CASE WHEN p.status_akhir = 'Meninggal' $allFilters THEN p.id_pasien END) as meninggal,
                    
                    COALESCE(dp.total_penduduk, 0) as jumlah_penduduk
                ");
        
                $builderMape->join('pasien p', 'p.id_wilayah = w.id_wilayah', 'left');
        
                // Subquery jumlah penduduk khusus id_penyakit = 1
                $subQueryPenduduk = $db->table('data_penduduk')
                    ->select('kelurahan, SUM(total_penduduk) as total_penduduk')
                    ->where('id_penyakit', 1)
                    ->groupBy('kelurahan')
                    ->getCompiledSelect();
                $builderMape->join("($subQueryPenduduk) dp", 'LOWER(REPLACE(dp.kelurahan, " ", "")) = LOWER(REPLACE(w.kelurahan, " ", ""))', 'left');
        
                $builderMape->whereIn('w.kelurahan', ['Sumbersari', 'Wirolegi', 'Antirogo', 'Tegal Gede', 'Karangrejo']);
                $builderMape->groupBy('w.kelurahan, dp.total_penduduk');
                $dbdData = $builderMape->get()->getResultArray();
        
                // ==========================================
                // 3. PROSES DATA DETAIL DESA & INTEGRASI ABJ KADER
                // ==========================================
                $detailDesa = [];
                $list_kelurahan = ['Sumbersari', 'Wirolegi', 'Antirogo', 'Tegal Gede', 'Karangrejo'];
        
                // Mapping Nama Bulan Angka ke String untuk ABJ
                $bulanMapString = '';
                if (!empty($bulanMap)) {
                    $namaBulanArray = [
                        1=>'Januari', 2=>'Februari', 3=>'Maret', 4=>'April', 5=>'Mei', 6=>'Juni',
                        7=>'Juli', 8=>'Agustus', 9=>'September', 10=>'Oktober', 11=>'November', 12=>'Desember'
                    ];
                    $bulanMapString = $namaBulanArray[$bulanMap] ?? '';
                }
        
                foreach ($dbdData as $row) {
                    $namaKel = $row['desa'];
                    $key = preg_replace('/[^a-z0-9]/', '', strtolower($namaKel));
        
                    // Ambil Angka Bebas Jentik (ABJ) per kelurahan secara spesifik
                    $builderABJ = $db->table('rekap_pelaporan_kader')
                        ->select('AVG(abj) as avg_abj, SUM(diperiksa) as rumah_diperiksa, SUM(positif) as rumah_jentik')
                        ->where("LOWER(REGEXP_REPLACE(kelurahan, '[^a-zA-Z0-9]', ''))", $key);
        
                    if (!empty($tahunMap)) {
                        $builderABJ->like('periode_lengkap', $tahunMap);
                    }
                    if (!empty($bulanMapString)) {
                        $builderABJ->where('bulan', $bulanMapString);
                    }
        
                    $resABJ = $builderABJ->get()->getRow();
                    $avg_abj = $resABJ->avg_abj ?? 0;
                    $rmh_periksa = $resABJ->rumah_diperiksa ?? 0;
                    $rmh_jentik = $resABJ->rumah_jentik ?? 0;
        
                    // Hitung Rentang Usia Tertinggi
                    $usiaData = [
                        'Bayi dan Anak Pra-sekolah (0–6 Tahun)' => (int)$row['anak'],
                        'Anak Sekolah dan Remaja (>6–18 Tahun)' => (int)$row['remaja'],
                        'Dewasa (>18–59 Tahun)'                 => (int)$row['dewasa'],
                        'Lansia (≥60 Tahun)'                    => (int)$row['lansia'],
                    ];
                    arsort($usiaData);
                    $usiaTertinggi = ($row['kasus'] > 0) ? array_key_first($usiaData) : '-';
        
                    $detailDesa[$key] = [
                        'jumlah_penduduk' => (int)$row['jumlah_penduduk'],
                        'jumlah_kasus'    => (int)$row['kasus'],
                        'sembuh'          => (int)$row['sembuh'],
                        'meninggal'       => (int)$row['meninggal'],
                        'anak'            => (int)$row['anak'],
                        'remaja'          => (int)$row['remaja'],
                        'dewasa'          => (int)$row['dewasa'],
                        'lansia'          => (int)$row['lansia'],
                        'laki'            => (int)$row['laki'],
                        'perempuan'       => (int)$row['perempuan'],
                        'usia_tertinggi'  => $usiaTertinggi,
                        'abj'             => round($avg_abj, 2),
                        'rumah_diperiksa' => (int)$rmh_periksa,
                        'rumah_jentik'    => (int)$rmh_jentik
                    ];
                }
        
                // Tentukan desa tertinggi kasusnya
                $desa_tertinggi = '-';
                if (!empty($dbdData)) {
                    $tempDbd = $dbdData;
                    usort($tempDbd, function($a, $b) {
                        return $b['kasus'] <=> $a['kasus'];
                    });
                    $desa_tertinggi = ($tempDbd[0]['kasus'] > 0) ? $tempDbd[0]['desa'] : '-';
                }
        
                // ==========================================
                // 4. DATA GRAFIK KASUS (DENGAN FILTER MULTI-OPSI)
                // ==========================================
                $builderGrafik = $db->table('wilayah w');
                $builderGrafik->select("
                    w.kelurahan as wilayah,
                    COUNT(DISTINCT CASE WHEN p.umur BETWEEN 0 AND 6 AND p.id_penyakit = 1 THEN p.id_pasien END) as anak,
                    COUNT(DISTINCT CASE WHEN p.umur BETWEEN 7 AND 18 AND p.id_penyakit = 1 THEN p.id_pasien END) as remaja,
                    COUNT(DISTINCT CASE WHEN p.umur BETWEEN 19 AND 59 AND p.id_penyakit = 1 THEN p.id_pasien END) as dewasa,
                    COUNT(DISTINCT CASE WHEN p.umur >= 60 AND p.id_penyakit = 1 THEN p.id_pasien END) as lansia
                ");
                $builderGrafik->join('pasien p', 'p.id_wilayah = w.id_wilayah', 'left');
                $builderGrafik->whereIn('w.kelurahan', ['Sumbersari', 'Wirolegi', 'Antirogo', 'Tegal Gede', 'Karangrejo']);
        
                if (!empty($bulan)) $builderGrafik->where('MONTH(p.tgl_kunjungan)', $bulan);
                if (!empty($tahun)) $builderGrafik->where('YEAR(p.tgl_kunjungan)', $tahun);
                if (!empty($jk)) $builderGrafik->where('p.jenis_kelamin', $jk == 'L' ? 'Laki-laki' : 'Perempuan');
                if (!empty($usia)) {
            if ($usia == 'anak')         $builderGrafik->where('p.umur >=', 0)->where('p.umur <=', 6);
            elseif ($usia == 'remaja')   $builderGrafik->where('p.umur >=', 7)->where('p.umur <=', 18);
            elseif ($usia == 'dewasa')   $builderGrafik->where('p.umur >=', 19)->where('p.umur <=', 59);
            elseif ($usia == 'lansia')   $builderGrafik->where('p.umur >=', 60);
        }
                
                if (!empty($wilayah)) {
                    $namaWilayah = ($wilayah === 'Tegalgede') ? 'Tegal Gede' : $wilayah;
                    $builderGrafik->where('w.kelurahan', $namaWilayah);
                }
        
                $builderGrafik->groupBy('w.kelurahan');
                $grafikDataMapped = $builderGrafik->get()->getResultArray();
        
                // Ambil data tabel Master Penduduk untuk Modal Penduduk di Halaman Kepala
                $pendudukData = $db->table('data_penduduk')
                    ->where('id_penyakit', 1)
                    ->get()
                    ->getResultArray();
        // ==========================================
        // 4b. DATA GRAFIK MORTALITAS PER BULAN (BARU)
        // ==========================================
        $builderMort = $db->table('wilayah w');
        $builderMort->select("
            MONTH(p.tgl_kunjungan) as bulan_angka,
            w.kelurahan as wilayah,
            COUNT(DISTINCT CASE WHEN p.status_akhir = 'Meninggal' AND p.id_penyakit = 1 THEN p.id_pasien END) as meninggal
        ");
        $builderMort->join('pasien p', 'p.id_wilayah = w.id_wilayah', 'left');
        $builderMort->whereIn('w.kelurahan', ['Sumbersari', 'Wirolegi', 'Antirogo', 'Tegal Gede', 'Karangrejo']);
        $builderMort->where('p.id_penyakit', 1);
        
        if (!empty($this->request->getGet('tahun_mort'))) {
            $builderMort->where('YEAR(p.tgl_kunjungan)', $this->request->getGet('tahun_mort'));
        }
        if (!empty($this->request->getGet('jk_mort'))) {
            $jkMort = $this->request->getGet('jk_mort') == 'L' ? 'Laki-laki' : 'Perempuan';
            $builderMort->where('p.jenis_kelamin', $jkMort);
        }
        if (!empty($this->request->getGet('wilayah_mort'))) {
            $namaWilMort = ($this->request->getGet('wilayah_mort') === 'Tegalgede') ? 'Tegal Gede' : $this->request->getGet('wilayah_mort');
            $builderMort->where('w.kelurahan', $namaWilMort);
        }
        
        $builderMort->groupBy('MONTH(p.tgl_kunjungan), w.kelurahan');
        $builderMort->orderBy('MONTH(p.tgl_kunjungan)', 'ASC');
        $grafikMortalitas = $builderMort->get()->getResultArray();
        // ==========================================
        // 4c. DATA GRAFIK ABJ PER WILAYAH (DENGAN FILTER ABJ)
        // ==========================================
        $wilayahAbj = $this->request->getGet('wilayah_abj');
        $bulanAbj   = $this->request->getGet('bulan_abj');
        $tahunAbj   = $this->request->getGet('tahun_abj');
        
        $listKelurahanAbj = ['Sumbersari', 'Wirolegi', 'Antirogo', 'Tegal Gede', 'Karangrejo'];
        if (!empty($wilayahAbj)) {
            $namaWilAbj = ($wilayahAbj === 'Tegalgede') ? 'Tegal Gede' : $wilayahAbj;
            $listKelurahanAbj = [$namaWilAbj];
        }
        
        $bulanAbjString = '';
        if (!empty($bulanAbj)) {
            $namaBulanArrayAbj = [
                1=>'Januari', 2=>'Februari', 3=>'Maret', 4=>'April', 5=>'Mei', 6=>'Juni',
                7=>'Juli', 8=>'Agustus', 9=>'September', 10=>'Oktober', 11=>'November', 12=>'Desember'
            ];
            $bulanAbjString = $namaBulanArrayAbj[$bulanAbj] ?? '';
        }
        
        $grafikAbj = [];
        foreach ($listKelurahanAbj as $namaKelAbj) {
            $keyAbj = preg_replace('/[^a-z0-9]/', '', strtolower($namaKelAbj));
        
            $builderAbjGrafik = $db->table('rekap_pelaporan_kader')
                ->select('AVG(abj) as avg_abj')
                ->where("LOWER(REGEXP_REPLACE(kelurahan, '[^a-zA-Z0-9]', ''))", $keyAbj);
        
            if (!empty($tahunAbj)) {
                $builderAbjGrafik->like('periode_lengkap', $tahunAbj);
            }
            if (!empty($bulanAbjString)) {
                $builderAbjGrafik->where('bulan', $bulanAbjString);
            }
        
            $resAbjGrafik = $builderAbjGrafik->get()->getRow();
            $grafikAbj[] = [
                'wilayah' => $namaKelAbj,
                'abj'     => round($resAbjGrafik->avg_abj ?? 0, 2)
            ];
        }
                // ==========================================
                // 5. KIRIM DATA KE LAYOUT
                // ==========================================
                return view('gol_a/dbd', [
                    'grafik'         => $grafikDataMapped,
                    'dbd'            => $dbdData,
                    'detailDesa'     => $detailDesa,
                    'desaTertinggi'  => $desa_tertinggi,
                    'penduduk'       => $pendudukData,
                    'grafikMortalitas' => $grafikMortalitas,
                    'grafikAbj'        => $grafikAbj,
                    'funfact'       => $funfact,
                    'video'         => $video,
                    'banner'        => $banner,
                    'show_footer_maskot' => true,
                    'footer_maskot' => 'logo_denggis.png'
                ]);
                
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

            $dataBerita = $builder
                ->where('id_penyakit', 1)
                ->where('status_berita', 'publish')
                ->findAll();

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

            $dataFunfact = $builder
                ->where('id_penyakit', 1)
                ->where('status_funfact', 'upload')
                ->findAll();

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

    $video = $videoModel
        ->where('id_penyakit', 1)
        ->where('status_video', 'publish')
        ->findAll();

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