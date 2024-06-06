<?php
namespace App\Models\TGDB;
use CodeIgniter\Model;

class FB_ErrCode extends Model
{
    protected $DBGroup = 'tgdb';
    protected $table = 'FB_ErrCode';
    protected $primaryKey = 'FB_Err_ID';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'FB_Err_ID'
        ,'FB_Err_Code'
        ,'FB_Err_SubCode'
        ,'FB_Err_Text'
    ];
 
}