<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BeritaTbcModel;
use App\Models\FunfactTbcModel;

class KepalaTbc extends BaseController
{
    public function dashboard()
    {
        $db = \Config\Database::connect();
        $beritaModel = new BeritaTbcModel();
        $funfactModel = new FunfactTbcModel();

        // =========================
        // Berita & Funfact
        // =========================
        $berita = $beritaModel->where('status_berita','Publish')->orderBy('id_berita','DESC')->findAll();
        $funfact = $funfactModel->where('status_funfact','Publish')->orderBy('id_funfact','DESC')->findAll();

        // =========================
        // Ambil data pasien TBC
        // =========================
        $tbc = $db->table('pasien p')
                  ->join('wilayah w','p.id_wilayah = w.id_wilayah','left')
                  ->get()
                  ->getResultArray();

        // =========================
        // Setup untuk chart
        // =========================
        

        //$wilayah = ['Jemberkidul','Tegalbesar','Kaliwates','Kebonagung','Sempusari','Mangli','Kepatihan','Lainnya'];
        $wilayah = [
            'jemberkidul',
            'kepatihan',
            'sempusari',
            'mangli',
            'kebonagung',
            'kaliwates',
            'tegalbesar',
            'lainnya'
        ];
        $kategoriList = ['Balita','Anak-anak','Remaja','Dewasa','Lansia'];
        $bulanList = ['01','02','03','04','05','06','07','08','09','10','11','12'];
        $statusList = ['Pengobatan Lengkap','Sembuh','Meninggal','Putus Berobat','Pindah'];
        $genderList = ['laki','perempuan'];

        // Inisialisasi grafik
        $grafik = [];
        foreach($bulanList as $b){
            foreach($genderList as $gender){
                foreach($kategoriList as $k){
                    foreach($wilayah as $w){
                        foreach($statusList as $s){
                            $grafik[$b][$gender][$k][$w][$s] = 0;
                        }
                    }
                }
            }
        }

        // Loop data pasien untuk chart
        foreach($tbc as $p){
            $umur = (int)($p['umur'] ?? 0);
            if($umur<=4) $kUmur='Balita';
            elseif($umur<=9) $kUmur='Anak-anak';
            elseif($umur<=18) $kUmur='Remaja';
            elseif($umur<=59) $kUmur='Dewasa';
            else $kUmur='Lansia';

            $gender = ($p['jenis_kelamin']=='Perempuan') ? 'perempuan' : 'laki';
            $kodeBulan = str_pad(date('m', strtotime($p['tgl_kunjungan'] ?? date('Y-m-d'))),2,'0',STR_PAD_LEFT);
            //$namaWilayah = $mappingWilayah[$p['id_wilayah'] ?? 0] ?? 'Lainnya';
            $namaWilayah = preg_replace(
                '/\s+/',
                '',
                strtolower($p['kelurahan'] ?? 'lainnya')
            );
            $status = trim($p['status_akhir'] ?? ''); if ($status == '' || $status == 'Pengobatan') {
                $status = 'Pengobatan Lengkap';
            }
            
            if (!isset($grafik[$kodeBulan][$gender][$kUmur][$namaWilayah][$status])) {
                $grafik[$kodeBulan][$gender][$kUmur][$namaWilayah][$status] = 0;
            }
            
            $grafik[$kodeBulan][$gender][$kUmur][$namaWilayah][$status]++;
        }

        // =========================
        // Statistik
        // =========================
$totalKasusAktif = $db->table('pasien')
    ->where('id_penyakit', 2)
    ->countAllResults();       
$kasusBulanIni = $db->table('pasien')
    ->where('id_penyakit', 2)
    ->where('MONTH(tgl_kunjungan)', date('m'))
    ->where('YEAR(tgl_kunjungan)', date('Y'))
    ->countAllResults();        // $kelurahanTerdampak = $db->table('pasien')->select('id_wilayah')->groupBy('id_wilayah')->countAllResults();
        $kelurahanTerdampak = $db->table('pasien p')
        ->join('wilayah w', 'w.id_wilayah = p.id_wilayah')
        ->select('p.id_wilayah')
        ->whereIn('p.id_wilayah', [
            2001,
            2002,
            2003,
            2004,
            2005,
            2006,
            2007
        ])
        ->groupBy('p.id_wilayah')
        ->countAllResults();
        $jumlah_sembuh = $db->table('pasien')->where('status_akhir','Sembuh')->countAllResults();
        $jumlah_pengobatan = $db->table('pasien')->where('status_akhir','Pengobatan')->countAllResults();
        $jumlah_meninggal = $db->table('pasien')->where('status_akhir','Meninggal')->countAllResults();

        // =========================
        // Detail Desa
        // =========================
        // =========================
        // DATA UNTUK MAP + MODAL
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
            ->join(
                'wilayah wl',
                'wl.id_wilayah = p.id_wilayah',
                'left'
            )
            ->groupBy('p.id_wilayah, YEAR(p.tgl_kunjungan)')
            ->get()
            ->getResultArray();

        // =========================
        // Render view
        // =========================
        return view('gol_b/dashboard_tbc_kapus', [
            'role' => 'Kepala Puskesmas',
            'judul' => 'Dashboard Kepala Puskesmas',
            'menu' => 'dashboard',
            'berita' => $berita,
            'funfact' => $funfact,
            'tbc' => $tbc,
            'mapTbc' => $mapTbc,
            'grafik' => json_encode($grafik),
            'wilayah' => json_encode($wilayah),
            'bulanList' => json_encode($bulanList),
            'statusList' => json_encode($statusList),
            'kategoriList' => json_encode($kategoriList),
            'genderList' => json_encode($genderList),
            'jumlah_sembuh' => $jumlah_sembuh,
            'jumlah_pengobatan' => $jumlah_pengobatan,
            'jumlah_meninggal' => $jumlah_meninggal,
            'totalKasusAktif' => $totalKasusAktif,
            'kasusBulanIni' => $kasusBulanIni,
            'kelurahanTerdampak' => $kelurahanTerdampak
        ]);
    }

