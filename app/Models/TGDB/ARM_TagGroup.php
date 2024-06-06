<?php
namespace App\Models\TGDB;
use CodeIgniter\Model;

class ARM_TagGroup extends Model
{
    protected $DBGroup = 'tgdb';
    protected $table = 'ARM_TagGroup';
    protected $primaryKey = 'TagGrp_Id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'TagGrp_Id'
        ,'ARCust_Id'
        ,'TagGrp_Name'
        ,'TagGrp_OrderBy'
        ,'TagGrp_Status'
        ,'TagGrp_UpdateBy'
        ,'TagGrp_UpdateDate'
    ];

    protected $useTimestamps = true;
    // protected $createdField  = 'AgentActive_CreateDate';
    // protected $updatedField  = 'AgentActive_UpdateDate';

  
}