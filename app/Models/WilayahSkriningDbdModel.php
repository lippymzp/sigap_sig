<?php

namespace App\Models;

use CodeIgniter\Model;

class WilayahSkriningDbdModel extends Model
{
    protected $table = 'wilayah';
    protected $primaryKey = 'id_wilayah';

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
}