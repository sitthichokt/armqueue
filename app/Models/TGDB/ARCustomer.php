<?php
namespace App\Models\TGDB;
use CodeIgniter\Model;

class ARCustomer extends Model
{
    protected $DBGroup = 'tgdb';
    protected $table = 'ARCustomer';
    protected $primaryKey = 'ARCust_Id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
                                'ARCust_Id'
                                ,'ARPack_Id'
                                ,'ARCust_Name'
                                ,'ARCust_Address'
                                ,'ARCust_Province'
                                ,'ARCust_District'
                                ,'ARCust_SubDistrict'
                                ,'ARCust_Telephone'
                                ,'ARCust_Mobile'
                                ,'ARCust_Email'
                                ,'Req_Id'
                                ,'ARCust_Channel'
                                ,'ARCust_StartDate'
                                ,'ARCust_EndDate'
                                ,'ARCust_Remark'
                                ,'ARCust_Status'
                                ,'Admin_CreateBy'
                                ,'Admin_CreateDate'
                                ,'Admin_UpdateBy'
                                ,'Admin_UpdateDate'
                                ,'tempcusco'
                                ,'SurveyExpireDay'
                                ,'MaxConcurrent'
                                ,'AutoAssignTask'
                                ,'AssignTaskRule'
                                ,'CheckLogout_Exists'
                                ,'Show_Wrapup'
                                ,'PostMessage_SplitTicket'
                                ,'LockScreen_Picture'
                                ,'Business_Type'
                                ,'EMail_Signature'
                                ,'Emai_heading'
                                ,'Emai_footer'
                            ];

    // protected $useTimestamps = false;
    // protected $createdField  = 'Agent_CreateBy';
    // protected $updatedField  = 'Agent_UpdateBy';
  
}