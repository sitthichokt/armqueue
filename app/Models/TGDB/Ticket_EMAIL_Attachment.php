<?php
namespace App\Models\TGDB;
use CodeIgniter\Model;

class Ticket_EMAIL_Attachment extends Model
{
    protected $DBGroup = 'tgdb';
    protected $table = 'Ticket_EMAIL_Attachment';
    protected $primaryKey = 'EMAIL_Att_Id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'EMAIL_Att_Id'
        ,'Ticket_EMAIL_Id'
        ,'EMAIL_Att_Name'
        ,'EMAIL_Att_CreateDate'
        ,'EMAIL_Att_Part'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'EMAIL_Att_CreateDate';
    protected $updatedField  = 'EMAIL_Att_CreateDate';
  
}