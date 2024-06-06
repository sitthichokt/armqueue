<?php

namespace App\Models\TGDB;

use CodeIgniter\Model;

class ARM_PDPA_Action extends Model
{
    protected $DBGroup = 'tgdb';
    protected $table = 'ARM_PDPA_Action';
    protected $primaryKey = 'PDPA_Action_Id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'PDPA_Action_Id', 'ARCust_Id', 'PDPA_Action_Message', 'PDPA_Action_Remark', 'PDPA_Action_type', 'CustSocial_Id', 'PDPA_Action_Assign'
    ];

    // protected $useTimestamps = true;
    // protected $createdField  = 'AgentActive_CreateDate';
    // protected $updatedField  = 'AgentActive_UpdateDate';


}
