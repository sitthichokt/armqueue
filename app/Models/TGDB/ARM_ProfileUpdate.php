<?php

namespace App\Models\TGDB;

use CodeIgniter\Model;

class ARM_ProfileUpdate extends Model
{
    protected $DBGroup = 'tgdb';
    protected $table = 'ARM_ProfileUpdate';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'id', 'CustUser_id', 'CustSocial_id','Pro_Status'
    ];

    // protected $useTimestamps = true;
    // protected $createdField  = 'AgentActive_CreateDate';
    // protected $updatedField  = 'AgentActive_UpdateDate';


}