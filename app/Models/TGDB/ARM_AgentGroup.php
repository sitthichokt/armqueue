<?php
namespace App\Models\TGDB;
use CodeIgniter\Model;

class ARM_AgentGroup extends Model
{
    protected $DBGroup = 'tgdb';
    protected $table = 'ARM_AgentGroup';
    protected $primaryKey = 'AGroup_Id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'AGroup_Id'
        ,'ARCust_Id'
        ,'AGroup_Name'
        ,'Agent_Role'
        ,'AGroup_Remark'
        ,'AGroup_UpdateBy'
        ,'AGroup_UpdateDate'
        ,'AGroup_Status'
        ,'AdminRole'
        ,'SendMail'       
    ];

    protected $useTimestamps = true;
    // protected $createdField  = 'AgentActive_CreateDate';
    // protected $updatedField  = 'AgentActive_UpdateDate';

  
}