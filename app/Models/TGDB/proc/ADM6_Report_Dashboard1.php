<?php
namespace App\Models\TGDB\proc;
use CodeIgniter\Model;

class ADM6_Report_Dashboard1 extends Model
{
    protected $DBGroup = 'tgdb';
    public $AgentLogin_Id='';
    public $FilterAgent_Id='';
    public $AGroup_Id='';
    public $CaseCreate_from='';
    public $CaseCreate_to='';
    public $CustSocial_Id='';

    /** 
     * @param AgentLogin_Id
     * @param FilterAgent_Id
     * @param AGroup_Id
     * @param CaseCreate_from
     * @param CaseCreate_to
     * @param CustSocial_Id
     */
    public function get()
    {
        $storedProc = "EXEC ADM6_Report_Dashboard1   @AgentLogin_Id=?,@FilterAgent_Id=?,@AGroup_Id=?,@CaseCreate_from=?,@CaseCreate_to=?,@CustSocial_Id=?";
        $params     = [ $this->AgentLogin_Id,
                        $this->FilterAgent_Id,
                        $this->AGroup_Id,
                        $this->CaseCreate_from,
                        $this->CaseCreate_to,
                        $this->CustSocial_Id,];
        $query      = $this->db->query($storedProc, $params);

        $results['CustomerName']  = $query->getNextRowArray(0);
        $results['PageVolume']    = $query->getNextRowArray(1);
        $results['CaseStatus']    = $query->getNextRowArray(2);
        $results['PageSummary']   = $query->getNextRowArray(3);
        $results['AgentSummary']  = $query->getNextRowArray(4);
        unset($query);
    
        return $results;     
    }

}