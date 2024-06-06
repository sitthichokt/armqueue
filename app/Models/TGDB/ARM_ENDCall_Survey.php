<?php
namespace App\Models\TGDB;
use CodeIgniter\Model;

class ARM_ENDCall_Survey extends Model
{
    protected $DBGroup = 'tgdb';
    protected $table = 'ARM_ENDCall_Survey';
    protected $primaryKey = 'ENDCall_Id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
         'ENDCall_Id'
        ,'ARCust_Id'
        ,'ENDCall_Desc'
        ,'ENDCall_ACtive'
        ,'ENDCall_Order'
    ];
}