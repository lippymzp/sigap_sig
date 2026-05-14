<?php

namespace App\Models;

use CodeIgniter\Model;

class VideoDbdModel extends Model
{
    protected $table = 'video';
    protected $primaryKey = 'id_video';

    protected $allowedFields = [
        'judul_video',
        'id_petugas',
        'id_penyakit',
        'deskripsi_video',
        'file_video',
        'tanggal_video',
        'status_video'
    ];
}