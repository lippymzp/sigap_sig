<?php

namespace App\Models;

use CodeIgniter\Model;

class FunfactPneumoniaModel extends Model
{
    protected $table      = 'funfact';
    protected $primaryKey = 'id_funfact';

    protected $allowedFields = [
        'id_petugas',
        'id_penyakit',
        'judul_funfact',
        'penulis',
        'deskripsi_funfact',
        'gambar_funfact',
        'tanggal_funfact',
        'url',
        'status_funfact'
    ];

    protected $useTimestamps = false;
}