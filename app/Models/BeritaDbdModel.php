<?php

namespace App\Models;

use CodeIgniter\Model;

class BeritaDbdModel extends Model
{
    protected $table = 'berita';
    protected $primaryKey = 'id_berita';

    protected $allowedFields = [
        'id_berita',
        'id_petugas',
        'judul_berita',
        'deskripsi_berita',
        'gambar_berita',
        'tanggal_berita',
        'url_berita',
        'status_berita'
    ];
}