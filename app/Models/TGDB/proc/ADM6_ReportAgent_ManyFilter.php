<?php
namespace App\Models\TGDB\proc;
use CodeIgniter\Model;

class ADM6_ReportAgent_ManyFilter extends Model
{
    protected $DBGroup = 'tgdb';
    public $AgentLogin_Id='';
    public $AGroup_Id='';
    public $FilterAgent_Id='';
    public $DateFrom='';
    public $DateTo='';
    public $ReportType='SCREEN';
    public $AgentStatus='';
    
    /** 
     * @param AgentLogin_Id
     * @param AGroup_Id
     * @param FilterAgent_Id
     * @param DateFrom
     * @param DateTo
     * @param ReportType
     * @param AgentStatus
     */
    public function get()
    {
        // $storedProc = "EXEC ADM6_ReportAgent_ManyFilter @AgentLogin_Id=?,@AGroup_Id=?,@FilterAgent_Id=?,@DateFrom=?,@DateTo=?,@ReportType=?,@AgentStatus=?";
        $storedProc = "EXEC ADM6_ReportAgent_ManyFilter_CI @AgentLogin_Id=?,@AGroup_Id=?,@FilterAgent_Id=?,@DateFrom=?,@DateTo=?,@ReportType=?,@AgentStatus=?";
        $params     = [$this->AgentLogin_Id
                    ,$this->AGroup_Id
                    ,$this->FilterAgent_Id
                    ,$this->DateFrom
                    ,$this->DateTo
                    ,$this->ReportType
                    ,$this->AgentStatus];
        $query      = $this->db->query($storedProc, $params);

        if($this->ReportType==='Excel_log'||$this->ReportType==='Excel_Summary'){
            $results['head'] = $query->getFieldNames();
            $results['body'] = $query->getResultArray(); 
        }else{
            $results    = $query->getResultArray();
        }
        
        unset($query);
        return $results;     
    }

}