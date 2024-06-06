<?php
namespace App\Models\TGDB;
use CodeIgniter\Model;

class KM_HEADER extends Model
{
    protected $DBGroup = 'tgdb';
    protected $table = 'KM_HEADER';
    protected $primaryKey = 'KM_HDR_ID';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'KM_HDR_ID'
        ,'ARCust_Id'
        ,'KM_HDR_TITLE'
        ,'KM_CAT_LVL1_ID'
        ,'KM_CAT_LVL2_ID'
        ,'KM_CAT_LVL3_ID'
        ,'KM_START_DT'
        ,'KM_END_DT'
        ,'KM_KEYWORD'
        ,'KM_DESC'
        ,'KM_STAT'
        ,'KM_PRIORITY'
        ,'CREATE_DT'
        ,'CREATE_BY'
        ,'UPDATE_DT'
        ,'UPDATE_BY'
    ];

    protected $useTimestamps = false;
    protected $createdField  = 'CREATE_DT';
    protected $updatedField  = 'UPDATE_DT';
 
}