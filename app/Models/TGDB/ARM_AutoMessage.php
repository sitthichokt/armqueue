<?php
namespace App\Models\TGDB;
use CodeIgniter\Model;

class ARM_AutoMessage extends Model
{
    protected $DBGroup = 'tgdb';
    protected $table = 'ARM_AutoMessage';
    protected $primaryKey = 'AutoMsg_Id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'AutoMsg_Id'
        ,'ARCust_Id'
        ,'AutoMsg_Name'
        ,'AutoMsg_Message'
        ,'AutoMsg_PictureFile'
        ,'AutoMsg_Status'
        ,'AutoMsg_UpdateBy'
        ,'AutoMsg_UpdateDate'
        ,'AGroup_Id'
        ,'AutoMsg_OrderBy'  
    ];

    // protected $useTimestamps = true;
    // protected $createdField  = 'AgentActive_CreateDate';
    // protected $updatedField  = 'AgentActive_UpdateDate';

  
}