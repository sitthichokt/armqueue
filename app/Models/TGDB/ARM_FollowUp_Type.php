<?php
namespace App\Models\TGDB;
use CodeIgniter\Model;

class ARM_FollowUp_Type extends Model
{
    protected $DBGroup = 'tgdb';
    protected $table = 'ARM_FollowUp_Type';
    protected $primaryKey = 'FType_Id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'FType_Id'
        ,'ARCust_Id'
        ,'FType_Code'
        ,'FType_Name'
        ,'FType_AlertAgain_Days'
        ,'FType_AlertB4_Days'
        ,'FType_Status'
        ,'FType_UpdateBy'
        ,'FType_UpdateDate'
        ,'FType_OrderBy'      
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'FType_UpdateDate';
    protected $updatedField  = 'FType_UpdateDate';

  
}