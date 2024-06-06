<?php
namespace App\Models\TGDB;
use CodeIgniter\Model;

class ARM_FollowUp_CloseReason extends Model
{
    protected $DBGroup = 'tgdb';
    protected $table = 'ARM_FollowUp_CloseReason';
    protected $primaryKey = 'FClose_Id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'FClose_Id'
        ,'ARCust_Id'
        ,'FClose_Code'
        ,'FClose_Reason'
        ,'Follow_Status'
        ,'FClose_Status'
        ,'FClose_UpdateBy'
        ,'FClose_UpdateDate'
        ,'FClose_OrderBy'      
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'FClose_UpdateDate';
    protected $updatedField  = 'FClose_UpdateDate';

  
}