<?php
namespace App\Models\TGDB\proc;
use CodeIgniter\Model;


class ADM_CaseSubType1 extends Model
{
    protected $DBGroup = 'tgdb';
    public $Agent_Id       = '';
    public $CaseType_Id    = '';

    /**
     * @param Agent_Id
     * @param CaseType_Id
     */
    public function list()
    {
        $storedProc = "EXEC ADM_CaseSubType1 @Agent_Id=?,@CaseType_Id=?";
        $params     = [$this->Agent_Id,
                        $this->CaseType_Id];
        $query      = $this->db->query($storedProc, $params);
        $results    = $query->getResultArray();
        unset($query,$storedProc,$params);
        return $results;   

   
    }
}