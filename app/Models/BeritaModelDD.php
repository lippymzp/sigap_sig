<?php

namespace App\Models;

use CodeIgniter\Model;

class BeritaModelDD extends Model
{
    protected $table = 'berita';
    protected $primaryKey = 'id_berita';

    protected $allowedFields = [
        'id_petugas',
        'id_penyakit',
        'judul_berita',
        'deskripsi_berita',
        'isi_berita',
        'gambar_berita',
        'tanggal_berita',
        'url_berita',
        'status_berita',
        'penulis'
    ];
}