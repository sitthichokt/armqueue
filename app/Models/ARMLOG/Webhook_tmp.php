<?php
namespace App\Models\ARMLOG;

use CodeIgniter\Model;
use CodeIgniter\I18n\Time;

class Webhook_tmp extends Model
{
    protected $DBGroup = 'armlog';
    protected $table   = 'Webhook_tmp';
    protected $primaryKey = 'hookId';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'hookId'
        ,'hookSocial'
        ,'hookMessage'
        ,'hookDate'
        ,'hookTicketStatus'
        ,'errorFlag'
        ,'errorDesc'
        ,'Taskstart_date'
        ,'ws_check'
                            ];

    protected $useTimestamps = true;
    protected $createdField  = 'hookDate';
    protected $updatedField  = 'hookDate';
  
}