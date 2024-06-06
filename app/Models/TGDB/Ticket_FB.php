<?php
namespace App\Models\TGDB;
use CodeIgniter\Model;

class Ticket_FB extends Model
{
    protected $DBGroup = 'tgdb';
    protected $table = 'Ticket_FB';
    protected $primaryKey = 'Ticket_FB_Id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'Ticket_FB_Id'
        ,'Ticket_Id'
        ,'Parent_Id'
        ,'Sub_Comment'
        ,'CustUser_Id'
        ,'Agent_Id'
        ,'Who_Comment'
        ,'Post_Comment_Id'
        ,'Chat_Comment_Id'
        ,'Message_Status'
        ,'FB_Message'
        ,'FB_Picture'
        ,'FB_CreateDate'
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