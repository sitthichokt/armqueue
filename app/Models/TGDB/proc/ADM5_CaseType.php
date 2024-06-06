<?php
namespace App\Models\TGDB\proc;
use CodeIgniter\Model;


class ADM5_CaseType extends Model
{
    protected $DBGroup = 'tgdb';
    public $Agent_Id       = '';
    public $CaseType_Status = '';
    public $ScreenType     = 'List';

    /**
     * @param Agent_Id
     * @param CaseType_Status
     * @param ScreenType
     */
    public function list()
    {
        $storedProc = "EXEC ADM5_CaseType @Agent_Id=?,@CaseType_Status=?,@ScreenType=?";
        $params     = [$this->Agent_Id,
                        $this->CaseType_Status,
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