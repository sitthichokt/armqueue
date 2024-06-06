<?php

namespace App\Models\TGDB;

use CodeIgniter\Model;

class TMP_Phone_Access_Token extends Model
{
    protected $DBGroup = 'tgdb';
    protected $table = 'TMP_Phone_Access_Token';
    protected $primaryKey = 'PhoneAccessToke_Id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
       'PhoneAccessToke_Id'
       ,'PhoneAccessToke_Ip'
       ,'PhoneAccessToke_Platform'
       ,'PhoneAccessToke_status'
       ,'PhoneAccessToke_Message'
       ,'CustSocial_Id'
       ,'CustSocial_Username'
       ,'PhoneAccessToke_Token'
       ,'PhoneAccessToke_IatDate'
       ,'PhoneAccessToke_ExpDate'
       ,'PhoneAccessToke_CreateDate'
       ,'PhoneAccessToke_UpdateDate'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'PhoneAccessToke_CreateDate';
    protected $updatedField  = 'PhoneAccessToke_UpdateDate';


}
