<?php
namespace App\Models\TGDB\proc;
use CodeIgniter\Model;

class ADM6_Report_SLA_EXCEL extends Model
{
    protected $DBGroup = 'tgdb';
 
    public $AgentLogin_Id='';
    public $P_DateStart='';
    public $P_DateEnd='';
    public $CustSocial_Id='';
    public $TAB_NO='';
    public $AGroup_Id='';
    public $Agent_Id='';
   
    /**
     *@param AgentLogin_Id
     *@param P_DateStart
     *@param P_DateEnd
     *@param CustSocial_Id
     *@param TAB_NO
     *@param AGroup_Id
     *@param Agent_Id
     */
    public function get()
    {
        $storedProc = "EXEC ADM6_Report_SLA_EXCEL   @AgentLogin_Id= ?,@P_DateStart= ?,@P_DateEnd= ?,@CustSocial_Id= ?,@TAB_NO= ?,@AGroup_Id= ?,@Agent_Id= ?";
        $params     = [ $this->AgentLogin_Id
                        ,$this->P_DateStart
                        ,$this->P_DateEnd
                        ,$this->CustSocial_Id
                        ,$this->TAB_NO
                        ,$this->AGroup_Id
                        ,$this->Agent_Id];
        $query      = $this->db->query($storedProc, $params);
        $results['head']      = $query->getFieldNamesnext();
        unset($query);
        $query      = $this->db->query($storedProc, $params);
        $results['body']['a']      = $query->getNextRowArray(0);
        $results['body']['b']      = $query->getNextRowArray(1);
        unset($query);
    
        return $results;     
    }

}