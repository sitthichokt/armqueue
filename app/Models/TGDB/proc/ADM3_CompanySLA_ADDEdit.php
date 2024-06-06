<?php

namespace App\Models\TGDB\proc;

use CodeIgniter\Model;

class ADM3_CompanySLA_ADDEdit extends Model
{
    protected $DBGroup = 'tgdb';
    public $Admin_id                    = '';
	public $ARMSLA_Id                   = '';
	public $ARCustId                    = '';
    public $SLA_BussHour_From           = '';
    public $SLA_BussHour_To             = '';
    public $SLA_1stResponse_L1_from     = '';
    public $SLA_1stResponse_L1_to       = '';
    public $SLA_1stResponse_L2_from     = '';
    public $SLA_1stResponse_L2_to       = '';
    public $SLA_1stResponse_L3_from     = '';
    public $SLA_1stResponse_L3_to       = '';
    public $SLA_1stResponse_L4_from     = '';
    public $SLA_1stResponse_L4_to       = '';
	public $SLA_AvgResponse_L1_from     = '';
    public $SLA_AvgResponse_L1_to       = '';
    public $SLA_AvgResponse_L2_from     = '';
    public $SLA_AvgResponse_L2_to       = '';
    public $SLA_AvgResponse_L3_from     = '';
    public $SLA_AvgResponse_L3_to       = '';
    public $SLA_AvgResponse_L4_from     = '';
    public $SLA_AvgResponse_L4_to       = '';
	public $SLA_AvgHandleTime_L1_from   = '';
    public $SLA_AvgHandleTime_L1_to     = '';
    public $SLA_AvgHandleTime_L2_from   = '';
    public $SLA_AvgHandleTime_L2_to     = '';
    public $SLA_AvgHandleTime_L3_from   = '';
    public $SLA_AvgHandleTime_L3_to     = '';
    public $SLA_AvgHandleTime_L4_from   = '';
    public $SLA_AvgHandleTime_L4_to     = '';
	public $SLA_ResolutionTime_L1_from  = '';
    public $SLA_ResolutionTime_L1_to    = '';
    public $SLA_ResolutionTime_L2_from  = '';
    public $SLA_ResolutionTime_L2_to    = '';
    public $SLA_ResolutionTime_L3_from  = '';
    public $SLA_ResolutionTime_L3_to    = '';
    public $SLA_ResolutionTime_L4_from  = '';
    public $SLA_ResolutionTime_L4_to    = '';
    public $ARMSLA_CreateBy             = '';


