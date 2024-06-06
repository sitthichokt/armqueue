<?php
namespace App\Models\TGDB;
use CodeIgniter\Model;

class Ticket_Gallery extends Model
{
    protected $DBGroup = 'tgdb';
    protected $table = 'Ticket_Gallery';
    protected $primaryKey = 'Gallery_Id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'Gallery_Id'
        ,'ARCust_Id'
        ,'CustSocial_Id'
        ,'Gallery_Tag'
        ,'Gallery_Name'
        ,'Gallery_Name_Old'
        ,'Gallery_PictureFile'
        ,'Gallery_Type'
        ,'Gallery_Extension'
        ,'Gallery_Status'
        ,'Gallery_CreateBy'
        ,'Gallery_CreateDate'
        ,'Gallery_UpdateBy'
        ,'Gallery_UpdateDate'
    ];

    // protected $useTimestamps = false;
    // protected $createdField  = 'Gallery_CreateBy';
    // protected $updatedField  = 'Gallery_CreateDate';
  
}