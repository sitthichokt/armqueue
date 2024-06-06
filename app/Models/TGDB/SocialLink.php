<?php
namespace App\Models\TGDB;
use CodeIgniter\Model;

class SocialLink extends Model
{
    protected $DBGroup = 'tgdb';
    protected $table = 'SocialLink';
    protected $primaryKey = 'sociallink_id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'sociallink_id'
        ,'sociallink_appid'
        ,'sociallink_accesstoken'
        ,'sociallink_refreshtoken'
        ,'sociallink_accesstoken_exp'
        ,'sociallink_refreshtoken_exp'
        ,'sociallink_createdate'
        ,'sociallink_updatedate'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'sociallink_createdate';
    protected $updatedField  = 'sociallink_updatedate';
}