    /**
     * @param Admin_id
     * @param ARMSLA_Id
     * @param ARCustId
     * @param SLA_BussHour_From
     * @param SLA_BussHour_To
     * @param SLA_1stResponse_L1_from
     * @param SLA_1stResponse_L1_to
     * @param SLA_1stResponse_L2_from
     * @param SLA_1stResponse_L2_to
     * @param SLA_1stResponse_L3_from
     * @param SLA_1stResponse_L3_to
     * @param SLA_1stResponse_L4_from
     * @param SLA_1stResponse_L4_to
     * @param SLA_AvgResponse_L1_from
     * @param SLA_AvgResponse_L1_to
     * @param SLA_AvgResponse_L2_from
     * @param SLA_AvgResponse_L2_to
     * @param SLA_AvgResponse_L3_from
     * @param SLA_AvgResponse_L3_to
     * @param SLA_AvgResponse_L4_from
     * @param SLA_AvgResponse_L4_to
     * @param SLA_AvgHandleTime_L1_from
     * @param SLA_AvgHandleTime_L1_to
     * @param SLA_AvgHandleTime_L2_from
     * @param SLA_AvgHandleTime_L2_to
     * @param SLA_AvgHandleTime_L3_from
     * @param SLA_AvgHandleTime_L3_to
     * @param SLA_AvgHandleTime_L4_from
     * @param SLA_AvgHandleTime_L4_to
     * @param SLA_ResolutionTime_L1_from
     * @param SLA_ResolutionTime_L1_to
     * @param SLA_ResolutionTime_L2_from 
     * @param SLA_ResolutionTime_L2_to
     * @param SLA_ResolutionTime_L3_from 
     * @param SLA_ResolutionTime_L3_to
     * @param SLA_ResolutionTime_L4_from
     * @param SLA_ResolutionTime_L4_to
     * @param ARMSLA_CreateBy
     */
    public function add()
    {
        $this->db->transOff();
        $this->db->transBegin();
        $storedProc = "EXEC ADM3_CompanySLA_ADDEdit @Admin_id=?,@ARMSLA_Id=?,@ARCustId=?,@SLA_BussHour_From=?,@SLA_BussHour_To=?,@SLA_1stResponse_L1_from=?,@SLA_1stResponse_L1_to=?,@SLA_1stResponse_L2_from=?,@SLA_1stResponse_L2_to=?,@SLA_1stResponse_L3_from=?,@SLA_1stResponse_L3_to=?,@SLA_1stResponse_L4_from=?,@SLA_1stResponse_L4_to=?,@SLA_AvgResponse_L1_from=?,@SLA_AvgResponse_L1_to=?,@SLA_AvgResponse_L2_from=?,@SLA_AvgResponse_L2_to=?,@SLA_AvgResponse_L3_from=?,@SLA_AvgResponse_L3_to=?,@SLA_AvgResponse_L4_from=?,@SLA_AvgResponse_L4_to=?,@SLA_AvgHandleTime_L1_from=?,@SLA_AvgHandleTime_L1_to=?,@SLA_AvgHandleTime_L2_from=?,@SLA_AvgHandleTime_L2_to=?,@SLA_AvgHandleTime_L3_from=?,@SLA_AvgHandleTime_L3_to=?,@SLA_AvgHandleTime_L4_from=?,@SLA_AvgHandleTime_L4_to=?,@SLA_ResolutionTime_L1_from=?,@SLA_ResolutionTime_L1_to=?,@SLA_ResolutionTime_L2_from =?,@SLA_ResolutionTime_L2_to=?,@SLA_ResolutionTime_L3_from =?,@SLA_ResolutionTime_L3_to=?,@SLA_ResolutionTime_L4_from=?,@SLA_ResolutionTime_L4_to=?,@ARMSLA_CreateBy=?";
        $params     = [ $this->Admin_id,
                        $this->ARMSLA_Id,
                        $this->ARCustId,
                        $this->SLA_BussHour_From,
                        $this->SLA_BussHour_To,
                        $this->SLA_1stResponse_L1_from,
                        $this->SLA_1stResponse_L1_to,
                        $this->SLA_1stResponse_L2_from,
                        $this->SLA_1stResponse_L2_to,
                        $this->SLA_1stResponse_L3_from,
                        $this->SLA_1stResponse_L3_to,
                        $this->SLA_1stResponse_L4_from,
                        $this->SLA_1stResponse_L4_to,
                        $this->SLA_AvgResponse_L1_from,
                        $this->SLA_AvgResponse_L1_to,
                        $this->SLA_AvgResponse_L2_from,
                        $this->SLA_AvgResponse_L2_to,
                        $this->SLA_AvgResponse_L3_from,
                        $this->SLA_AvgResponse_L3_to,
                        $this->SLA_AvgResponse_L4_from,
                        $this->SLA_AvgResponse_L4_to,
                        $this->SLA_AvgHandleTime_L1_from,
                        $this->SLA_AvgHandleTime_L1_to,
                        $this->SLA_AvgHandleTime_L2_from,
                        $this->SLA_AvgHandleTime_L2_to,
                        $this->SLA_AvgHandleTime_L3_from,
                        $this->SLA_AvgHandleTime_L3_to,
                        $this->SLA_AvgHandleTime_L4_from,
                        $this->SLA_AvgHandleTime_L4_to,
                        $this->SLA_ResolutionTime_L1_from,
                        $this->SLA_ResolutionTime_L1_to,
                        $this->SLA_ResolutionTime_L2_from ,
                        $this->SLA_ResolutionTime_L2_to,
                        $this->SLA_ResolutionTime_L3_from ,
                        $this->SLA_ResolutionTime_L3_to,
                        $this->SLA_ResolutionTime_L4_from,
                        $this->SLA_ResolutionTime_L4_to,
                        $this->ARMSLA_CreateBy];
        $query  = $this->db->query($storedProc, $params);
        if ($this->db->transStatus() === false) {
            //$this->db->transRollback();
            //$this->db->close();	
            return false;
        } else {		
            $this->db->transCommit();
            //$this->db->close();
            unset($query);	
            return true;
        }
    }
}