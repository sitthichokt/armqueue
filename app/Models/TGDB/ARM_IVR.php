<?php

namespace App\Models\TGDB;

use CodeIgniter\Model;

class ARM_IVR extends Model
{
    protected $DBGroup = 'tgdb';
    protected $table = 'ARM_IVR';
    protected $primaryKey = 'IVR_Id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'IVR_Id', 'ARCust_Id', 'CustSocial_Id', 'IVR_CreateDate', 'IVR_Message', 'IVR_Label', 'IVR_Order', 'IVR_Action_Id', 'IVR_Color', 'IVR_Status', 'IVR_create_by', 'IVR_update_dt', 'IVR_update_by', 'IVR_start_date', 'IVR_end_date', 'IVR_EndDate_Message'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'IVR_CreateDate';
    protected $updatedField  = 'IVR_update_dt';
}
