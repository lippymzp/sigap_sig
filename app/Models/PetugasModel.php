<?php

namespace App\Models;

use CodeIgniter\Model;

class PetugasModel extends Model
{
    protected $table            = 'petugas';
    protected $primaryKey       = 'id_petugas';

    protected $allowedFields = [
        'NIP',
        'nama_petugas',
        'id_jabatan',
        'id_instansi',
        'id_penyakit',
        'alamat',
        'no_telp',
        'email',
        'password',
        'created_at'
    ];

    // AMBIL DATA PROFIL + FOTO
    public function getProfil($id_petugas)
    {
        return $this->db->table('petugas')
            ->select('petugas.*, profil.foto_profil, profil.id_foto')
            ->join('profil', 'profil.id_petugas = petugas.id_petugas', 'left')
            ->where('petugas.id_petugas', $id_petugas)
            ->get()
            ->getRowArray();
    }

    // UPDATE / INSERT FOTO
    public function saveFoto($id_petugas, $namaFoto)
    {
        $profil = $this->db->table('profil')
            ->where('id_petugas', $id_petugas)
            ->get()
            ->getRowArray();

        if ($profil) {

            // hapus foto lama
            if (
                $profil['foto_profil'] != '' &&
                file_exists(FCPATH . 'uploads/profil/' . $profil['foto_profil'])
            ) {
                unlink(FCPATH . 'uploads/profil/' . $profil['foto_profil']);
            }

            // update
            $this->db->table('profil')
                ->where('id_petugas', $id_petugas)
                ->update([
                    'foto_profil' => $namaFoto
                ]);

        } else {

            // insert baru
            $this->db->table('profil')->insert([
                'id_petugas'  => $id_petugas,
                'foto_profil' => $namaFoto
            ]);
        }
    }
}