<?php

namespace App\Models;

use CodeIgniter\Model;

class PasienSkriningModel extends Model
{
    protected $table = 'pasien_skrining';
    protected $primaryKey = 'id_pasien_skrining';

    protected $allowedFields = [
        'nik',
        'nama_pasien_skrining',
        'jenis_kelamin',
        'tanggal_lahir',
        'usia',
        'no_hp',
        'id_wilayah'
    ];
}