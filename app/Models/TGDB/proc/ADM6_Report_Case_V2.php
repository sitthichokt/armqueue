<?php
namespace App\Models\TGDB\proc;
use CodeIgniter\Model;

class ADM6_Report_Case_V2 extends Model
{
    protected $DBGroup = 'tgdb';
    public $AgentLogin_Id='';
    public $CaseCreate_from='';
    public $CaseCreate_to='';
    public $CustSocial_Id='';
    public $FilterAgent_Id='';
    public $Case_Status='';
    public $AllDetail='';
    public $ScreenExcel='SCREEN';
    public $AGroup_Id='';
    public $P_Ticket_No='';
    public $P_Social_Name='';
    public $P_First_Name='';
    public $P_Last_Name='';

    /** 
     * @param AgentLogin_Id
     * @param CaseCreate_from
     * @param CaseCreate_to
     * @param CustSocial_Id
     * @param FilterAgent_Id
     * @param Case_Status
     * @param AllDetail
     * @param ScreenExcel
     * @param AGroup_Id
     * @param P_Ticket_No
     * @param P_Social_Name
     * @param P_First_Name
     * @param P_Last_Name
     */
    public function get()
    {
        $storedProc = "EXEC ADM6_Report_Case_V2   @AgentLogin_Id=?,@CaseCreate_from=?,@CaseCreate_to=?,@CustSocial_Id=?,@FilterAgent_Id=?,@Case_Status=?,@AllDetail=?,@ScreenExcel=?,@AGroup_Id=?,@P_Ticket_No=?,@P_Social_Name=?,@P_First_Name=?,@P_Last_Name=?";
        $params     = [ $this->AgentLogin_Id
                        ,$this->CaseCreate_from
                        ,$this->CaseCreate_to
                        ,$this->CustSocial_Id
                        ,$this->FilterAgent_Id
                        ,$this->Case_Status
                        ,$this->AllDetail
                        ,$this->ScreenExcel
                        ,$this->AGroup_Id
                        ,$this->P_Ticket_No
                        ,$this->P_Social_Name
                        ,$this->P_First_Name
                        ,$this->P_Last_Name];
        $query      = $this->db->query($storedProc, $params);

        $results = array();
        if($this->ScreenExcel==='Excel'){
            $results['head'] = $query->getFieldNames();
            $results['body'] = $query->getResultArray(); 
        }else{
            $results    = $query->getResultArray();
        }
        unset($query);
    
        return $results;     
    }

}