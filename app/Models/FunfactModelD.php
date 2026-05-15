<?php

namespace App\Models;

use CodeIgniter\Model;

class FunfactModelD extends Model
{
    protected $table = 'funfact';
    protected $primaryKey = 'id_funfact';

    protected $allowedFields = [
        'id_petugas',
        'id_penyakit',
        'judul_funfact',
        'isi_funfact',
        'deskripsi_funfact',
        'gambar_funfact',
        'tanggal_funfact',
        'url',
        'status_funfact',
        'penulis'
    ];
}