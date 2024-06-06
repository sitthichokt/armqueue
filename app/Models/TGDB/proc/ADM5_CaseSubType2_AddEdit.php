<?php

namespace App\Models\TGDB\proc;

use CodeIgniter\Model;

class ADM5_CaseSubType2_AddEdit extends Model
{
    protected $DBGroup = 'tgdb';
    public $Agent_Id              = '';
    public $ScreenType            = '';
    public $CaseSubType2_Id       = '';
    public $CaseSubType1_Id       = '';
    public $CaseType_Id           = '';
    public $CaseSubType2_NameThai = '';
    public $CaseSubType2_NameEng  = '';
    public $CaseSubType2_OrderBy  = '';
    public $CaseSubType2_Status   = '';



    /**
     * @param Agent_Id
     * @param ScreenType
     * @param CaseSubType2_Id
     * @param CaseSubType1_Id
     * @param CaseType_Id
     * @param CaseSubType2_NameThai
     * @param CaseSubType2_NameEng
     * @param CaseSubType2_OrderBy
     * @param CaseSubType2_Status
     */
    private function exec()
    {
        $this->db->transOff();
        $this->db->transBegin();
        $storedProc = "EXEC ADM5_CaseSubType2_AddEdit @Agent_Id=?,@ScreenType=?,@CaseSubType2_Id=?,@CaseSubType1_Id=?,@CaseType_Id=?,@CaseSubType2_NameThai=?,@CaseSubType2_NameEng=?,@CaseSubType2_OrderBy=?,@CaseSubType2_Status=?";
        $params     = [
            $this->Agent_Id,
            $this->ScreenType,
            $this->CaseSubType2_Id,
            $this->CaseSubType1_Id,
            $this->CaseType_Id,
            $this->CaseSubType2_NameThai,
            $this->CaseSubType2_NameEng,
            $this->CaseSubType2_OrderBy,
            $this->CaseSubType2_Status
        ];
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
     * @param CaseSubType1_Id
     * @param CaseType_Id
     * @param CaseSubType2_NameThai
     * @param CaseSubType2_NameEng
     * @param CaseSubType2_OrderBy
     * @param CaseSubType2_Status
     */
    public function add()
    {
        $this->ScreenType = 'ADD';
        $data = $this->exec();
        return $data;
    }

    /**
     * @param Agent_Id
     * @param CaseSubType2_Id
     * @param CaseSubType1_Id
     * @param CaseType_Id
     * @param CaseSubType2_NameThai
     * @param CaseSubType2_NameEng
     * @param CaseSubType2_OrderBy
     * @param CaseSubType2_Status
     */
    public function edit()
    {
        $this->ScreenType = 'EDIT';
        $data = $this->exec();
        return $data;
    }

    /**
     * @param Agent_Id
     * @param CaseSubType2_Id
     */
    public function del()
    {
        $this->ScreenType = 'DELETE';
        $data = $this->exec();
        return $data;
    }

    /**
     * @param Agent_Id
     * @param CaseSubType2_Id
     */
    public function list()
    {
        $storedProc = "EXEC ADM5_CaseSubType2_AddEdit @Agent_Id=?,@ScreenType=?,@CaseSubType2_Id=?,@CaseSubType1_Id=?,@CaseType_Id=?,@CaseSubType2_NameThai=?,@CaseSubType2_NameEng=?,@CaseSubType2_OrderBy=?,@CaseSubType2_Status=?";
        $params     = [
            $this->Agent_Id,
            'List',
            $this->CaseSubType2_Id,
            $this->CaseSubType1_Id,
            $this->CaseType_Id,
            $this->CaseSubType2_NameThai,
            $this->CaseSubType2_NameEng,
            $this->CaseSubType2_OrderBy,
            $this->CaseSubType2_Status
        ];
        $query      = $this->db->query($storedProc, $params);
        $results    = $query->getRowArray();
        unset($query, $storedProc, $params);
        return $results;
    }
}
