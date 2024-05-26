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
//    public function getDakwahWithPenyelenggara(): array
//    {
//        return $this->join($this->table, 'Penyelenggara.id = Dakwah.penyelenggara_id')
//            ->select('Dakwah.*, Penyelenggara.namaLembaga as nama_penyelenggara')
//            ->findAll();
//    }

}
