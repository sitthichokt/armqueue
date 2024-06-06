<?php
namespace App\Models\TGDB;
use CodeIgniter\Model;

class Ticket_TAG extends Model
{
    protected $DBGroup = 'tgdb';
    protected $table = 'Ticket_TAG';
    protected $primaryKey = 'Ticket_Tag_Id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes = false;

  

    protected $allowedFields = [
        'Ticket_Tag_Id'
        ,'Ticket_Id'
        ,'Tag_Id'
        ,'Tag_CreateDate'
        ,'CreateBy_Agent_Id'
    ];

    // protected $useTimestamps = false;
    // protected $createdField  = 'Agent_CreateBy';
    // protected $updatedField  = 'Agent_UpdateBy';
  
}