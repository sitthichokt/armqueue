<?php
namespace App\Models\TGDB\proc;
use CodeIgniter\Model;

class ADM6_Report_SLA_ManyFilter extends Model
{
    protected $DBGroup = 'tgdb';
    public $AgentLogin_Id='';
    public $P_DateStart='';
    public $P_DateEnd='';
    public $TAB_NO='';
    public $CustSocial_Id='';
    public $AGroup_Id='';
    public $Agent_Id='';


    /** 
     * @param AgentLogin_Id
     * @param P_DateStart
     * @param P_DateEnd
     * @param TAB_NO
     * @param CustSocial_Id
     * @param AGroup_Id
     * @param Agent_Id
     */
    public function get()
    {
        $storedProc = "EXEC ADM6_Report_SLA_ManyFilter @AgentLogin_Id=?,@P_DateStart=?,@P_DateEnd=?,@TAB_NO=?,@CustSocial_Id=?,@AGroup_Id=?,@Agent_Id=?";
        $params     = [$this->AgentLogin_Id
                    ,$this->P_DateStart
                    ,$this->P_DateEnd
                    ,$this->TAB_NO
                    ,$this->CustSocial_Id
                    ,$this->AGroup_Id
                    ,$this->Agent_Id];
        $query      = $this->db->query($storedProc, $params);
        $results['count']   = $query->getNextRowArray(0);
        $results['link']    = $query->getNextRowArray(1);
        $results['table']   = $query->getNextRowArray(2);
        unset($query);
        return $results;     
    }

}