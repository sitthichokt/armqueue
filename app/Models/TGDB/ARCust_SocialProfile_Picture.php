<?php

namespace App\Models\TGDB;

use CodeIgniter\Model;

class ARCust_SocialProfile_Picture extends Model
{
    protected $DBGroup = 'tgdb';
    protected $table = 'ARCust_SocialProfile_Picture';
    protected $primaryKey = 'Picture_Id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes = false;


    protected $allowedFields = [
        'Picture_Id'
        ,'Picture_CustType'
        ,'CustUser_Id'
        ,'CustSocial_Id'
        ,'Picture_OldName'
        ,'Picture_NewName'
        ,'Picture_Part'
        ,'Picture_Type'
        ,'Picture_Status'
        ,'Picture_CreateDate'
        ,'Picture_UpdateDate'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'Picture_CreateDate';
    protected $updatedField  = 'Picture_UpdateDate';
}
