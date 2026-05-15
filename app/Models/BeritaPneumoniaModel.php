<?php

namespace App\Models;

use CodeIgniter\Model;

class BeritaPneumoniaModel extends Model
{
    protected $table = 'berita';
    protected $primaryKey = 'id_berita';

    protected $returnType = 'array';

    protected $allowedFields = [
        'judul_berita',
        'deskripsi_berita',
        'isi_berita',
        'gambar_berita',
        'tanggal_berita',
        'url_berita',
        'status_berita',
        'penulis',
        'id_petugas',
        'id_penyakit'
    ];
}