<?php

namespace App\Models\TGDB\proc;

use CodeIgniter\Model;

class ADM5_CaseTypeGrant_ToAgent extends Model
{
    protected $DBGroup = 'tgdb';
    public $Agent_Id        = '';
    public $Agent_Group_Id  = '';
    public $CaseType_Id     = '';
    public $CaseSubType1_Id = '';
    public $Require         = '';
    public $ScreenType      = '';




    /**
     * @param Agent_Id
     * @param Agent_Group_Id
     * @param CaseType_Id
     * @param CaseSubType1_Id
     * @param Require
     */
    private function exec()
    {
        $this->db->transOff();
        $this->db->transBegin();
        $storedProc = "EXEC ADM5_CaseTypeGrant_ToAgent @Agent_Id=?,@Agent_Group_Id=?,@CaseType_Id=?,@CaseSubType1_Id=?,@Require=?,@ScreenType=?";
        $params     = [$this->Agent_Id,
                        $this->Agent_Group_Id,
                        $this->CaseType_Id,
                        $this->CaseSubType1_Id,
                        $this->Require,
                        $this->ScreenType];
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
     * @param CaseType_Id
     * @param CaseSubType1_Id
     * @param Require
     */
    public function addall(){
        $this->ScreenType = 'AddAll';
        $data = $this->exec();
        return $data;
    }

    /**
     * @param Agent_Id
     * @param Agent_Group_Id
     * @param CaseType_Id
     * @param CaseSubType1_Id
     * @param Require
     */
    public function delall(){
        $this->ScreenType = 'DelAll';
        $data = $this->exec();
        return $data;
    }


 

    /**
     * @param Agent_Id
     * @param Agent_Group_Id
     * @param CaseType_Id
     * @param CaseSubType1_Id
     * @param Require
     */
    public function list(){
        $storedProc = "EXEC ADM5_CaseTypeGrant_ToAgent @Agent_Id=?,@Agent_Group_Id=?,@CaseType_Id=?,@CaseSubType1_Id=?,@Require=?,@ScreenType=?";
        $params     = [$this->Agent_Id,
                        $this->Agent_Group_Id,
                        $this->CaseType_Id,
                        $this->CaseSubType1_Id,
                        $this->Require,
                        'List'];
        $query      = $this->db->query($storedProc, $params);
        $results    = $query->getResultArray();
        unset($query,$storedProc,$params);
        return $results;   
    }
}