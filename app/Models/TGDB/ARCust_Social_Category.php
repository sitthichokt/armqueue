<?php
namespace App\Models\TGDB;
use CodeIgniter\Model;

class ARCust_Social_Category extends Model
{
    protected $DBGroup = 'tgdb';
    protected $table = 'ARCust_Social_Category';
    protected $primaryKey = 'Social_Cat_Id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'Social_Cat_Id'
        , 'ARCust_Id'
        , 'Social_Cat_Name'
        , 'Social_Cat_ShortName'
        , 'Social_Cat_Order'
        , 'Social_Cat_Status'
                            ];

    // protected $useTimestamps = false;
    // protected $createdField  = 'Agent_CreateBy';
    // protected $updatedField  = 'Agent_UpdateBy';
  
}