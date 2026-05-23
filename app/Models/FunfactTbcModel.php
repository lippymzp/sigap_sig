<?php

namespace App\Models;

use CodeIgniter\Model;

class FunfactTbcModel extends Model
{
    protected $table      = 'funfact';
    protected $primaryKey = 'id_funfact';
    protected $returnType = 'array';

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
        'penulis',
    ];

    public function getFunfactTbc($limit = 10)
{
    return $this->where('id_penyakit', 2)
                ->orderBy('tanggal_funfact', 'DESC')
                ->limit($limit)
                ->findAll();
}

    public function getDetailFunfactTbc($id)
    {
        return $this->where('id_funfact', $id)
                    ->where('id_penyakit', 2)
                    ->first();
    }
}