<?php
namespace App\Models\TGDB;
use CodeIgniter\Model;

class ARCustomer_Social extends Model
{
    protected $DBGroup = 'tgdb';
    protected $table = 'ARCustomer_Social';
    protected $primaryKey = 'CustSocial_Id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'CustSocial_Id'
        ,'ARCust_Id'
        ,'CustSocial_Group'
        ,'CustSocial_Name'
        ,'CustSocial_Picture'
        ,'CustSocial_Username'
        ,'CustSocial_Password'
        ,'CustSocial_PageId'
        ,'CustSocial_Token'
        ,'CustSocial_Remark'
        ,'CustSocial_Status'
        ,'CustSocial_CreateBy'
        ,'CustSocial_CreateDate'
        ,'CustSocial_UpdateBy'
        ,'CustSocial_UpdateDate'
        ,'CustSocial_ScreenName'
        ,'CustSocial_Keywords'
        ,'CustSocial_Token_Status'
        ,'Chatbot_First'
        ,'CustSocial_SendGrid_Status'
        ,'CustSocial_SendGrid_Token'
        ,'CustSocial_Email'
        ,'CustSocial_IVR'
        ,'CustSocial_IVR_Header'
        ,'CustSocial_PDPA'
        ,'CustSocial_PDPA_Header'
        ,'CusSocial_Accesstoken'
        ,'CusSocial_RefreshToken'
        ,'CustSocial_TokenCreateDate'
        ,'CustSocial_Facebook_PageId'
        ,'CustSocial_LineGroup'
        ,'CusSocial_Token_Expire'];

    protected $useTimestamps = true;
    protected $createdField  = 'CustSocial_CreateDate';
    protected $updatedField  = 'CustSocial_UpdateDate';
  
}