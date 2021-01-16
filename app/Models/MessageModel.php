<?php

namespace App\Models;

use CodeIgniter\Model;

class MessageModel extends Model
{
    protected $table      = 'messages';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'text',
        'user_id',
        'subject_id',
        'status',
    ];

    protected $returnType     = 'array';
    protected $useTimestamps = false;
    protected $skipValidation = false;
}