<?php

namespace App\Models;

use CodeIgniter\Model;

class PasienModel extends Model
{
    protected $table = 'pasien';

    protected $primaryKey = 'id_pasien';

    protected $allowedFields = [
        'nama_pasien',
        'jenis_kelamin',
        'umur',
        'tgl_kunjungan',
        'id_petugas',
        'id_wilayah'
    ];
}