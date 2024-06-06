<?php
namespace App\Models\TGDB;
use CodeIgniter\Model;

class Webhook_tmp extends Model
{
    protected $DBGroup = 'tgdb';
    protected $table = 'Webhook_tmp';
    protected $primaryKey = 'hookId';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'hookId'
        , 'hookSocial'
        , 'hookMessage'
        , 'hookDate'
    ];

    protected $useTimestamps = false;
    protected $createdField  = 'hookDate';
    protected $updatedField  = 'hookDate';
  
}