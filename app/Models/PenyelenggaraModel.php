<?php

namespace App\Models;

use CodeIgniter\Model;

class PenyelenggaraModel extends Model
{
    protected $table = 'penyelenggara';
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