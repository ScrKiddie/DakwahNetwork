<?php



namespace App\Models;
use CodeIgniter\Model;

class MessagesModel extends Model
{
    protected $table = 'messages';
    protected $allowedFields = [
        'name',
        'email',
        'subject',
        'message',
        'id',
    ];
}