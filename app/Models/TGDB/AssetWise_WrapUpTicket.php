<?php
namespace App\Models\TGDB;
use CodeIgniter\Model;

class AssetWise_WrapUpTicket extends Model
{
    protected $DBGroup = 'tgdb';
    protected $table = 'AssetWise_WrapUpTicket';
    protected $primaryKey = 'ASW_WrapUp_Id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
     'ASW_WrapUp_Id', 'Ticket_id', 'AssetWise_ProductType', 'ASWProj_Id', 'ASWCaseType_L1_Id', 'ASWCaseType_L2_Id', 'ASWCaseType_L3_Id', 'AssetWise_ContactChannel', 'AGroup_Id', 'WrapUp_Note', 'WrapUp_Status', 'WrapUp_CreateDate', 'WrapUp_UpdateDate', 'WrapUp_CreateByAgent_Id', 'WrapUp_UpdateByAgent_Id', 'Appointment_Date', 'Appointment_TimeFR', 'Appointment_TimeTo', 'Grade', 'FollowUp', 'FType_Id', 'Follow_Note'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'WrapUp_CreateDate';
    protected $updatedField  = 'WrapUp_UpdateDate';

  
}