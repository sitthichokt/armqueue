<?php
namespace App\Models\TGDB;
use CodeIgniter\Model;

class Ticket_QC extends Model
{
    protected $DBGroup = 'tgdb';
    protected $table = 'Ticket_QC';
    protected $primaryKey = 'QC_Id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'QC_Id'
    , 'ARCust_Id'
    , 'QHDR_ID'
    , 'Ticket_Id'
    , 'QC_NO'
    , 'QCAgent_Id'
    , 'QC_Date'
    , 'QC_Accept'
    , 'QC_TotalScore'
    , 'QC_Status'
    , 'QC_CreateDate'
    , 'QC_CreateBy'
    , 'QC_UpdateDate'
    , 'QC_UpdateBy'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'QC_CreateDate';
    protected $updatedField  = 'QC_UpdateDate';
  
}