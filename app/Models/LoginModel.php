<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model
{
    protected $table = 'login';
    protected $primaryKey = 'id_user';

    protected $allowedFields = [
        'email',
        'password',
        'id_role',
        'penyakit'
    ];
}