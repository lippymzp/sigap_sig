<?php

namespace App\Models;

use CodeIgniter\Model;

class PasienModel extends Model
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
}