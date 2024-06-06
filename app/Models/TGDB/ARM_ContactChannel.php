<?php
namespace App\Models\TGDB;
use CodeIgniter\Model;

class ARM_ContactChannel extends Model
{
    protected $DBGroup = 'tgdb';
    protected $table = 'ARM_ContactChannel';
    protected $primaryKey = 'Channel_Id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'Channel_Id'
        ,'ARCust_Id'
        ,'Channel_Name'
        ,'Announce_Status'
        ,'Announce_CreateBy'
        ,'Announce_CreateDate'
        ,'Announce_UpdateBy'
        ,'Announce_UpdateDate'
    ];
}