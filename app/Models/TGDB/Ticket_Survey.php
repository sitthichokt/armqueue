<?php
namespace App\Models\TGDB;
use CodeIgniter\Model;

class Ticket_Survey extends Model
{
    protected $DBGroup = 'tgdb';
    protected $table = 'Ticket_Survey';
    protected $primaryKey = 'Ticket_Survey_Id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
     'Ticket_Survey_Id'
     , 'Ticket_Id'
     , 'Survey_Url'
     , 'Send_Date'
     , 'Answer_Score'
     , 'Answer_Date'
     , 'Survey_Status'
     , 'Reject_Reson'
     , 'CreateBy_Agent_Id'
     , 'Survey_Suggest'
    ];

    // protected $useTimestamps = false;
    // protected $createdField  = 'Agent_CreateBy';
    // protected $updatedField  = 'Agent_UpdateBy';
  
}