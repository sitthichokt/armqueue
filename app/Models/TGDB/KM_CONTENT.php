<?php
namespace App\Models\TGDB;
use CodeIgniter\Model;

class KM_CONTENT extends Model
{
    protected $DBGroup = 'tgdb';
    protected $table = 'KM_CONTENT';
    protected $primaryKey = 'KM_CONTENT_ID';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'KM_CONTENT_ID'
        ,'ARCust_Id'
        ,'KM_HDR_ID'
        ,'KM_TITLE'
        ,'KM_CONTENT'
        ,'KM_FILENAME'
        ,'KM_PATH'
        ,'KM_CONTENT_STAT'
        ,'CREATE_DT'
        ,'CREATE_BY'
        ,'UPDATE_DT'
        ,'UPDATE_BY'
    ];

    protected $useTimestamps = false;
    protected $createdField  = 'CREATE_DT';
    protected $updatedField  = 'UPDATE_DT';
 
}