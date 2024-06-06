<?php
namespace App\Models\TGDB;
use CodeIgniter\Model;

class Ticket_EMAIL extends Model
{
    protected $DBGroup = 'tgdb';
    protected $table = 'Ticket_EMAIL';
    protected $primaryKey = 'Ticket_EMAIL_Id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'Ticket_EMAIL_Id'
        ,'Ticket_Id'
        ,'Parent_Id'
        ,'Sub_Comment'
        ,'CustUser_Id'
        ,'Agent_Id'
        ,'Who_Comment'
        ,'Post_Comment_Id'
        ,'Chat_Comment_Id'
        ,'Message_Status'
        ,'EMAIL_Message'
        ,'EMAIL_Picture'
        ,'EMAIL_CreateDate'
        ,'Update_By'
        ,'Delete_By'
        ,'Hidden_By'
        ,'Update_Date'
        ,'Delete_Date'
        ,'Hidden_Date'
        ,'EMAIL_Subject'
        ,'Ticket_Email_CC'
        ,'Ticket_Email_To'
        ,'UIDL'
    ];

    // protected $useTimestamps = false;
    // protected $createdField  = 'Agent_CreateBy';
    // protected $updatedField  = 'Agent_UpdateBy';
  
}