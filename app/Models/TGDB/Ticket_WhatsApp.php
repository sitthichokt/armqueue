<?php
namespace App\Models\TGDB;
use CodeIgniter\Model;

class Ticket_WhatsApp extends Model
{
    protected $DBGroup = 'tgdb';
    protected $table = 'Ticket_WhatsApp';
    protected $primaryKey = 'Ticket_WA_Id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'Ticket_WA_Id'
        ,'Ticket_Id'
        ,'Parent_Id'
        ,'Sub_Comment'
        ,'CustUser_Id'
        ,'Agent_Id'
        ,'Who_Comment'
        ,'Post_Comment_Id'
        ,'Chat_Comment_Id'
        ,'Message_Status'
        ,'WA_Message'
        ,'WA_Picture'
        ,'WA_CreateDate'
        ,'Update_By'
        ,'Delete_By'
        ,'Hidden_By'
        ,'Update_Date'
        ,'Delete_Date'
        ,'Hidden_Date'
        ,'sentiment'
    ];

    // protected $useTimestamps = false;
    // protected $createdField  = 'Agent_CreateBy';
    // protected $updatedField  = 'Agent_UpdateBy';
  
}