    // =========================
    // Export Data
    // =========================
    public function export()
    {
        $db = \Config\Database::connect();

        $data['pasien'] = $db->table('pasien p')
            ->select('p.*, w.kelurahan')
            ->join('wilayah w','w.id_wilayah=p.id_wilayah','left')
            ->get()
            ->getResultArray();

        $data['menu'] = 'export';
        return view('gol_b/export_kepala', $data);
    }

    public function profil()
    {
        $petugas = [
            'nama_petugas' => session()->get('username'),
            'email'        => session()->get('email'),
            'password'     => '123456',
            'foto_profil'  => session()->get('foto')
        ];

        return view('gol_b/profil_user', [
            'judul'   => 'Profil User',
            'menu'    => 'profil',
            'petugas' => $petugas
        ]);
    }

    public function exportData()
{
    $type  = $this->request->getGet('type');
    $mode  = $this->request->getGet('mode');
    $tahun = $this->request->getGet('tahun');
    $waktu = $this->request->getGet('waktu');
    $kel   = $this->request->getGet('kelurahan');

    $db = \Config\Database::connect();

    $builder = $db->table('pasien p')
        ->select('p.*, w.kelurahan')
        ->join('wilayah w', 'w.id_wilayah = p.id_wilayah', 'left');

    if ($kel != 'semua') {
        $builder->where('w.kelurahan', $kel);
    }

    if ($tahun) {
        $builder->where('YEAR(p.tgl_kunjungan)', $tahun);
    }

    if ($mode == 'bulanan' && $waktu) {
        $builder->where('MONTH(p.tgl_kunjungan)', $waktu);
    } elseif ($mode == 'triwulan' && $waktu) {
        $start = ($waktu - 1) * 3 + 1;
        $builder->where('MONTH(p.tgl_kunjungan) >=', $start)
                ->where('MONTH(p.tgl_kunjungan) <=', $start + 2);
    } elseif ($mode == 'semester' && $waktu) {
        $start = ($waktu - 1) * 6 + 1;
        $builder->where('MONTH(p.tgl_kunjungan) >=', $start)
                ->where('MONTH(p.tgl_kunjungan) <=', $start + 5);
    }

    $data['pasien'] = $builder->get()->getResultArray();

    if ($type == 'excel') {
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=data_pasien_tbc.xls");
        echo view('gol_b/export/excel', $data);
    } else {
        echo view('gol_b/export/pdf', $data);
    }
}
}