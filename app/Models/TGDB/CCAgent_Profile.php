<?php
namespace App\Models\TGDB;
use CodeIgniter\Model;

class CCAgent_Profile extends Model
{
    protected $DBGroup = 'tgdb';
    protected $table = 'CCAgent_Profile';
    protected $primaryKey = 'Agent_Id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'Agent_Id'
        ,'Agent_Name'
        ,'Agent_Username'
        ,'Agent_Password'
        ,'Agent_Address'
        ,'Agent_Province'
        ,'Agent_District'
        ,'Agent_SubDistrict'
        ,'Agent_Telephone'
        ,'Agent_Mobile'
        ,'Agent_Email'
        ,'Agent_StartDate'
        ,'Agent_EndDate'
        ,'Agent_Remark'
        ,'Agent_Status'
        ,'Agent_CreateBy'
        ,'Agent_CreateDate'
        ,'Agent_UpdateBy'
        ,'Agent_UpdateDate'
        ,'ARCust_Id'
        ,'AGroup_Id'
        ,'Agent_Picture'
        ,'Agent_Notification'
        ,'Agent_BlockMobile'
        ,'Agent_Lockscreen'
        ,'Agent_Password_Log'
    ];

    protected $useTimestamps = false;
    protected $createdField  = 'Agent_CreateBy';
    protected $updatedField  = 'Agent_UpdateBy';
  
}