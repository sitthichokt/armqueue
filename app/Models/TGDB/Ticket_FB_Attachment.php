<?php
namespace App\Models\TGDB;
use CodeIgniter\Model;

class Ticket_FB_Attachment extends Model
{
    protected $DBGroup = 'tgdb';
    protected $table = 'Ticket_FB_Attachment';
    protected $primaryKey = 'FB_Att_Id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes = false;

    
    protected $allowedFields = [
        'FB_Att_Id'
        ,'Ticket_Id'
        ,'Ticket_FB_Id'
        ,'FB_Att_Url'
        ,'FB_Att_Part'
        ,'FB_Att_OldName'
        ,'FB_Att_NewName'
        ,'FB_Att_Type'
        ,'FB_Att_extension'
        ,'FB_Att_status'
        ,'FB_Att_CreateDate'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'FB_Att_CreateDate';
    protected $updatedField  = 'FB_Att_CreateDate';
  
}