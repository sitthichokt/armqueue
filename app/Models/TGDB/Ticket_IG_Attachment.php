<?php
namespace App\Models\TGDB;
use CodeIgniter\Model;

class Ticket_IG_Attachment extends Model
{
    protected $DBGroup = 'tgdb';
    protected $table = 'Ticket_IG_Attachment';
    protected $primaryKey = 'IG_Att_Id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes = false;

    
    protected $allowedFields = [
        'IG_Att_Id'
        ,'Ticket_Id'
        ,'Ticket_IG_Id'
        ,'IG_Att_Url'
        ,'IG_Att_Part'
        ,'IG_Att_OldName'
        ,'IG_Att_NewName'
        ,'IG_Att_Type'
        ,'IG_Att_extension'
        ,'IG_Att_status'
        ,'IG_Att_CreateDate'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'IG_Att_CreateDate';
    protected $updatedField  = 'IG_Att_CreateDate';
  
}