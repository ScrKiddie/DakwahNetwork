<?php
namespace App\Models;

use CodeIgniter\Model;

class DakwahModel extends Model
{
    protected $table = 'Dakwah';
//    public function getDakwahWithPenyelenggara(): array
//    {
//        return $this->join($this->table, 'Penyelenggara.id = Dakwah.penyelenggara_id')
//            ->select('Dakwah.*, Penyelenggara.namaLembaga as nama_penyelenggara')
//            ->findAll();
//    }

}
