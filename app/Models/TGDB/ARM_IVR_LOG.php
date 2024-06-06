<?php

namespace App\Models\TGDB;

use CodeIgniter\Model;

class ARM_IVR_LOG extends Model
{
    protected $DBGroup = 'tgdb';
    protected $table = 'ARM_IVR_LOG';
    protected $primaryKey = 'IVR_LOG_Id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'IVR_LOG_Id', 'Ticket_Id', 'IVR_LOG_Date', 'IVR_Id'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'IVR_LOG_Date';
    protected $updatedField  = 'IVR_LOG_Date';
}
