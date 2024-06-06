<?php

namespace App\Models\TGDB;

use CodeIgniter\Model;

class ARM_PDPA extends Model
{
    protected $DBGroup = 'tgdb';
    protected $table = 'ARM_PDPA';
    protected $primaryKey = 'PDPA_Id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'PDPA_Id', 'ARCust_Id', 'CustSocial_Id', 'PDPA_CreateDate', 'PDPA_Message', 'PDPA_Label', 'PDPA_Order', 'PDPA_Action_Id', 'PDPA_Color', 'PDPA_Status'
    ];

    // protected $useTimestamps = true;
    // protected $createdField  = 'AgentActive_CreateDate';
    // protected $updatedField  = 'AgentActive_UpdateDate';


}
