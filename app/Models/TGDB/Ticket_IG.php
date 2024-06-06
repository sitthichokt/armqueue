<?php
namespace App\Models\TGDB;
use CodeIgniter\Model;

class Ticket_IG extends Model
{
    protected $DBGroup = 'tgdb';
    protected $table = 'Ticket_IG';
    protected $primaryKey = 'Ticket_IG_Id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
       'Ticket_IG_Id'
       , 'Ticket_Id'
       , 'Parent_Id'
       , 'Sub_Comment'
       , 'CustUser_Id'
       , 'Agent_Id'
       , 'Who_Comment'
       , 'Post_Comment_Id'
       , 'Chat_Comment_Id'
       , 'Message_Status'
       , 'IG_Message'
       , 'IG_Picture'
       , 'IG_CreateDate'
       , 'Update_By'
       , 'Delete_By'
       , 'Hidden_By'
       , 'Update_Date'
       , 'Delete_Date'
       , 'Hidden_Date'
    ];

    // protected $useTimestamps = true;
    // protected $createdField  = 'Line_CreateDate';
    // protected $updatedField  = 'Update_Date';
  
}