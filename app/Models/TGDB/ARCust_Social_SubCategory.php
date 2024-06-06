<?php
namespace App\Models\TGDB;
use CodeIgniter\Model;

class ARCust_Social_SubCategory extends Model
{
    protected $DBGroup = 'tgdb';
    protected $table = 'ARCust_Social_SubCategory';
    protected $primaryKey = 'Social_SubCat_Id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'Social_SubCat_Id'
        , 'Social_Cat_Id'
        , 'ARCust_Id'
        , 'Social_SubCat_Name'
        , 'Social_SubCat_ShortName'
        , 'Social_SubCat_Order'
        , 'Social_SubCat_Status'
                            ];

    // protected $useTimestamps = false;
    // protected $createdField  = 'Agent_CreateBy';
    // protected $updatedField  = 'Agent_UpdateBy';
  
}