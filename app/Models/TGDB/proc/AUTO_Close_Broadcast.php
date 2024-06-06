<?php
namespace App\Models\TGDB\proc;
use CodeIgniter\Model;


class AUTO_Close_Broadcast extends Model
{
    protected $DBGroup = 'tgdb';
    public $Agent_Id='';
    public $P_CustSocial_Id=0;
    public $ScreenType='List';
    public $P_CloseByAgent_Id =0;
    public $P_ASWProj_Id =0;
    public $P_ASWCaseType_L1_Id =0;
    public $P_ASWCaseType_L2_Id =0;
    public $P_ASWCaseType_L3_Id =0;
    public $P_WrapUp_Note ='';


    /**
     * @param int Agent_Id
     * @param int P_CustSocial_Id
     */
    public function get()
    {
        $storedProc = "EXEC AUTO_Close_Broadcast @Agent_Id=?,@P_CustSocial_Id=?,@ScreenType=?,@P_CloseByAgent_Id=?,@P_ASWProj_Id=?,@P_ASWCaseType_L1_Id=?,@P_ASWCaseType_L2_Id=?,@P_ASWCaseType_L3_Id=?,@P_WrapUp_Note=?";
        $params     = [$this->Agent_Id
                    ,$this->P_CustSocial_Id
                    ,$this->ScreenType
                    ,$this->P_CloseByAgent_Id
                    ,$this->P_ASWProj_Id
                    ,$this->P_ASWCaseType_L1_Id
                    ,$this->P_ASWCaseType_L2_Id
                    ,$this->P_ASWCaseType_L3_Id
                    ,$this->P_WrapUp_Note];
        $query      = $this->db->query($storedProc, $params);
        $results    = $query->getResultArray();
        return $results;
        
    }

    /**
     * @param int Agent_Id
     * @param int P_CustSocial_Id
     * @param int P_CloseByAgent_Id
     * @param int P_ASWProj_Id
     * @param int P_ASWCaseType_L1_Id
     * @param int P_ASWCaseType_L2_Id
     * @param int P_ASWCaseType_L3_Id
     * @param nvarchar P_WrapUp_Note
     */
    public function add(){
        $this->db->transOff();
        $this->db->transBegin();
        $storedProc = "EXEC AUTO_Close_Broadcast @Agent_Id=?,@P_CustSocial_Id=?,@ScreenType=?,@P_CloseByAgent_Id=?,@P_ASWProj_Id=?,@P_ASWCaseType_L1_Id=?,@P_ASWCaseType_L2_Id=?,@P_ASWCaseType_L3_Id=?,@P_WrapUp_Note=?";
        $params     = [$this->Agent_Id
                    ,$this->P_CustSocial_Id
                    ,'Close'
                    ,$this->P_CloseByAgent_Id
                    ,$this->P_ASWProj_Id
                    ,$this->P_ASWCaseType_L1_Id
                    ,$this->P_ASWCaseType_L2_Id
                    ,$this->P_ASWCaseType_L3_Id
                    ,$this->P_WrapUp_Note];
        $query      = $this->db->query($storedProc, $params);
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