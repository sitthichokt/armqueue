<?php
namespace App\Models\TGDB\proc;
use CodeIgniter\Model;

class ADM6_Report_Case_Person extends Model
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
     */
    public function get()
    {
        $storedProc = "EXEC ADM6_Report_Case_Person   @AgentLogin_Id=?,@CaseCreate_from=?,@CaseCreate_to=?,@CustSocial_Id=?,@FilterAgent_Id=?,@Case_Status=?,@AllDetail=?,@ScreenExcel=?,@AGroup_Id=?";
        $params     = [ $this->AgentLogin_Id
                        ,$this->CaseCreate_from
                        ,$this->CaseCreate_to
                        ,$this->CustSocial_Id
                        ,$this->FilterAgent_Id
                        ,$this->Case_Status
                        ,$this->AllDetail
                        ,$this->ScreenExcel
                        ,$this->AGroup_Id];
        $query      = $this->db->query($storedProc, $params);

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