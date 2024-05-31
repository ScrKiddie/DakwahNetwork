<?php
namespace App\Models;

use CodeIgniter\Model;

class DakwahModel extends Model
{
    protected $table = 'dakwah';
    protected $allowedFields = [
        'judul',
        'tema',
        'waktuMulai',
        'durasi',
        'status',
        'pendakwah',
        'deskripsi',
        'lokasi',
        'posterPict',
        'id_penyelenggara',
    ];
    public function getDakwahWithPenyelenggara(): array
    {
        return $this->join("penyelenggara", 'penyelenggara.id = dakwah.id_penyelenggara')
            ->select('dakwah.*, penyelenggara.namaLembaga as nama_penyelenggara')
            ->where("dakwah.status","active")
            ->findAll();
    }

}
