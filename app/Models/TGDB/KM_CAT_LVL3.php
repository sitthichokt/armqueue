<?php
namespace App\Models\TGDB;
use CodeIgniter\Model;

class KM_CAT_LVL3 extends Model
{
    protected $DBGroup = 'tgdb';
    protected $table = 'KM_CAT_LVL3';
    protected $primaryKey = 'KM_CAT_LVL3_ID';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'KM_CAT_LVL3_ID'
        ,'KM_CAT_LVL2_ID'
        ,'KM_CAT_LVL3_DESC'
        ,'KM_LVL3_ORDER'
        ,'KM_LVL3_STAT'
        ,'ARCust_Id'
        ,'CREATE_DT'
        ,'CREATE_BY'
        ,'UPDATE_DT'
        ,'UPDATE_BY'
        ,'KM_CAT_LVL1_ID'
        ,'KM_Stat'
    ];

    protected $useTimestamps = false;
    protected $createdField  = 'CREATE_DT';
    protected $updatedField  = 'UPDATE_DT';
 
}