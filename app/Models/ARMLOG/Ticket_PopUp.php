<?php
namespace App\Models\ARMLOG;
use CodeIgniter\Model;

class Ticket_PopUp extends Model
{
    protected $DBGroup = 'armlog';
    protected $table   = 'Ticket_PopUp';
    protected $primaryKey = 'PopUp_Id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
      'PopUp_Id'
      , 'Ticket_Id'
      , 'Ticket_Line_Id'
      , 'Ticket_FB_Id'
      , 'Ticket_IG_Id'
      , 'Ticket_Twitter_Id'
      , 'Line_CreateDate'
      , 'IG_CreateDate'
      , 'Twitter_CreateDate'
      , 'Create_Date'
      , 'Ticket_Type'
      , 'PopUp'
      , 'FB_CreateDate'
      , 'Ticket_Email_Id'
      , 'Email_CreateDate'
                            ];

    protected $useTimestamps = true;
    protected $createdField  = 'Create_Date';
    protected $updatedField  = 'Create_Date';
  
}