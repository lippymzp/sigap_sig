<?php

namespace App\Controllers;

helper('text');

class DashboardadminDbd extends BaseController
{
    public function index()
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

        $builder->select('
            w.kelurahan as desa,
            COUNT(*) as kasus
        ');

        $builder->join(
            'wilayah w',
            'w.id_wilayah = p.id_wilayah',
            'left'
        );

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
            }

            elseif ($jk == 'P') {
                $builder->where('p.jenis_kelamin', 'Perempuan');
            }
        }

        if (!empty($usia)) {

            if ($usia == 'anak') {
                $builder->where('p.umur <=', 14);
            }

            elseif ($usia == 'remaja') {
                $builder->where('p.umur >=', 15);
                $builder->where('p.umur <=', 24);
            }

            elseif ($usia == 'dewasa') {
                $builder->where('p.umur >=', 25);
                $builder->where('p.umur <=', 59);
            }

            elseif ($usia == 'lansia') {
                $builder->where('p.umur >=', 60);
            }
        }

        $builder->groupBy('w.kelurahan');

        $grafik = $builder->get()->getResultArray();

        // =========================
        // DATA PETA
        // =========================
        $builder = $db->table('wilayah w');

        $builder->select("
            w.kelurahan as desa,

            COUNT(DISTINCT p.id_pasien) as kasus,

            SUM(CASE 
                WHEN p.jenis_kelamin = 'Laki-laki'
                THEN 1 ELSE 0
            END) as laki,

            SUM(CASE 
                WHEN p.jenis_kelamin = 'Perempuan'
                THEN 1 ELSE 0
            END) as perempuan,

            SUM(CASE 
                WHEN p.umur <= 14
                THEN 1 ELSE 0
            END) as anak,

            SUM(CASE 
                WHEN p.umur BETWEEN 15 AND 59
                THEN 1 ELSE 0
            END) as dewasa,

            SUM(CASE 
                WHEN p.umur >= 60
                THEN 1 ELSE 0
            END) as lansia,

            COALESCE(SUM(rp.diperiksa),0) as rumah_diperiksa,
            COALESCE(SUM(rp.positif),0) as rumah_positif
        ");

        $builder->join(
            'pasien p',
            'p.id_wilayah = w.id_wilayah',
            'left'
        );

        // FIX JOIN JENTIK
        $builder->join(
    'rekap_pelaporan_kader rp',
    'LOWER(REPLACE(rp.kelurahan, " ", "")) = LOWER(REPLACE(w.kelurahan, " ", ""))',
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

            if ($jumlahKasus >= 20) {
                $kategori = 'tinggi';
            }

            elseif ($jumlahKasus >= 10) {
                $kategori = 'sedang';
            }

            else {
                $kategori = 'rendah';
            }

            $usiaData = [
                'Anak-anak' => (int)$row['anak'],
                'Dewasa'    => (int)$row['dewasa'],
                'Lansia'    => (int)$row['lansia'],
            ];

            arsort($usiaData);

            $usiaTertinggi = array_key_first($usiaData);

            $key = preg_replace(
                '/[^a-z0-9]/',
                '',
                strtolower($namaKel)
            );

            $detailDesa[$key] = [

                'jumlah_penduduk' => 0,

                'jumlah_kasus' => $jumlahKasus,

                'kategori' => $kategori,

                'anak' => (int)$row['anak'],
                'dewasa' => (int)$row['dewasa'],
                'lansia' => (int)$row['lansia'],

                'usia_tertinggi' => $usiaTertinggi,

                'laki' => (int)$row['laki'],
                'perempuan' => (int)$row['perempuan'],

                'rumah_diperiksa' => (int)$row['rumah_diperiksa'],
                'rumah_jentik' => (int)$row['rumah_positif'],
            ];
        }

        // =========================
        // DESA TERTINGGI
        // =========================
        if (!empty($dbd)) {

            usort($dbd, function($a, $b) {
                return $b['kasus'] <=> $a['kasus'];
            });

            $desaTertinggi = $dbd[0]['desa'];
        }
    // BERITA
    // ======================
    $berita = $db->table('berita')
        ->whereIn('status_berita', ['publish', 'upload'])
        ->get()
        ->getResultArray();

    // ======================
    // FUNFACT
    $funfact = $db->table('funfact')
        ->orderBy('id_funfact', 'DESC')
        ->get()
        ->getResultArray();

    // ======================
    // DATA PENDUDUK
    // ======================
    $penduduk = $db->table('data_penduduk')
        ->get()
        ->getResultArray();
        // =========================
        // RETURN VIEW
        // =========================
      return view('gol_a/dashboard_dbd', [
    'menu' => 'dashboard',
    'grafik' => $grafik,
    'dbd' => $dbd,
    'detailDesa' => $detailDesa,
    'desaTertinggi' => $desaTertinggi,
    'berita' => $berita,
    'funfact' => $funfact,
    'penduduk' => $penduduk,
    'show_footer_maskot' => true,
    'footer_maskot' => 'logo_denggis.png'
    

        ]);
    }

   public function simpanPenduduk()
{
    $db = \Config\Database::connect();
    
    $kelurahan = $this->request->getPost('kelurahan');
    $laki      = (int)$this->request->getPost('laki');
    $perempuan = (int)$this->request->getPost('perempuan');

    // 1. Hapus semua data lama kelurahan ini (biar tidak double)
    $db->table('data_penduduk')->where('kelurahan', $kelurahan)->delete();

    // 2. Siapkan data baru untuk dimasukkan kembali
    $data_baru = [
        [
            'kelurahan'      => $kelurahan,
            'jenis_kelamin'  => 'Laki-laki',
            'total_penduduk' => $laki
        ],
        [
            'kelurahan'      => $kelurahan,
            'jenis_kelamin'  => 'Perempuan',
            'total_penduduk' => $perempuan
        ]
    ];

    // 3. Masukkan data (langsung dua baris)
    $db->table('data_penduduk')->insertBatch($data_baru);

    return redirect()->back()->with('success', 'Data ' . $kelurahan . ' berhasil diperbarui');
}
public function hapusPenduduk($id)
{
    $db = \Config\Database::connect();

    $db->table('data_penduduk')
       ->where('id_penduduk', $id)
       ->delete();

    return redirect()->back()
        ->with('success','Data berhasil dihapus');
}

public function editPenduduk($id)
{
    $db = \Config\Database::connect();

    $data['pendudukEdit'] = $db->table('data_penduduk')
        ->where('id_penduduk', $id)
        ->get()
        ->getRowArray();

    return view('gol_a/edit_penduduk',$data);
}

}