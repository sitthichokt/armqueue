<?php
namespace App\Models\TGDB;
use CodeIgniter\Model;

class ARTableLookup extends Model
{
    protected $DBGroup = 'tgdb';
    protected $table = 'ARTableLookup';
    protected $primaryKey = 'LookupID';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'LookupID'
        ,'LookupGroup'
        ,'LookupText'
        ,'LookupValue'
        ,'LookupOrder'
        ,'LookupStatus'
    ];

    protected $useTimestamps = true;
    // protected $createdField  = 'AgentActive_CreateDate';
    // protected $updatedField  = 'AgentActive_UpdateDate';

  
}