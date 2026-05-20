<?php

namespace App\Models;

use CodeIgniter\Model;

class PasienModel extends Model
{
    protected $table = 'pasien';

    protected $primaryKey = 'id_pasien';

    protected $allowedFields = [

    'nik',
    'no_rm',
    'nama_pasien',
    'jenis_kelamin',
    'umur',
    'tgl_kunjungan',
    'status_akhir',
    'ctt_klinis',
    'id_petugas',
    'id_wilayah'

    ];
}