<?php

namespace App\Models;
use CodeIgniter\Model;

class BeritaTbcModel extends Model
{
    protected $table = 'beritatbc';
    protected $primaryKey = 'id_berita';
    protected $allowedFields = [
        'judul_berita',
        'gambar_berita',
        'deskripsi_berita',
        'tanggal_berita',
        'status_berita'
    ];
}