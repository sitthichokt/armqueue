<?php
namespace App\Models\TGDB;
use CodeIgniter\Model;

class Ticket_Twitter extends Model
{
    protected $DBGroup = 'tgdb';
    protected $table = 'Ticket_Twitter';
    protected $primaryKey = 'Ticket_Twitter_Id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'Ticket_Twitter_Id'
        ,'Ticket_Id'
        ,'Parent_Id'
        ,'Sub_Comment'
        ,'CustUser_Id'
        ,'Agent_Id'
        ,'Who_Comment'
        ,'Post_Comment_Id'
        ,'Chat_Comment_Id'
        ,'Message_Status'
        ,'Twitter_Message'
        ,'Twitter_Picture'
        ,'Twitter_CreateDate'
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