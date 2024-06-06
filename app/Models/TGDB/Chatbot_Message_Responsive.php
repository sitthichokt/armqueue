<?php
namespace App\Models\TGDB;
use CodeIgniter\Model;

class Chatbot_Message_Responsive extends Model
{
    protected $DBGroup = 'tgdb';
    protected $table = 'Chatbot_Message_Responsive';
    protected $primaryKey = 'Message_id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'Message_id'
        ,'ARCust_Id'
        ,'CustSocial_Id'
        ,'Message_Name'
        ,'action_type'
        ,'action_text'
        ,'quick_reply'
        ,'action_label'
        ,'action_uri'
        ,'action_data'
        ,'action_mode'
        ,'action_initial'
        ,'action_min'
        ,'action_max'
        ,'Message_CreateBy'
        ,'Message_CreateDate'
        ,'Message_UpdateBy'
        ,'Message_UpdateDate'
    ];

    protected $useTimestamps = false;
    protected $createdField  = 'Message_CreateDate';
    protected $updatedField  = 'Message_UpdateDate';
  
}