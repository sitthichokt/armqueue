<?php

namespace App\Models\TGDB\proc;

use CodeIgniter\Model;

class ADM5_CaseType_AddEdit extends Model
{
    protected $DBGroup = 'tgdb';
    public $Agent_Id          = '';
    public $ScreenType        = '';
    public $CaseType_Id       = '';
    public $CaseType_NameThai = '';
    public $CaseType_NameEng  = '';
    public $CaseType_OrderBy  = '';
    public $CaseType_Status   = '';

    /**
     * @param Agent_Id
     * @param CaseType_Id
     */
    public function get()
    {
        $this->db->transOff();
        $this->db->transBegin();
        $storedProc = "EXEC ADM5_CaseType_AddEdit @Agent_Id=?,@ScreenType=?,@CaseType_Id=?,@CaseType_NameThai=?,@CaseType_NameEng=?,@CaseType_OrderBy=?,@CaseType_Status=?";
        $params     = [$this->Agent_Id,
                        'List',
                        $this->CaseType_Id,
                        $this->CaseType_NameThai,
                        $this->CaseType_NameEng,
                        $this->CaseType_OrderBy,
                        $this->CaseType_Status];
        $query      = $this->db->query($storedProc, $params);
        $results    = $query->getRowArray();
        unset($query,$storedProc,$params);
        return $results; 
    }

    /**
     * @param Agent_Id
     * @param CaseType_Id
     * @param CaseType_NameThai
     * @param CaseType_NameEng
     * @param CaseType_OrderBy
     * @param CaseType_Status
     */
    public function edit()
    {
        $this->db->transOff();
        $this->db->transBegin();
        $storedProc = "EXEC ADM5_CaseType_AddEdit @Agent_Id=?,@ScreenType=?,@CaseType_Id=?,@CaseType_NameThai=?,@CaseType_NameEng=?,@CaseType_OrderBy=?,@CaseType_Status=?";
        $params     = [$this->Agent_Id,
                        'EDIT',
                        $this->CaseType_Id,
                        $this->CaseType_NameThai,
                        $this->CaseType_NameEng,
                        $this->CaseType_OrderBy,
                        $this->CaseType_Status];
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
     * @param CaseType_NameThai
     * @param CaseType_NameEng
     * @param CaseType_OrderBy
     * @param CaseType_Status
     */
    public function add()
    {
        $this->db->transOff();
        $this->db->transBegin();
        $storedProc = "EXEC ADM5_CaseType_AddEdit @Agent_Id=?,@ScreenType=?,@CaseType_Id=?,@CaseType_NameThai=?,@CaseType_NameEng=?,@CaseType_OrderBy=?,@CaseType_Status=?";
        $params     = [$this->Agent_Id,
                        'ADD',
                        0,
                        $this->CaseType_NameThai,
                        $this->CaseType_NameEng,
                        $this->CaseType_OrderBy,
                        $this->CaseType_Status];
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
     */
    public function del()
    {
        $this->db->transOff();
        $this->db->transBegin();
        $storedProc = "EXEC ADM5_CaseType_AddEdit @Agent_Id=?,@ScreenType=?,@CaseType_Id=?,@CaseType_NameThai=?,@CaseType_NameEng=?,@CaseType_OrderBy=?,@CaseType_Status=?";
        $params     = [$this->Agent_Id,
                        'DELETE',
                        $this->CaseType_Id,
                        $this->CaseType_NameThai,
                        $this->CaseType_NameEng,
                        $this->CaseType_OrderBy,
                        $this->CaseType_Status];
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
    

}