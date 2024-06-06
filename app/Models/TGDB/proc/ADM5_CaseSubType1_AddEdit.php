<?php

namespace App\Models\TGDB\proc;

use CodeIgniter\Model;

class ADM5_CaseSubType1_AddEdit extends Model
{
    protected $DBGroup = 'tgdb';
    public $Agent_Id              = '';
    public $ScreenType            = '';
    public $CaseSubType1_Id       = '';
    public $CaseType_Id           = '';
    public $CaseSubType1_NameThai = '';
    public $CaseSubType1_NameEng  = '';
    public $CaseSubType1_OrderBy  = '';
    public $CaseSubType1_Status   = '';


    /**
     * @param Agent_Id
     * @param ScreenType
     * @param CaseSubType1_Id
     * @param CaseType_Id
     * @param CaseSubType1_NameThai
     * @param CaseSubType1_NameEng
     * @param CaseSubType1_OrderBy
     * @param CaseSubType1_Status
     */
    private function exec()
    {
        $this->db->transOff();
        $this->db->transBegin();
        $storedProc = "EXEC ADM5_CaseSubType1_AddEdit @Agent_Id=?,@ScreenType=?,@CaseSubType1_Id=?,@CaseType_Id=?,@CaseSubType1_NameThai=?,@CaseSubType1_NameEng=?,@CaseSubType1_OrderBy=?,@CaseSubType1_Status=?";
        $params     = [$this->Agent_Id,
                        $this->ScreenType,
                        $this->CaseSubType1_Id,
                        $this->CaseType_Id,
                        $this->CaseSubType1_NameThai,
                        $this->CaseSubType1_NameEng,
                        $this->CaseSubType1_OrderBy,
                        $this->CaseSubType1_Status];
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
     * @param CaseType_Id
     * @param CaseSubType1_NameThai
     * @param CaseSubType1_NameEng
     * @param CaseSubType1_OrderBy
     * @param CaseSubType1_Status
     */
    public function add(){
        $this->ScreenType = 'ADD';
        $data = $this->exec();
        return $data;
    }

    /**
     * @param Agent_Id
     * @param CaseSubType1_Id
     * @param CaseType_Id
     * @param CaseSubType1_NameThai
     * @param CaseSubType1_NameEng
     * @param CaseSubType1_OrderBy
     * @param CaseSubType1_Status
     */
    public function edit(){
        $this->ScreenType = 'EDIT';
        $data = $this->exec();
        return $data;
    }

    /**
     * @param Agent_Id
     * @param CaseSubType1_Id
     */
    public function del(){
        $this->ScreenType = 'DELETE';
        $data = $this->exec();
        return $data;
    }

    /**
     * @param Agent_Id
     * @param CaseSubType1_Id
     */
    public function list(){
        $storedProc = "EXEC ADM5_CaseSubType1_AddEdit @Agent_Id=?,@ScreenType=?,@CaseSubType1_Id=?,@CaseType_Id=?,@CaseSubType1_NameThai=?,@CaseSubType1_NameEng=?,@CaseSubType1_OrderBy=?,@CaseSubType1_Status=?";
        $params     = [$this->Agent_Id,
                        'List',
                        $this->CaseSubType1_Id,
                        $this->CaseType_Id,
                        $this->CaseSubType1_NameThai,
                        $this->CaseSubType1_NameEng,
                        $this->CaseSubType1_OrderBy,
                        $this->CaseSubType1_Status];
        $query      = $this->db->query($storedProc, $params);
        $results    = $query->getRowArray();
        unset($query,$storedProc,$params);
        return $results;   
    }
}