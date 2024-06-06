<?php
namespace App\Models\TGDB;
use CodeIgniter\Model;

class CCAgent_Login_Block extends Model
{
    protected $DBGroup = 'tgdb';
    protected $table = 'CCAgent_Login_Block';
    protected $primaryKey = 'Block_Id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
         'Block_Id'
        ,'Block_IPAddress'
        ,'Block_Status'
        ,'Block_Number_attempts'
        ,'Block_ResetDate'
        ,'Block_Number_reset'
        ,'Block_CreateDate'
        ,'Block_UpdateDate'
 
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'Block_CreateDate';
    protected $updatedField  = 'Block_UpdateDate';

  
}