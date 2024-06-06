<?php
namespace App\Models\TGDB;
use CodeIgniter\Model;

class ARM_AdminMenu extends Model
{
    protected $DBGroup = 'tgdb';
    protected $table = 'ARM_AdminMenu';
    protected $primaryKey = 'AdminMenu_Id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['AdminMenu_Id'
    ,'ARCust_Id'
    ,'AdminMenu_Group'
    ,'AdminMenu_Name'
    ,'AdminMenu_URL'
    ,'AdminMenu_OrderBy'
    ,'AdminMenu_Status'
    ,'AdminRole'];

    // protected $useTimestamps = false;
    // protected $createdField  = 'Agent_CreateBy';
    // protected $updatedField  = 'Agent_UpdateBy';
  
}