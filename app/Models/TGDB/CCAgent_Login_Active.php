<?php
namespace App\Models\TGDB;
use CodeIgniter\Model;

class CCAgent_Login_Active extends Model
{
    protected $DBGroup = 'tgdb';
    protected $table = 'CCAgent_Login_Active';
    protected $primaryKey = 'AgentActive_Id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'AgentActive_Id'
        ,'AgentActive_IpAddress'
        ,'AgentActive_CookeiId'
        ,'AgentActive_User'
        ,'AgentActive_Status'
        ,'AgentActive_ExpDate'
        ,'AgentActive_CreateDate'
        ,'AgentActive_UpdateDate'

    ];

    protected $useTimestamps = true;
    protected $createdField  = 'AgentActive_CreateDate';
    protected $updatedField  = 'AgentActive_UpdateDate';

  
}