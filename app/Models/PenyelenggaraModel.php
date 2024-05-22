<?php
namespace App\Models;
use CodeIgniter\Model;

class PenyelenggaraModel extends Model
{
    protected $table = 'Penyelenggara';
    protected $allowedFields = [
        'email',
        'username',
        'password',
        'namaLembaga',
        'alamatLembaga',
        'noTelp',
        'status',
        'profilePict',
    ];
}