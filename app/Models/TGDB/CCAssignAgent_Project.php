<?php
namespace App\Models\TGDB;
use CodeIgniter\Model;

class CCAssignAgent_Project extends Model
{
    protected $DBGroup = 'tgdb';
    protected $table = 'CCAssignAgent_Project';
    protected $primaryKey = 'AssignAgent_Id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'AssignAgent_Id'
        ,'Agent_Id'
        ,'CustSocial_Id'
        ,'Assign_CreateBy'
        ,'Assign_CreateDate'
        ,'Assign_UpdateBy'
        ,'Assign_UpdateDate'
        ,'Display_Order'
        ,'GetChat'
        ,'GetPost'
    ];

    // protected $useTimestamps = false;
    // protected $createdField  = 'Agent_CreateBy';
    // protected $updatedField  = 'Agent_UpdateBy';
  
}