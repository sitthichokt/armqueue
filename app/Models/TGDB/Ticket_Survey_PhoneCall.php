<?php
namespace App\Models\TGDB;
use CodeIgniter\Model;

class Ticket_Survey_PhoneCall extends Model
{
    protected $DBGroup = 'tgdb';
    protected $table = 'Ticket_Survey_PhoneCall';
    protected $primaryKey = 'Ticket_Survey_PhoneCall_Id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
     'Ticket_Survey_PhoneCall_Id'
     ,'Ticket_Id'
     ,'EndCall_Id'
     ,'EndCall_Note'
     ,'Create_Date'
     ,'CreateBy_Agent_Id'
    ];
}