<?php
namespace App\Models;

use CodeIgniter\Model;

class SkriningTBCModel extends Model
{
    protected $table = 'pasien_skrining'; // <--- harus sama dengan nama tabel
    protected $primaryKey = 'id_pasien_skrining';
    protected $allowedFields = [
        'nik','nama_pasien_skrining','jenis_kelamin','tanggal_lahir',
        'usia','no_hp','created_at','id_wilayah'
    ];
}