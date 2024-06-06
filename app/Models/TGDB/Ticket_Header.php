<?php
namespace App\Models\TGDB;
use CodeIgniter\Model;

class Ticket_Header extends Model
{
    protected $DBGroup = 'tgdb';
    protected $table = 'Ticket_Header';
    protected $primaryKey = 'Ticket_Id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
         'Ticket_Id'
        ,'CustSocial_Id'
        ,'CustUser_Id'
        ,'Chat_Id'
        ,'Post_Id'
        ,'Page_Create'
        ,'Ticket_NO'
        ,'Ticket_Status'
        ,'Ticket_Note'
        ,'Ticket_Remark'
        ,'Ticket_CreateDate'
        ,'Ticket_UpdateDate'
        ,'Ticket_UpdateByAgent_Id'
        ,'Ticket_CloseDate'
        ,'Ticket_CloseByAgent_Id'
        ,'Ticket_Ad'
        ,'Ticket_CreateByAgent_Id'
        ,'Ticket_AssignToAgent'
        ,'Ticket_Survey'
        ,'Ticket_Survey_Reason'
        ,'Ticket_AssetToGrpoup'
        ,'Ticket_Page_CreateDate'
        ,'Ticket_Mention'
        ,'Ticket_Email_CC'
        ,'Ticket_Email_To'
        ,'ENDCall_Id'
    ];

    // protected $useTimestamps = false;
    // protected $createdField  = 'Agent_CreateBy';
    // protected $updatedField  = 'Agent_UpdateBy';
  
}