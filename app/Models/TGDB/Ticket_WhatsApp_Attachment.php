<?php
namespace App\Models\TGDB;
use CodeIgniter\Model;

class Ticket_WhatsApp_Attachment extends Model
{
    protected $DBGroup = 'tgdb';
    protected $table = 'Ticket_WhatsApp_Attachment';
    protected $primaryKey = 'WA_Att_Id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes = false;


    protected $allowedFields = [
        'WA_Att_Id'
        ,'Ticket_Id'
        ,'Ticket_WA_Id'
        ,'WA_Att_Url'
        ,'WA_Att_Part'
        ,'WA_Att_OldName'
        ,'WA_Att_NewName'
        ,'WA_Att_Type'
        ,'WA_Att_extension'
        ,'WA_Att_status'
        ,'WA_Att_CreateDate'
    ];

    // protected $useTimestamps = false;
    // protected $createdField  = 'Agent_CreateBy';
    // protected $updatedField  = 'Agent_UpdateBy';
  
}