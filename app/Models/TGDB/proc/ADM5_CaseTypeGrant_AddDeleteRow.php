<?php

namespace App\Models\TGDB\proc;

use CodeIgniter\Model;

class ADM5_CaseTypeGrant_AddDeleteRow extends Model
{
    protected $DBGroup = 'tgdb';
    public $Agent_Id           = '';
    public $Agent_Group_Id     = '';
    public $CaseSubType2_Id    = '';
    public $CaseType_Grant_Id  = '';
    public $Require            = '';
    public $AddToGroup         = '';



    /**
     * @param Agent_Id
     * @param Agent_Group_Id
     * @param CaseSubType2_Id
     * @param CaseType_Grant_Id
     * @param Require
     * @param AddToGroup
     */
    private function exec(){
        $this->db->transOff();
        $this->db->transBegin();
        $storedProc = "EXEC ADM5_CaseTypeGrant_AddDeleteRow @Agent_Id=?,@Agent_Group_Id=?,@CaseSubType2_Id=?,@CaseType_Grant_Id=?,@Require=?,@AddToGroup=?";
        $params     = [$this->Agent_Id,
                        $this->Agent_Group_Id,
                        $this->CaseSubType2_Id,
                        $this->CaseType_Grant_Id,
                        $this->Require,
                        $this->AddToGroup];
        $query  = $this->db->query($storedProc, $params);
        if ($this->db->transStatus() === false) {
            //$this->db->transRollback();
            //$this->db->close();
            return false;
        } else {
            $this->db->transCommit();
            //$this->db->close();
            unset($query);
            return true;
        }
    }

    /**
     * @param Agent_Id
     * @param Agent_Group_Id
     * @param CaseSubType2_Id
     * @param CaseType_Grant_Id
     * @param Require
     * @param AddToGroup 0=ลบ,1=add
     */
    public function upd()
    {
        // $this->CaseType_Grant_Id = 0;
        // $this->AddToGroup = 1;
        $data = $this->exec();
        return $data;
    }

   

 

    
}
