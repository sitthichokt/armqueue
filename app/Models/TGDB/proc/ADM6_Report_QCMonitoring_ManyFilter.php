<?php
namespace App\Models\TGDB\proc;
use CodeIgniter\Model;

class ADM6_Report_QCMonitoring_ManyFilter extends Model
{
    protected $DBGroup = 'tgdb';
    public $AgentLogin_Id='';
    public $QCDate_from='';
    public $QCDate_to='';
    public $ScreenExcel='SCREEN';
    public $AllDetail='N';
    public $CustSocial_Id_List='';
    public $FilterAgent_Id_List='';
    public $AGroup_Id_List='';

    /** 
     * @param AgentLogin_Id
     * @param QCDate_from
     * @param QCDate_to
     * @param ScreenExcel
     * @param AllDetail
     * @param CustSocial_Id_List
     * @param FilterAgent_Id_List
     * @param AGroup_Id_List
     */
    public function get()
    {
        $storedProc = "EXEC ADM6_Report_QCMonitoring_ManyFilter @AgentLogin_Id=?,@QCDate_from=?,@QCDate_to=?,@ScreenExcel=?,@AllDetail=?,@CustSocial_Id_List=?,@FilterAgent_Id_List=?,@AGroup_Id_List=?";
        $params     = [$this->AgentLogin_Id
                    ,$this->QCDate_from
                    ,$this->QCDate_to
                    ,$this->ScreenExcel
                    ,$this->AllDetail
                    ,$this->CustSocial_Id_List
                    ,$this->FilterAgent_Id_List
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