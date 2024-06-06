<?php
namespace App\Models\TGDB;
use CodeIgniter\Model;

class Ticket_WrapUp_PDPA extends Model
{
    protected $DBGroup = 'tgdb';
    protected $table = 'Ticket_WrapUp_PDPA';
    protected $primaryKey = 'WrapUp_PDPA_Id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'WrapUp_PDPA_Id'
        , 'Ticket_id'
        , 'ASW_WrapUp_Id'
        , 'PersonalAccept'
        , 'ContactAccept'
        , 'News_Accept'
        , 'News_Language'
        , 'News_Type_Array'
        , 'News_Channel_Array'
        , 'PDPA_Remark'
    ];

    // protected $useTimestamps = false;
    // protected $createdField  = 'Agent_CreateBy';
    // protected $updatedField  = 'Agent_UpdateBy';
  
}