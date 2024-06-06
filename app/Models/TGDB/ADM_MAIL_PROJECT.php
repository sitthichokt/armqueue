<?php
namespace App\Models\TGDB;
use CodeIgniter\Model;

class ADM_MAIL_PROJECT extends Model
{
    protected $DBGroup = 'tgdb';
    protected $table = 'ADM_MAIL_PROJECT';
    protected $primaryKey = 'MAIL_PRO_ID';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'MAIL_PRO_ID'
        ,'ARCust_Id'
        ,'TYPE_LVL1_ID'
        ,'TYPE_LVL2_ID'
        ,'TYPE_LVL3_ID'
        ,'PROJ_ID'
        ,'M_Send_To'
        ,'M_CC'
        ,'M_BCC'
        ,'Status'
        ,'Create_Date'
        ,'Update_Date'
        ,'Create_By'
        ,'Update_By'];

    protected $useTimestamps = false;
    protected $createdField  = 'Create_Date';
    protected $updatedField  = 'Update_Date';
  
}