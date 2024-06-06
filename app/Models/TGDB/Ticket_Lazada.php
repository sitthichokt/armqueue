<?php
namespace App\Models\TGDB;
use CodeIgniter\Model;

class Ticket_Lazada extends Model
{
    protected $DBGroup = 'tgdb';
    protected $table = 'Ticket_Lazada';
    protected $primaryKey = 'Ticket_Lazada_Id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'Ticket_Lazada_Id'
        ,'Ticket_Id'
        ,'Parent_Id'
        ,'Sub_Comment'
        ,'CustUser_Id'
        ,'Agent_Id'
        ,'Who_Comment'
        ,'Post_Comment_Id'
        ,'Chat_Comment_Id'
        ,'Message_Status'
        ,'Lazada_Message'
        ,'Lazada_Picture'
        ,'Lazada_CreateDate'
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