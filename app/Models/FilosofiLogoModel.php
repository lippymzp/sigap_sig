<?php

namespace App\Models;

use CodeIgniter\Model;

class FilosofiLogoModel extends Model
{
    protected $table            = 'filosofi_logo';
    protected $primaryKey       = 'id_filosofi_logo';
    protected $useAutoIncrement = true; // 🛠️ FIX: Pastikan ini bernilai true
    protected $returnType       = 'array';
    
    // Field yang diizinkan untuk manipulasi data lewat insert/update
    protected $allowedFields    = ['id_profil_sistem', 'nama_logo', 'deskripsi_logo', 'komponen_logo']; 
    
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
}