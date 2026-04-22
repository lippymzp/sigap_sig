<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model
{
    protected $table = 'user_akun';
    protected $primaryKey = 'id_user';

    protected $allowedFields = [
        'email',
        'password',
        'role_id',
        'id_penyakit'
    ];
}