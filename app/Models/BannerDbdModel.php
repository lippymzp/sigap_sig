<?php

namespace App\Models;
use CodeIgniter\Model;

class BannerDbdModel extends Model
{
    protected $table            = 'manajemen_banner';
    protected $primaryKey       = 'id_manajemen_banner';
    protected $returnType       = 'array';
    protected $useAutoIncrement = true;
    protected $allowedFields = [
        'judul_banner',
        'id_petugas',
        'id_penyakit',
        'gambar',
        'urutan',
        'deskripsi',
        'status_banner'
    ];

    // timestamps
    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /*
    |--------------------------------------------------------------------------
    | GET PUBLISH
    |--------------------------------------------------------------------------
    */
    public function getPublish()
    {
        return $this->where(
            'status_banner',
            'publish'
        )->findAll();
    }

    /*
    |--------------------------------------------------------------------------
    | GET DRAFT
    |--------------------------------------------------------------------------
    */
    public function getDraft()
    {
        return $this->where(
            'status_banner',
            'draft'
        )->findAll();
    }

    /*
    |--------------------------------------------------------------------------
    | COUNT PUBLISH
    |--------------------------------------------------------------------------
    */
    public function countPublish()
    {
        return $this->where(
            'status_banner',
            'publish'
        )->countAllResults();
    }

    /*
    |--------------------------------------------------------------------------
    | COUNT DRAFT
    |--------------------------------------------------------------------------
    */
    public function countDraft()
    {
        return $this->where(
            'status_banner',
            'draft'
        )->countAllResults();
    }

}