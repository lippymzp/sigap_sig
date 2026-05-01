<?php

namespace App\Models;

use CodeIgniter\Model;

class PasienPneumoniaModel extends Model
{
    protected $table = 'pasien_skrining';
    protected $primaryKey = 'id_pasien_skrining';

    protected $allowedFields = [
        'nama_pasien_skrining',
        'jenis_kelamin',
        'tanggal_lahir',
        'usia',
        'alamat',
        'created_at',
        'id_wilayah'
    ];
}