<?php

namespace App\Models\TGDB;

use CodeIgniter\Model;

class ARM_Media_SubCat extends Model
{
    protected $DBGroup = 'tgdb';
    protected $table = 'ARM_Media_SubCat';
    protected $primaryKey = 'MediaSubCat_Id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'MediaSubCat_Id'
        ,'MediaCat_Id'
        ,'MediaSubCat_Desc'
        ,'MediaSubCat_Active'
        ,'MediaSubCat_CreateDate'
        ,'MediaSubCat_CreateBy'
        ,'MediaSubCat_UpdateDate'
        ,'MediaSubCat_UpdateBy'
        ,'MediaSubCat_Order'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'MediaSubCat_CreateDate';
    protected $updatedField  = 'MediaSubCat_UpdateDate';
}
