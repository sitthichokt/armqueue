<?php
namespace App\Models\TGDB;
use CodeIgniter\Model;

class ARM_SLA extends Model
{
    protected $DBGroup = 'tgdb';
    protected $table = 'ARM_SLA';
    protected $primaryKey = 'ARMSLA_Id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
      'ARMSLA_Id'
      , 'ARCust_Id'
      , 'SLA_BussHour_From'
      , 'SLA_BussHour_To'
      , 'SLA_1stResponse_L1_from'
      , 'SLA_1stResponse_L1_to'
      , 'SLA_1stResponse_L2_from'
      , 'SLA_1stResponse_L2_to'
      , 'SLA_1stResponse_L3_from'
      , 'SLA_1stResponse_L3_to'
      , 'SLA_1stResponse_L4_from'
      , 'SLA_1stResponse_L4_to'
      , 'SLA_AvgResponse_L1_from'
      , 'SLA_AvgResponse_L1_to'
      , 'SLA_AvgResponse_L2_from'
      , 'SLA_AvgResponse_L2_to'
      , 'SLA_AvgResponse_L3_from'
      , 'SLA_AvgResponse_L3_to'
      , 'SLA_AvgResponse_L4_from'
      , 'SLA_AvgResponse_L4_to'
      , 'SLA_AvgHandleTime_L1_from'
      , 'SLA_AvgHandleTime_L1_to'
      , 'SLA_AvgHandleTime_L2_from'
      , 'SLA_AvgHandleTime_L2_to'
      , 'SLA_AvgHandleTime_L3_from'
      , 'SLA_AvgHandleTime_L3_to'
      , 'SLA_AvgHandleTime_L4_from'
      , 'SLA_AvgHandleTime_L4_to'
      , 'SLA_ResolutionTime_L1_from'
      , 'SLA_ResolutionTime_L1_to'
      , 'SLA_ResolutionTime_L2_from'
      , 'SLA_ResolutionTime_L2_to'
      , 'SLA_ResolutionTime_L3_from'
      , 'SLA_ResolutionTime_L3_to'
      , 'SLA_ResolutionTime_L4_from'
      , 'SLA_ResolutionTime_L4_to'
      , 'ARMSLA_CreateBy'
      , 'ARMSLA_CreateDate'
      , 'ARMSLA_UpdateBy'
      , 'ARMSLA_UpdateDate'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'ARMSLA_CreateDate';
    protected $updatedField  = 'ARMSLA_UpdateDate';

  
}