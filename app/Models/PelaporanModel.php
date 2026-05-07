<?php

namespace App\Models;

use CodeIgniter\Model;

class PelaporanModel extends Model
{
    protected $table = 'rekap_pelaporan_kader';
    protected $primaryKey = 'id_laporan';
    protected $useAutoIncrement = true;

    protected $allowedFields = [
        'bulan',
        'minggu',
        'periode_lengkap',
        'id_puskesmas',
        'id_kelurahan',
        'id_posyandu',
        'diperiksa',
        'positif',
        'bagian',
        'foto',
        'abj'
    ];

    protected $useTimestamps = true;
}