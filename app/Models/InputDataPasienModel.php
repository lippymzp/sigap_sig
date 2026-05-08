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

        // =========================
        // 2. SIMPAN PASIEN
        // =========================
        $db->table('pasien')->insert([

            'id_wilayah'    => $id_wilayah,

            // sementara otomatis

            'nama_pasien'   => $data['nama'] ?? null,

            'jenis_kelamin' => $data['jenis_kelamin'] ?? null,

            'umur'          => $data['usia'] ?? null,

            'tgl_kunjungan' => $data['tanggal'] ?? null,

            'ctt_klinis'    => $data['catatan'] ?? null,

            // sementara manual
            'id_petugas'    => 1
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

                SUM(CASE WHEN p.umur <= 19 THEN 1 ELSE 0 END) as anak,
                SUM(CASE WHEN p.umur > 19 THEN 1 ELSE 0 END) as dewasa,

                SUM(CASE WHEN p.jenis_kelamin = 'Laki-laki' THEN 1 ELSE 0 END) as laki,
                SUM(CASE WHEN p.jenis_kelamin = 'Perempuan' THEN 1 ELSE 0 END) as perempuan,

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
    public function getDataExport(
        ?string $mode,
        ?int $tahun,
        ?int $waktu,
        ?string $kelurahan
    )
    {
        $db = \Config\Database::connect();

        $builder = $db->table('pasien p');

        $builder->select('
            p.no_rm,
            p.nama_pasien,
            p.tgl_kunjungan,
            p.jenis_kelamin,
            p.umur,
            w.kelurahan,
            w.kecamatan,
            w.alamat_lengkap
        ');

        // join wilayah
        $builder->join(
            'wilayah w',
            'w.id_wilayah = p.id_wilayah',
            'left'
        );

        // =========================
        // FILTER TAHUN
        // =========================
        if (!empty($tahun)) {

            $builder->where(
                'YEAR(p.tgl_kunjungan)',
                $tahun
            );
        }

        // =========================
        // FILTER WAKTU
        // =========================
        if (!empty($waktu)) {

            // BULANAN
            if ($mode == 'bulanan') {

                $builder->where(
                    'MONTH(p.tgl_kunjungan)',
                    $waktu
                );
            }

            // TRIWULAN
            elseif ($mode == 'triwulan') {

                $start = ($waktu - 1) * 3 + 1;
                $end   = $start + 2;

                $builder->where(
                    'MONTH(p.tgl_kunjungan) >=',
                    $start
                );

                $builder->where(
                    'MONTH(p.tgl_kunjungan) <=',
                    $end
                );
            }

            // SEMESTER
            elseif ($mode == 'semester') {

                if ($waktu == 1) {

                    $builder->where(
                        'MONTH(p.tgl_kunjungan) <=',
                        6
                    );

                } else {

                    $builder->where(
                        'MONTH(p.tgl_kunjungan) >=',
                        7
                    );
                }
            }
        }

        // =========================
        // FILTER KELURAHAN
        // =========================
        if (!empty($kelurahan)) {

            $builder->where(
                'LOWER(w.kelurahan)',
                strtolower(trim($kelurahan))
            );
        }

        return $builder->get()->getResultArray();
    }
}