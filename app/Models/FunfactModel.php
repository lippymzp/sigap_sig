<?php

namespace App\Models;

use CodeIgniter\Model;

class FunfactModel extends Model
{
    protected $table            = 'funfact';

    protected $primaryKey       = 'id_funfact';

    protected $returnType       = 'array';

    protected $useAutoIncrement = true;

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