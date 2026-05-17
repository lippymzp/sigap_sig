<?php

namespace App\Models;

use CodeIgniter\Model;

class InputDataPasienModel extends Model
{
    protected $table = 'wilayah';
    protected $primaryKey = 'id_wilayah';

    // FIELD TABEL WILAYAH
    protected $allowedFields = [
        'provinsi',
        'kabupaten',
        'kecamatan',
        'kelurahan',
        'rt',
        'rw',
        'alamat_lengkap',
        'latitude',
        'longitude'
    ];

    // =========================
    // SIMPAN DATA PASIEN + WILAYAH
    // =========================
    public function simpanSemua(array $data)
    {
        $db = \Config\Database::connect();

        // mulai transaksi
        $db->transStart();

        // =========================
        // 1. SIMPAN WILAYAH
        // =========================
        $this->insert([
            'provinsi'       => $data['provinsi'] ?? null,
            'kabupaten'      => $data['kabupaten'] ?? null,
            'kecamatan'      => $data['kecamatan'] ?? null,
            'kelurahan'      => $data['desa'] ?? null,
            'rt'             => $data['rt'] ?? null,
            'rw'             => $data['rw'] ?? null,
            'alamat_lengkap' => $data['alamat'] ?? null,
            'latitude'       => $data['lat'] ?? null,
            'longitude'      => $data['lng'] ?? null,
        ]);

        // ambil id wilayah terakhir
        $id_wilayah = $this->insertID();

        // Fix ENUM untuk Tindak Lanjut agar sesuai dengan Database
        $tindak_lanjut = $data['tindak_lanjut'] ?? null;
        if ($tindak_lanjut === '3M') {
            $tindak_lanjut = 'PSN 3M Plus';
        }

        // =========================
        // 2. SIMPAN PASIEN
        // =========================
        $db->table('pasien')->insert([
            'id_wilayah'    => $id_wilayah,
            'no_rm'         => '', // Default kosong karena db menuntut NOT NULL
            'nik'           => $data['nik'] ?? null,
            'nama_pasien'   => $data['nama'] ?? null,
            'jenis_kelamin' => $data['jenis_kelamin'] ?? null,
            'tgl_lahir'     => $data['tgl_lahir'] ?? null,
            'umur'          => $data['usia'] ?? null,
            'tgl_kunjungan' => $data['tanggal_pemeriksaan'] ?? null,
            'status_akhir'  => $data['status_akhir'] ?? null,
            'tindak_lanjut' => $tindak_lanjut,
            'ctt_klinis'    => $data['catatan'] ?? null,
            'id_petugas'    => $data['id_petugas'] ?? null,
            'id_penyakit'   => $data['id_penyakit'] ?? null
        ]);

        // selesai transaksi
        $db->transComplete();

        return $db->transStatus();
    }

    // =========================
    // JOIN PASIEN + WILAYAH
    // =========================
    public function getDataPasienJoin()
    {
        return $this->db->table('pasien')
            ->select('
                pasien.id_pasien,
                pasien.nama_pasien,
                pasien.jenis_kelamin,
                pasien.umur,
                wilayah.kecamatan,
                wilayah.kelurahan as desa
            ')
            ->join('wilayah', 'wilayah.id_wilayah = pasien.id_wilayah')
            ->orderBy('pasien.id_pasien', 'DESC')
            ->get()
            ->getResultArray();
    }

    // =========================
    // REKAP DASHBOARD
    // =========================
    public function getRekapPasienByTahun(?int $tahun)
    {
        return $this->db->table('pasien p')
            ->select("
                MONTHNAME(p.tgl_kunjungan) as bulan,
                w.kelurahan,

                SUM(CASE WHEN p.umur BETWEEN 0 AND 5 THEN 1 ELSE 0 END) as bayi,
                SUM(CASE WHEN p.umur BETWEEN 6 AND 10 THEN 1 ELSE 0 END) as anak,
                SUM(CASE WHEN p.umur BETWEEN 11 AND 18 THEN 1 ELSE 0 END) as remaja,
                SUM(CASE WHEN p.umur BETWEEN 19 AND 59 THEN 1 ELSE 0 END) as dewasa,
                SUM(CASE WHEN p.umur > 59 THEN 1 ELSE 0 END) as lansia,

                SUM(CASE WHEN p.jenis_kelamin = 'Laki-laki' THEN 1 ELSE 0 END) as laki,
                SUM(CASE WHEN p.jenis_kelamin = 'Perempuan' THEN 1 ELSE 0 END) as perempuan,

                SUM(CASE WHEN p.status_akhir = 'Meninggal' THEN 1 ELSE 0 END) as jumlah_kematian,

                COUNT(*) as jumlah
                
            ")
            ->join('wilayah w', 'w.id_wilayah = p.id_wilayah')
            ->where('YEAR(p.tgl_kunjungan)', $tahun)
            ->groupBy([
                'MONTH(p.tgl_kunjungan)',
                'w.kelurahan'
            ])
            ->orderBy('MONTH(p.tgl_kunjungan)', 'ASC')
            ->get()
            ->getResultArray();
    }

    // =========================
    // EXPORT DATA
    // =========================
    public function getDataExport(?string $mode, ?int $tahun, ?string $waktu, ?string $kelurahan)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('pasien p');

        $builder->select('
            p.nik,
            p.nama_pasien,
            p.tgl_kunjungan,
            p.ctt_klinis,
            p.jenis_kelamin,
            p.umur,
            p.status_akhir,
            p.tindak_lanjut,
            w.kelurahan,
            w.kecamatan,
            w.kabupaten,
            w.provinsi,
            w.rt,
            w.rw,
            w.alamat_lengkap
        ');

        $builder->join('wilayah w', 'w.id_wilayah = p.id_wilayah', 'left');

        if (!empty($tahun)) {
            $builder->where('YEAR(p.tgl_kunjungan)', $tahun);
        }

        if (!empty($waktu)) {
            if ($mode == 'bulanan') {
                $builder->where('MONTH(p.tgl_kunjungan)', $waktu);
            } elseif ($mode == 'triwulan') {
                $start = ($waktu - 1) * 3 + 1;
                $end   = $start + 2;
                $builder->where('MONTH(p.tgl_kunjungan) >=', $start);
                $builder->where('MONTH(p.tgl_kunjungan) <=', $end);
            } elseif ($mode == 'semester') {
                if ($waktu == 1) {
                    $builder->where('MONTH(p.tgl_kunjungan) <=', 6);
                } else {
                    $builder->where('MONTH(p.tgl_kunjungan) >=', 7);
                }
            }
        }

        if (!empty($kelurahan) && strtolower(trim($kelurahan)) != 'semua') {
            $builder->where('LOWER(w.kelurahan)', strtolower(trim($kelurahan)));
        }

        return $builder->get()->getResultArray();
    }
}