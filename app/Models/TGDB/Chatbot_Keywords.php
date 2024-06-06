<?php
namespace App\Models\TGDB;
use CodeIgniter\Model;

class Chatbot_Keywords extends Model
{
    protected $DBGroup = 'tgdb';
    protected $table = 'Chatbot_Keywords';
    protected $primaryKey = 'Keyword_id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'Keyword_id'
        ,'ARCust_Id'
        ,'CustSocial_Id'
        ,'Keyword_text'
        ,'Keyword_match'
        ,'Keyword_CreateBy'
        ,'Keyword_CreateDate'
        ,'Keyword_UpdateBy'
        ,'Keyword_UpdateDate'
    ];

    protected $useTimestamps = false;
    protected $createdField  = 'Keyword_CreateDate';
    protected $updatedField  = 'Keyword_UpdateDate';
  
}