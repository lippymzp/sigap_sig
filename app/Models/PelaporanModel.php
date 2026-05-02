<?php

namespace App\Models;

use CodeIgniter\Model;

class PelaporanModel extends Model
{
    // Pastikan nama tabelnya sudah benar
    protected $table            = 'rekap_pelaporan_kader';
    
    protected $primaryKey       = 'id_laporan'; 
    protected $useAutoIncrement = true;
    
    // 🔥 BAGIAN INI YANG HARUS DIPERBARUI 🔥
    protected $allowedFields    = [
        'bulan', 
        'minggu', 
        'periode_lengkap', 
        'id_puskesmas',   // Sebelumnya 'puskesmas'
        'id_kelurahan',   // Sebelumnya 'kelurahan'
        'id_posyandu',    // Sebelumnya 'posyandu'
        'diperiksa', 
        'positif', 
        'bagian', 
        'foto', 
        'abj'
    ];
    
    protected $useTimestamps    = true;
}