<?php

namespace App\Models\TGDB;

use CodeIgniter\Model;

class ARM_IVR_Action extends Model
{
    protected $DBGroup = 'tgdb';
    protected $table = 'ARM_IVR_Action';
    protected $primaryKey = 'IVR_Action_Id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'IVR_Action_Id', 'ARCust_Id', 'IVR_Action_Message', 'IVR_Action_Remark', 'IVR_Action_type', 'CustSocial_Id', 'IVR_Action_Assign'
    ];

    // protected $useTimestamps = true;
    // protected $createdField  = 'IVR_CreateDate';
    // protected $updatedField  = 'IVR_update_dt';


}
