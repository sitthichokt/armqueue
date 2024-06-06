<?php
namespace App\Models\TGDB;
use CodeIgniter\Model;

class ARM_Tag extends Model
{
    protected $DBGroup = 'tgdb';
    protected $table = 'ARM_Tag';
    protected $primaryKey = 'Tag_Id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'Tag_Id'
        ,'TagCat_Id'
        ,'ARCust_Id'
        ,'Tag_Name'
        ,'Tag_Status'
        ,'Tag_UpdateBy'
        ,'Tag_UpdateDate'
        ,'Tag_OrderBy'
    ];

    protected $useTimestamps = true;
    // protected $createdField  = 'AgentActive_CreateDate';
    // protected $updatedField  = 'AgentActive_UpdateDate';

  
}