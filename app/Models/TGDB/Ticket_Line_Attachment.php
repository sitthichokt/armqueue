<?php
namespace App\Models\TGDB;
use CodeIgniter\Model;

class Ticket_Line_Attachment extends Model
{
    protected $DBGroup = 'tgdb';
    protected $table = 'Ticket_Line_Attachment';
    protected $primaryKey = 'Line_Att_Id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'Line_Att_Id'
        ,'Ticket_Id'
        ,'Ticket_Line_Id'
        ,'Line_Att_Url'
        ,'Line_Att_Part'
        ,'Line_Att_OldName'
        ,'Line_Att_NewName'
        ,'Line_Att_Type'
        ,'Line_Att_extension'
        ,'Line_Att_status'
        ,'Line_Att_CreateDate'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'Line_Att_CreateDate';
    protected $updatedField  = 'Line_Att_CreateDate';
  
}