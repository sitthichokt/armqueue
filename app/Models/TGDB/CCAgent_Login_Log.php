<?php
namespace App\Models\TGDB;
use CodeIgniter\Model;

class CCAgent_Login_Log extends Model
{
    protected $DBGroup = 'tgdb';
    protected $table = 'CCAgent_Login_Log';
    protected $primaryKey = 'AgentLog_Id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'AgentLog_Id'
        ,'Agent_Id'
        ,'Agent_Remark'
        ,'LoginDate'
        ,'Agent_Status'
        ,'LogOutDate'
        ,'Ip'
        ,'Device'
        ,'Even'
        ,'NumCon'
        ,'PhpUpdate'
        ,'WssUpdate'
        ,'LoginUpdate'  
        ,'WssDisConnectDate'    
        ,'Session_Expiration'    
        ,'Agent_Status_last'
        ,'Agent_Loock'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'LoginDate';
    protected $updatedField  = 'LoginUpdate';

  
}