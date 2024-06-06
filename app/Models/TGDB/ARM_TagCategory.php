<?php
namespace App\Models\TGDB;
use CodeIgniter\Model;

class ARM_TagCategory extends Model
{
    protected $DBGroup = 'tgdb';
    protected $table = 'ARM_TagCategory';
    protected $primaryKey = 'TagCat_Id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'TagCat_Id'
        ,'ARCust_Id'
        ,'TagCat_Group'
        ,'TagCat_Status'
        ,'TagCat_UpdateBy'
        ,'TagCat_UpdateDate'
        ,'TagGrp_Id'
        ,'TagCat_Name'
        ,'TagCat_OrderBy'
    ];

    protected $useTimestamps = true;
    // protected $createdField  = 'AgentActive_CreateDate';
    // protected $updatedField  = 'AgentActive_UpdateDate';

  
}