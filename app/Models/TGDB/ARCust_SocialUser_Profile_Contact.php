<?php

namespace App\Models\TGDB;

use CodeIgniter\Model;

class ARCust_SocialUser_Profile_Contact extends Model
{
    protected $DBGroup = 'tgdb';
    protected $table = 'ARCust_SocialUser_Profile_Contact';
    protected $primaryKey = 'SocialUserCont_Id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'SocialUserCont_Id', 'SocialUserPro_Id', 'SocialUserCont_Type', 'SocialUserCont_Desc', 'SocialUserCont_Order', 'UpdateByAgent_Id', 'Update_Date'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'Update_Date';
    protected $updatedField  = 'Update_Date';
}
