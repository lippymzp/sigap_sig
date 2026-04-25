<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model
{
    protected $table = 'petugas';
    protected $primaryKey = 'id_petugas';

    protected $allowedFields = [
        'email',
        'password',
        'id_jabatan',
        'id_penyakit'
    ];
}