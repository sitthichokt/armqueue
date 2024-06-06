<?php
namespace App\Models\TGDB;
use CodeIgniter\Model;

class Ticket_Shopee extends Model
{
    protected $DBGroup = 'tgdb';
    protected $table = 'Ticket_Shopee';
    protected $primaryKey = 'Ticket_Shopee_Id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'Ticket_Shopee_Id'
        ,'Ticket_Id'
        ,'Parent_Id'
        ,'Sub_Comment'
        ,'CustUser_Id'
        ,'Agent_Id'
        ,'Who_Comment'
        ,'Post_Comment_Id'
        ,'Chat_Comment_Id'
        ,'Message_Status'
        ,'Shopee_Message'
        ,'Shopee_Picture'
        ,'Shopee_CreateDate'
        ,'Update_By'
        ,'Delete_By'
        ,'Hidden_By'
        ,'Update_Date'
        ,'Delete_Date'
        ,'Hidden_Date'
        ,'sentiment'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'Shopee_CreateDate';
    protected $updatedField  = 'Update_Date';
}