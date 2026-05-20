<?php

namespace App\Models;

use CodeIgniter\Model;

class ProfilSistemModel extends Model
{
    protected $table            = 'profil_sistem';
    protected $primaryKey       = 'id_profil_sistem';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['profil', 'deskripsi_profil', 'logo', 'tagline', 'maskot', 'isi_misi', 'isi_visi']; 
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
}