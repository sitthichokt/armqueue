<?php
namespace App\Models\TGDB;
use CodeIgniter\Model;

class Phone_log extends Model
{
    protected $DBGroup = 'tgdb';
    protected $table = 'Phone_log';
    protected $primaryKey = 'Phone_log_Id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes = false;
    
    protected $allowedFields = [
        'Phone_log_Id'
        , 'Phone_log_Agent_Id'
        , 'Phone_log_CustSocial_Id'
        , 'Phone_log_PhoneNO'
        , 'Phone_log_CreateDate'
        , 'Phone_log_UpdatedDate'
        , 'Phone_log_Assto_Agent_Id'
        , 'Phone_log_Assto_Agent_Status'
        , 'Phone_log_Popup_Sent'
        , 'Phone_log_Popup_Show'
        , 'Phone_log_Popup_Name'
        , 'Phone_log_accept'
        , 'Phone_log_Transfer_To_Agent_Id'
        , 'Phone_log_Transfer_DateTime'
        , 'Phone_log_Queue'
        , 'Phone_log_Queue_Alert'
        , 'Phone_log_Queue_List'
        , 'Phone_log_Queue_Show'
        , 'Phone_log_Ticket'
        , 'Phone_log_CustUser'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'Phone_log_CreateDate';
    protected $updatedField  = 'Phone_log_UpdatedDate';
  
}