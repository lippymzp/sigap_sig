<?php
namespace App\Models;

use CodeIgniter\Model;

class SuperAdmin extends Model
{
    protected $table = 'manajemen_puskesmas'; // sesuai tabel di DB
    protected $primaryKey = 'id_manajemen_puskesmas';
    protected $allowedFields = [
        'id_puskesmas',
        'nama_puskesmas',
        'kode_pos',
        'id_kecamatan',
        'id_kelurahan',
        'posyandu',
        'alamat',
        'no_telpon_puskesmas',
        'created_at',
        'update_at'
    ];

    // Optional: search function
    public function search($keyword)
    {
        return $this->like('nama_puskesmas', $keyword)
                    ->orLike('alamat', $keyword)
                    ->orLike('no_telpon_puskesmas', $keyword);
    }
}