<?php
namespace App\Models\TGDB\proc;
use CodeIgniter\Model;

class ADM6_Report_Case_ManyFilter extends Model
{
    protected $DBGroup = 'tgdb';
    public $AgentLogin_Id='';
    public $CaseCreate_from='';
    public $CaseCreate_to='';
    public $ScreenExcel='SCREEN';
    public $AllDetail='N';
    public $CustSocial_Id_List='';
    public $FilterAgent_Id_List='';
    public $Case_Status='';
    public $AGroup_Id_List='';

   

    /** 
     * @param int AgentLogin_Id
     * @param datetime CaseCreate_from
     * @param datetime CaseCreate_to
     * @param varchar  ScreenExcel
     * @param varchar  AllDetail
     * @param varchar  CustSocial_Id_List
     * @param varchar  FilterAgent_Id_List
     * @param varchar  Case_Status
     * @param varchar  AGroup_Id_List
     */
    public function get()
    {
        $storedProc = "EXEC ADM6_Report_Case_ManyFilter @AgentLogin_Id= ?,@CaseCreate_from= ?,@CaseCreate_to= ?,@ScreenExcel= ?,@AllDetail= ?,@CustSocial_Id_List= ?,@FilterAgent_Id_List= ?,@Case_Status= ?,@AGroup_Id_List= ?";
        $params     = [$this->AgentLogin_Id
                        ,$this->CaseCreate_from
                        ,$this->CaseCreate_to
                        ,$this->ScreenExcel
                        ,$this->AllDetail
                        ,$this->CustSocial_Id_List
                        ,$this->FilterAgent_Id_List
                        ,$this->Case_Status
                        ,$this->AGroup_Id_List];
        $query      = $this->db->query($storedProc, $params);

        if($this->ScreenExcel==='EXCEL'){
            $results['head'] = $query->getFieldNames();
            $results['body'] = $query->getResultArray(); 
        }else{
            $results    = $query->getResultArray();
        }
        unset($query);
        return $results;     
    }

}