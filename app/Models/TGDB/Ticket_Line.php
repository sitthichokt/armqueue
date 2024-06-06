<?php
namespace App\Models\TGDB;
use CodeIgniter\Model;

class Ticket_Line extends Model
{
    protected $DBGroup = 'tgdb';
    protected $table = 'Ticket_Line';
    protected $primaryKey = 'Ticket_Line_Id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'Ticket_Line_Id'
        , 'Ticket_Id'
        , 'Parent_Id'
        , 'Sub_Comment'
        , 'CustUser_Id'
        , 'Agent_Id'
        , 'Who_Comment'
        , 'Post_Comment_Id'
        , 'Chat_Comment_Id'
        , 'Message_Status'
        , 'Line_Message'
        , 'Line_Picture'
        , 'Line_CreateDate'
        , 'Line_Sticker_Id'
        , 'Line_Package_Id'
        , 'Update_By'
        , 'Delete_By'
        , 'Hidden_By'
        , 'Update_Date'
        , 'Delete_Date'
        , 'Hidden_Date'
        , 'Line_Reply_Token'
        , 'Line_Reply_Date'
        , 'sentiment'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'Line_CreateDate';
    protected $updatedField  = 'Update_Date';
  
}