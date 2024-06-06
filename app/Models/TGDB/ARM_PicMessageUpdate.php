<?php

namespace App\Models\TGDB;

use CodeIgniter\Model;

class ARM_PicMessageUpdate extends Model
{
    protected $DBGroup = 'tgdb';
    protected $table = 'ARM_PicMessageUpdate';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'id', 'CustSocial_id','Ticket_Id','Ticket_FB_Id','Pic_Status'
    ];

    // protected $useTimestamps = true;
    // protected $createdField  = 'AgentActive_CreateDate';
    // protected $updatedField  = 'AgentActive_UpdateDate';


}