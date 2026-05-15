<?php

namespace App\Models;

use CodeIgniter\Model;

class PetugasModelD extends Model
{
    protected $table = 'petugas';
    protected $primaryKey = 'id_petugas';

    protected $allowedFields = [
        'NIP',
        'nama_petugas',
        'id_jabatan',
        'id_instansi',
        'id_penyakit',
        'alamat',
        'no_telp',
        'email',
        'password'
    ];
}