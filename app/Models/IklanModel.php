<?php

namespace App\Models;

use CodeIgniter\Model;

class IklanModel extends Model
{
    protected $table = 'manajemen_iklan';
    protected $primaryKey = 'id_iklan';

    protected $allowedFields = [
        'judul',
        'deskripsi',
        'gambar',
        'status',
        'urutan'
    ];
}