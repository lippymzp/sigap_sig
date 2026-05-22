<?php

namespace App\Controllers;

helper('text');

class DashboardadminDbd extends BaseController
{
public function index()
    {
        $db = \Config\Database::connect();

       
        $id_petugas = session()->get('id_petugas');

        $petugasModel = new \App\Models\PetugasModel();
        $petugas = $petugasModel->find($id_petugas);


        $id_penyakit = 1;

        // 1. Tambahkan penangkap parameter 'wilayah' di sini
        $wilayah = $this->request->getGet('wilayah');
        $bulan   = $this->request->getGet('bulan');
        $tahun   = $this->request->getGet('tahun');
        $usia    = $this->request->getGet('usia');
        $jk      = $this->request->getGet('jk');
        $bulanMap = $this->request->getGet('bulan_map');
        $tahunMap = $this->request->getGet('tahun_map');
    // ==========================================
        // 1. QUERY UTAMA: DATA PETA & DETAIL DESA (TERFILTER)
        // ==========================================
        $builderMape = $db->table('pasien p');
        // FILTER GLOBAL
        $bulanFilter = !empty($bulan)
            ? "AND MONTH(p.tgl_kunjungan) = " . $db->escape($bulan)
            : "";

        $tahunFilter = !empty($tahun)
            ? "AND YEAR(p.tgl_kunjungan) = " . $db->escape($tahun)
            : "";

        // FILTER KHUSUS PETA
        $bulanMapFilter = !empty($bulanMap)
            ? "AND MONTH(p.tgl_kunjungan) = " . $db->escape($bulanMap)
            : "";

        $tahunMapFilter = !empty($tahunMap)
            ? "AND YEAR(p.tgl_kunjungan) = " . $db->escape($tahunMap)
            : "";

       
        $jkFilter = "";
        if (!empty($jk)) {
            $gender   = ($jk == 'L') ? 'Laki-laki' : 'Perempuan';
            $jkFilter = "AND p.jenis_kelamin = " . $db->escape($gender);
        }

       $usiaFilter = "";
        if (!empty($usia)) {
            if ($usia == 'anak') {
                // Bayi dan Anak Pra-sekolah 0–6 Tahun
                $usiaFilter = "AND p.umur BETWEEN 0 AND 6";
            } elseif ($usia == 'remaja') {
                // Sekolah dan Remaja >6–18 Tahun (7 sampai 18 tahun)
                $usiaFilter = "AND p.umur BETWEEN 7 AND 18";
            } elseif ($usia == 'dewasa') {
                // Dewasa >18–59 Tahun (19 sampai 59 tahun)
                $usiaFilter = "AND p.umur BETWEEN 19 AND 59";
            } elseif ($usia == 'lansia') {
                // Lansia >=60 Tahun
                $usiaFilter = "AND p.umur >= 60";
            }
        }

$builderMape->select("
    w.kelurahan as desa,

    COUNT(DISTINCT p.id_pasien) as kasus,
        WHEN p.id_pasien IS NOT NULL
        $bulanMapFilter
        $tahunMapFilter
        $jkFilter
        $usiaFilter
        THEN p.id_pasien
    END) as kasus,

    COUNT(DISTINCT CASE
        WHEN p.jenis_kelamin = 'Laki-laki'
        $bulanMapFilter
        $tahunMapFilter
        $usiaFilter
        THEN p.id_pasien
    END) as laki,

    COUNT(DISTINCT CASE
        WHEN p.jenis_kelamin = 'Perempuan'
        $bulanMapFilter
        $tahunMapFilter
        $usiaFilter
        THEN p.id_pasien
    END) as perempuan,

    COUNT(DISTINCT CASE
        WHEN p.umur BETWEEN 0 AND 6
        $bulanMapFilter
        $tahunMapFilter
        $jkFilter
        THEN p.id_pasien
    END) as anak,

    COUNT(DISTINCT CASE
        WHEN p.umur BETWEEN 7 AND 18
        $bulanMapFilter
        $tahunMapFilter
        $jkFilter
        THEN p.id_pasien
    END) as remaja,

    COUNT(DISTINCT CASE
        WHEN p.umur BETWEEN 19 AND 59
        $bulanMapFilter
        $tahunMapFilter
        $jkFilter
        THEN p.id_pasien
    END) as dewasa,

    COUNT(DISTINCT CASE
        WHEN p.umur >= 60
        $bulanMapFilter
        $tahunMapFilter
        $jkFilter
        THEN p.id_pasien
    END) as lansia,

    COUNT(DISTINCT CASE
        WHEN p.status_akhir = 'Sembuh'
        $bulanMapFilter
        $tahunMapFilter
        $jkFilter
        $usiaFilter
        THEN p.id_pasien
    END) as sembuh,

    COUNT(DISTINCT CASE
        WHEN p.status_akhir = 'Meninggal'
        $bulanMapFilter
        $tahunMapFilter
        $jkFilter
        $usiaFilter
        THEN p.id_pasien
    END) as meninggal,

    COALESCE(dp.total_penduduk, 0) as jumlah_penduduk,
    COALESCE(rp.rumah_diperiksa, 0) as rumah_diperiksa,
    COALESCE(rp.rumah_positif, 0) as rumah_positif
");

// ======================
// DATA PETA
// ======================

$tahunMap = $this->request->getGet('tahun_map');

$builderMape = $db->table('pasien p');

$builderMape->select("
    w.kelurahan as desa,
    COUNT(DISTINCT p.id_pasien) as kasus
");

$builderMape->join(
    'wilayah w',
    'w.id_wilayah = p.id_wilayah',
    'left'
);

$builderMape->where('p.id_penyakit', 1);

$builderMape->whereIn('w.kelurahan', [
    'Sumbersari',
    'Wirolegi',
    'Antirogo',
    'Tegal Gede',
    'Karangrejo'
]);

if (!empty($tahunMap)) {
    $builderMape->where('YEAR(p.tgl_kunjungan)', $tahunMap);
}

$builderMape->groupBy('w.kelurahan');

$dbd = $builderMape->get()->getResultArray();
// ==========================================
        // 2. QUERY GRAFIK (DIUBAH MENJADI 4 KATEGORI USIA)
        // ==========================================
// ======================
// DATA GRAFIK
// ======================

$builderGrafik = $db->table('pasien p');

$builderGrafik->select("
    w.kelurahan,
    COUNT(DISTINCT p.id_pasien) as total
");

$builderGrafik->join(
    'wilayah w',
    'w.id_wilayah = p.id_wilayah',
    'left'
);

$builderGrafik->where('p.id_penyakit', 1);

$builderGrafik->whereIn('w.kelurahan', [
    'Sumbersari',
    'Wirolegi',
    'Antirogo',
    'Tegal Gede',
    'Karangrejo'
]);

if (!empty($bulan)) {
    $builderGrafik->where('MONTH(p.tgl_kunjungan)', $bulan);
}

if (!empty($tahun)) {
    $builderGrafik->where('YEAR(p.tgl_kunjungan)', $tahun);
}

if (!empty($jk)) {
    if ($jk == 'L') {
        $builderGrafik->where('p.jenis_kelamin', 'Laki-laki');
    } elseif ($jk == 'P') {
        $builderGrafik->where('p.jenis_kelamin', 'Perempuan');
    }
}

if (!empty($usia)) {
    if ($usia == 'anak') {
        $builderGrafik->where('p.umur <=', 14);
    } elseif ($usia == 'remaja') {
        $builderGrafik->where('p.umur >=', 15);
        $builderGrafik->where('p.umur <=', 24);
    } elseif ($usia == 'dewasa') {
        $builderGrafik->where('p.umur >=', 25);
        $builderGrafik->where('p.umur <=', 59);
    } elseif ($usia == 'lansia') {
        $builderGrafik->where('p.umur >=', 60);
    }
}

$builderGrafik->groupBy('w.kelurahan');

$grafik = $builderGrafik->get()->getResultArray();

 // ==========================================
        // 3. PEMROSESAN DATA DETAIL DESA
        // ==========================================
        $detailDesa = [];
        $desaTertinggi = '-';

        foreach ($dbd as $row) {
            $namaKel = $row['desa'];
            $jumlahKasus = (int)$row['kasus'];

            if ($jumlahKasus >= 20) {
    $kategori = 'tinggi';
} elseif ($jumlahKasus >= 10) {
    $kategori = 'sedang';
} elseif ($jumlahKasus > 0) {
    $kategori = 'rendah';
} else {
    $kategori = 'Belum ada data';
}

           // Memasukkan 4 kategori baru untuk mencari mana kelompok usia yang paling mendominasi
            // Memasukkan 4 kategori baru untuk mencari mana kelompok usia yang paling mendominasi
$usiaData = [
    'Anak-anak (0-6)'   => (int)($row['anak'] ?? 0),
    'Remaja (7-18)'     => (int)($row['remaja'] ?? 0),
    'Dewasa (19-59)'    => (int)($row['dewasa'] ?? 0),
    'Lansia (>=60)'     => (int)($row['lansia'] ?? 0),
];
arsort($usiaData);
            $usiaTertinggi = array_key_first($usiaData);

            $key = preg_replace('/[^a-z0-9]/', '', strtolower($namaKel));

            // 1. Amankan seluruh data dari $row dengan memberikan nilai default 0 jika key tidak ada
$jumlahPenduduk  = (int)($row['jumlah_penduduk'] ?? 0);
$sembuh          = (int)($row['sembuh'] ?? 0);
$meninggal       = (int)($row['meninggal'] ?? 0);
$anak            = (int)($row['anak'] ?? 0);
$remaja          = (int)($row['remaja'] ?? 0);
$dewasa          = (int)($row['dewasa'] ?? 0);
$lansia          = (int)($row['lansia'] ?? 0);
$laki            = (int)($row['laki'] ?? 0);
$perempuan       = (int)($row['perempuan'] ?? 0);
$rumahDiperiksa  = (int)($row['rumah_diperiksa'] ?? 0);
$rumahPositif    = (int)($row['rumah_positif'] ?? 0);

// 2. Hitung Angka Bebas Jentik (ABJ) secara aman
$abj = ($rumahDiperiksa > 0) 
    ? round((($rumahDiperiksa - $rumahPositif) / $rumahDiperiksa) * 100, 2) 
    : 0;

// 3. Masukkan ke dalam array detailDesa
$detailDesa[$key] = [
    'jumlah_penduduk' => $jumlahPenduduk,
    'jumlah_kasus'    => $jumlahKasus,
    'sembuh'          => $sembuh,
    'meninggal'       => $meninggal,
    'kategori'        => $kategori,
    'anak'            => $anak,
    'remaja'          => $remaja,
    'dewasa'          => $dewasa,
    'lansia'          => $lansia,
    'usia_tertinggi'  => $usiaTertinggi,
    'laki'            => $laki,
    'perempuan'       => $perempuan,
    'rumah_diperiksa' => $rumahDiperiksa,
    'rumah_jentik'    => $rumahPositif, // Menggunakan variabel yang sudah aman
    'abj'             => $abj,
];
        }

        // Tentukan desa tertinggi kasusnya menggunakan array duplikat agar urutan asli $dbd aman
        if (!empty($dbd)) {
            $tempDbd = $dbd;
            usort($tempDbd, function($a, $b) {
                return $b['kasus'] <=> $a['kasus'];
            });
            $desaTertinggi = $tempDbd[0]['desa'];
        }

        // Ambil Data Pendukung Lainnya (Mengembalikan filter id_penyakit asli)
        $berita = $db->table('berita')->where('id_penyakit', $id_penyakit)->whereIn('status_berita', ['publish', 'upload'])->get()->getResultArray();
        $funfact = $db->table('funfact')->where('id_penyakit', $id_penyakit)->orderBy('id_funfact', 'DESC')->get()->getResultArray();
        $penduduk = $db->table('data_penduduk')->where('id_penyakit', $id_penyakit)->get()->getResultArray();

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
            'footer_maskot' => 'logodenggisputih.png'
            
                ]);
            }

public function simpanPenduduk()
{
    $db = \Config\Database::connect();
    
    $kelurahan = $this->request->getPost('kelurahan');
    $laki      = (int)$this->request->getPost('laki');
    $perempuan = (int)$this->request->getPost('perempuan');
    $id_penyakit = 1;

    // 1. Hapus data lama kelurahan ini TAPI HANYA untuk DBD (id_penyakit = 1)
    $db->table('data_penduduk')
       ->where('kelurahan', $kelurahan)
       ->where('id_penyakit', $id_penyakit)
       ->delete();

    // 2. Siapkan data baru dengan menyertakan id_penyakit
    $data_baru = [
        [
            'id_penyakit'    => $id_penyakit,
            'kelurahan'      => $kelurahan,
            'jenis_kelamin'  => 'Laki-laki',
            'total_penduduk' => $laki
        ],
        [
            'id_penyakit'    => $id_penyakit,
            'kelurahan'      => $kelurahan,
            'jenis_kelamin'  => 'Perempuan',
            'total_penduduk' => $perempuan
        ]
    ];

    // 3. Masukkan data (langsung dua baris)
    $db->table('data_penduduk')->insertBatch($data_baru);

    return redirect()->back()->with('success', 'Data ' . $kelurahan . ' berhasil diperbarui');
}

public function hapusPenduduk(int $id)
{
    $db = \Config\Database::connect();

    $db->table('data_penduduk')
       ->where('id_penduduk', $id)
       ->delete();

    return redirect()->back()
        ->with('success','Data berhasil dihapus');
}

public function editPenduduk(int $id)
{
    $db = \Config\Database::connect();

    $data['pendudukEdit'] = $db->table('data_penduduk')
        ->where('id_penduduk', $id)
        ->get()
        ->getRowArray();

    return view('gol_a/edit_penduduk',$data);
}

}