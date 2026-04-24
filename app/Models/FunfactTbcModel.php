<?php

namespace App\Models;

use CodeIgniter\Model;

class FunfactTbcModel extends Model
{
    protected $table = 'artikel';
    protected $primaryKey = 'id_artikel';

    protected $allowedFields = [
        'judul_artikel',
        'status_artikel',
        'gambar_artikel',
        'deskripsi_artikel',
        'tanggal_artikel'
    ];

    protected $useTimestamps = false;
}