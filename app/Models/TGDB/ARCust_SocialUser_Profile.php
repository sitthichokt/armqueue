<?php
namespace App\Models\TGDB;
use CodeIgniter\Model;

class ARCust_SocialUser_Profile extends Model
{
    protected $DBGroup = 'tgdb';
    protected $table = 'ARCust_SocialUser_Profile';
    protected $primaryKey = 'SocialUserPro_Id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'SocialUserPro_Id'
        ,'ARCust_Id'
        ,'CustSocial_Group'
        ,'SocialUser_Id'
        ,'SocialUser_Name'
        ,'User_NickNames'
        ,'Social_SubCat_Id'
        ,'Social_Cat_Id'
        ,'Social_Desc1'
        ,'Social_Desc2'
        ,'User_Picture'
        ,'SocialUser_Mobile'
        ,'SocialUser_Email'
        ,'SocialUser_Address'
        ,'SocialUser_Product'
        ,'SocialUser_LastName'
        ,'Create_Date'
        ,'Update_Date'
        ,'UpdateByAgent_Id'
        ,'MergeGroup_Id'
        ,'Block'
    ];
}