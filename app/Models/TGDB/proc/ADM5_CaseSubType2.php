<?php
namespace App\Models\TGDB\proc;
use CodeIgniter\Model;


class ADM5_CaseSubType2 extends Model
{
    protected $DBGroup = 'tgdb';
    public $Agent_Id            = '';
    public $CaseType_Id         = '';
    public $CaseSubType1_Id     = '';
    public $CaseSubType2_Status = '';
    public $ScreenType          = 'List';


    /**
     * @param Agent_Id
     * @param CaseType_Id
     * @param CaseSubType1_Id
     * @param CaseSubType2_Status
     * @param ScreenType
     */
    public function list()
    {
        $storedProc = "EXEC ADM5_CaseSubType2 @Agent_Id=?,@CaseType_Id=?,@CaseSubType1_Id=?,@CaseSubType2_Status=?,@ScreenType=?";
        $params     = [$this->Agent_Id,
                        $this->CaseType_Id,
                        $this->CaseSubType1_Id,
                        $this->CaseSubType2_Status,
                        $this->ScreenType];
        $query      = $this->db->query($storedProc, $params);
   
        if($this->ScreenType==='Excel'){
            $results['head'] = $query->getFieldNames();
            $results['body'] = $query->getResultArray(); 
        }else{
            $results    = $query->getResultArray();
        }
        unset($query,$storedProc);
        return $results;   

   
    }
}