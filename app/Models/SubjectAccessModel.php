<?php

namespace App\Models;

use CodeIgniter\Model;

class SubjectAccessModel extends Model
{
    protected $table      = 'subject_accesses';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';
}