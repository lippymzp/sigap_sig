<?php

namespace App\Models;

use CodeIgniter\Model;

class profil_sistem extends Model
{
    protected $table = 'profil_sistem';
    protected $primaryKey = 'id_profil_sistem';

    protected $allowedFields = [
        'nama_sistem',
        'alamat',
        'email',
        'instagram',
        'logo'
    ];
}