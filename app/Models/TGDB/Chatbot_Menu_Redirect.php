<?php
namespace App\Models\TGDB;
use CodeIgniter\Model;

class Chatbot_Menu_Redirect extends Model
{
    protected $DBGroup = 'tgdb';
    protected $table = 'Chatbot_Menu_Redirect';
    protected $primaryKey = 'BotRedirect_Id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'BotRedirect_Id'
        ,'CustSocial_Id'
        ,'Action_Code'
        ,'Action_URL'
        ,'Action_Name'
        ,'Action_Remark'
    ];

    // protected $useTimestamps = false;
    // protected $createdField  = 'Keyword_CreateDate';
    // protected $updatedField  = 'Keyword_UpdateDate';
  
}