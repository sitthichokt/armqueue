<?php

namespace App\Models\TGDB;

use CodeIgniter\Model;

class ARM_Media_Cat extends Model
{
    protected $DBGroup = 'tgdb';
    protected $table = 'ARM_Media_Cat';
    protected $primaryKey = 'MediaCat_Id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
       'MediaCat_Id'
       ,'MediaCat_Desc'
       ,'MediaCat_Active'
       ,'ARCust_Id'
       ,'MediaCat_Order'
    ];

    // protected $useTimestamps = true;
    // protected $createdField  = 'IVR_CreateDate';
    // protected $updatedField  = 'IVR_update_dt';
}
