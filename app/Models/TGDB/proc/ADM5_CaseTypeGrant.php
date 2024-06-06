<?php
namespace App\Models\TGDB\proc;
use CodeIgniter\Model;


class ADM5_CaseTypeGrant extends Model
{
    protected $DBGroup = 'tgdb';
    public $Agent_Id       = '';
    public $CaseType_Id    = '';
    public $Agent_Group_Id = '';
    public $ScreenType     = 'List';

    /**
     * @param Agent_Id
     * @param CaseType_Id
     * @param Agent_Group_Id
     * @param ScreenType
     */
    public function list()
    {
        $storedProc = "EXEC ADM5_CaseTypeGrant @Agent_Id=?,@CaseType_Id=?,@Agent_Group_Id=?,@ScreenType=?";
        $params     = [$this->Agent_Id,
                        $this->CaseType_Id,
                        $this->Agent_Group_Id,
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