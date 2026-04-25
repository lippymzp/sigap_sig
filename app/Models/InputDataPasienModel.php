<?php

namespace App\Models;

use CodeIgniter\Model;

class InputDataPasienModel extends Model
{
    protected $table = 'wilayah';
    protected $primaryKey = 'id_wilayah';

    protected $allowedFields = [
        'provinsi','kabupaten','kecamatan','kelurahan',
        'rt','rw','alamat_lengkap','latitude','longitude'
    ];

    // 🔥 SIMPAN SEKALIGUS
    public function simpanSemua($data)
    {
        $db = \Config\Database::connect();

        // 🔥 pakai transaksi biar aman
        $db->transStart();

        // 1. simpan wilayah
        $this->insert([
            'provinsi'        => $data['provinsi'] ?? null,
            'kabupaten'       => $data['kabupaten'] ?? null,
            'kecamatan'       => $data['kecamatan'] ?? null,
            'kelurahan'       => $data['desa'] ?? null,
            'rt'              => $data['rt'] ?? null,
            'rw'              => $data['rw'] ?? null,
            'alamat_lengkap'  => $data['alamat'] ?? null,
            'latitude'        => $data['lat'] ?? null,
            'longitude'       => $data['lng'] ?? null,
        ]);

        $id_wilayah = $this->insertID();

        // 2. simpan pasien (pakai query builder manual)
        $db->table('pasien')->insert([
            'id_wilayah'    => $id_wilayah,
            'no_rm'         => $data['no_rm'] ?? null,
            'nama_pasien'   => $data['nama'] ?? null,
            'jenis_kelamin' => ($data['jk'] ?? '') == 'Perempuan' ? 1 : 2,
            'umur'          => $data['usia'] ?? null,
            'tgl_kunjungan' => $data['tanggal'] ?? null,
            'ctt_klinis'    => $data['catatan'] ?? null,
            'id_petugas'    => 1
        ]);

        $db->transComplete();

        return $db->transStatus();
    }
}