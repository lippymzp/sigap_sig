<?php

namespace App\Models;

use CodeIgniter\Model;

class DataPasienModel extends Model
{
    protected $table = 'pasien';

    protected $primaryKey = 'id_pasien';

    protected $allowedFields = [
        'id_wilayah',
        'no_rm',
        'nama_pasien',
        'jenis_kelamin',
        'umur',
        'tgl_kunjungan',
        'ctt_klinis',
        'id_petugas'
    ];

    public function getPasienWithLokasi()
    {
        return $this->db->table('pasien')
            ->join('wilayah', 'wilayah.id_wilayah = pasien.id_wilayah')
            ->select('
                pasien.nama_pasien,
                wilayah.kelurahan,
                wilayah.latitude,
                wilayah.longitude
            ')
            ->get()
            ->getResultArray();
    }
}