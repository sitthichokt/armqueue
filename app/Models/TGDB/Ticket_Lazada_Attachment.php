<?php
namespace App\Models\TGDB;
use CodeIgniter\Model;

class Ticket_Lazada_Attachment extends Model
{
    protected $DBGroup = 'tgdb';
    protected $table = 'Ticket_Lazada_Attachment';
    protected $primaryKey = 'Lazada_Att_Id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes = false;

    
    protected $allowedFields = [
        'Lazada_Att_Id'
        ,'Ticket_Id'
        ,'Ticket_Lazada_Id'
        ,'Lazada_Att_Url'
        ,'Lazada_Att_Part'
        ,'Lazada_Att_OldName'
        ,'Lazada_Att_NewName'
        ,'Lazada_Att_Type'
        ,'Lazada_Att_extension'
        ,'Lazada_Att_status'
        ,'Lazada_Att_CreateDate'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'Lazada_Att_CreateDate';
    protected $updatedField  = 'Lazada_Att_CreateDate';
  
}