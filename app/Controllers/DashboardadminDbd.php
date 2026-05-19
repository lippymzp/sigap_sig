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


        $id_penyakit = $petugas['id_penyakit'] ?? null;

        // 1. Tambahkan penangkap parameter 'wilayah' di sini
        $wilayah = $this->request->getGet('wilayah');
        $bulan   = $this->request->getGet('bulan');
        $tahun   = $this->request->getGet('tahun');
        $usia    = $this->request->getGet('usia');
        $jk      = $this->request->getGet('jk');

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
        $builder->where('p.id_penyakit', $id_penyakit);

        // 2. Logika Filter Wilayah
        if (!empty($wilayah)) {
            // Menyesuaikan value 'Tegalgede' dari View agar cocok dengan 'Tegal Gede' di DB
            $namaWilayah = ($wilayah === 'Tegalgede') ? 'Tegal Gede' : $wilayah;
            $builder->where('w.kelurahan', $namaWilayah);
        } else {
            // Tampilkan semua (5 kelurahan) jika filter wilayah tidak dipilih (opsi 'All')
            $builder->whereIn('w.kelurahan', [
                'Sumbersari',
                'Wirolegi',
                'Antirogo',
                'Tegal Gede',
                'Karangrejo'
            ]);
        }

        // Filter lainnya tetap sama...
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

        // ... (Lanjutkan dengan kode DATA PETA dan sisa kode kamu ke bawah) ...

        // =========================
        // DATA PETA
        // =========================
        $builderPeta = $db->table('wilayah w');
        $builderPeta->whereIn('w.kelurahan', [
            'Sumbersari',
            'Wirolegi',
            'Antirogo',
            'Tegal Gede',
            'Karangrejo'
        ]);

        $builderPeta->select("
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

        $builderPeta->join(
            'pasien p',
            'p.id_wilayah = w.id_wilayah',
            'left'
        );
        $builderPeta->where('p.id_penyakit', $id_penyakit);

        // FIX JOIN JENTIK
        $builderPeta->join(
    'rekap_pelaporan_kader rp',
    'LOWER(REPLACE(rp.kelurahan, " ", "")) = LOWER(REPLACE(w.kelurahan, " ", ""))',
    'left'
);

$builderPeta->groupBy('w.kelurahan');

        $dbd = $builderPeta->get()->getResultArray();

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

            $totalPenduduk = $db->table('data_penduduk')
            ->selectSum('total_penduduk')
            ->where("
                LOWER(REPLACE(kelurahan,' ','')) = 
                LOWER(REPLACE(" . $db->escape($namaKel) . ",' ',''))
            ")
            ->get()
            ->getRow()
            ->total_penduduk ?? 0;



            $jumlahSembuh = $db->table('pasien p')
                ->join('wilayah w', 'w.id_wilayah = p.id_wilayah')
                ->where("
                    LOWER(REPLACE(w.kelurahan,' ','')) = 
                    LOWER(REPLACE(" . $db->escape($namaKel) . ",' ',''))
                ")
                ->where('p.id_penyakit', $id_penyakit)
                ->where('p.status_akhir', 'Sembuh')
                ->countAllResults();

            $jumlahMeninggal = $db->table('pasien p')
                ->join('wilayah w', 'w.id_wilayah = p.id_wilayah')
                ->where("
                    LOWER(REPLACE(w.kelurahan,' ','')) = 
                    LOWER(REPLACE(" . $db->escape($namaKel) . ",' ',''))
                ")
                ->where('p.id_penyakit', $id_penyakit)
                ->where('p.status_akhir', 'Meninggal')
                ->countAllResults();

            $detailDesa[$key] = [

                'jumlah_penduduk' => (int)$totalPenduduk,

                'jumlah_kasus' => $jumlahKasus,

                'sembuh' => $jumlahSembuh,
                'meninggal' => $jumlahMeninggal,

                'kategori' => $kategori,

                'anak' => (int)$row['anak'],
                'dewasa' => (int)$row['dewasa'],
                'lansia' => (int)$row['lansia'],

                'usia_tertinggi' => $usiaTertinggi,

                'laki' => (int)$row['laki'],
                'perempuan' => (int)$row['perempuan'],

                'rumah_diperiksa' => (int)$row['rumah_diperiksa'],
                'rumah_jentik' => (int)$row['rumah_positif'],
                'abj' => ((int)$row['rumah_diperiksa'] > 0)
                ? round((((int)$row['rumah_diperiksa']-(int)$row['rumah_positif'])
                        / (int)$row['rumah_diperiksa']) * 100, 2)
                : 0,
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
                ->where('id_penyakit', $id_penyakit)
                ->whereIn('status_berita', ['publish', 'upload'])
                ->get()
                ->getResultArray();

            // ======================
            // FUNFACT
            $funfact = $db->table('funfact')
                ->where('id_penyakit', $id_penyakit)
                ->orderBy('id_funfact', 'DESC')
                ->get()
                ->getResultArray();

            // ======================
            // DATA PENDUDUK
            // ======================
            $penduduk = $db->table('data_penduduk')
            ->where('id_penyakit', 1)
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
            'footer_maskot' => 'logodenggisputih.png'
            
                ]);
            }

public function simpanPenduduk()
{
    $db = \Config\Database::connect();
    
    $kelurahan = $this->request->getPost('kelurahan');
    $laki      = (int)$this->request->getPost('laki');
    $perempuan = (int)$this->request->getPost('perempuan');
    
    $id_penyakit = 1; // Set id_penyakit khusus untuk DBD

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