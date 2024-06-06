<?php
namespace App\Models\TGDB;
use CodeIgniter\Model;

class ARCust_PhoneCall_API extends Model
{
    protected $DBGroup = 'tgdb';
    protected $table = 'ARCust_PhoneCall_API';
    protected $primaryKey = 'PhoneCall_API_Id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'PhoneCall_API_Id'
        ,'PhoneCall_API_Ip'
        ,'PhoneCall_API_Path'
        ,'PhoneCall_API_Status'
        ,'CustSocial_Id'
        ,'PhoneCall_API_Response'
        ,'PhoneCall_API_Request'
        ,'PhoneCall_API_CreateDate'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'PhoneCall_API_CreateDate';
    protected $updatedField  = 'PhoneCall_API_CreateDate';
}