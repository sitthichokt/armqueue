<?php

namespace App\Models\TGDB\proc;

use CodeIgniter\Model;

class ADM3_Follow_Up_Type_AddEdit extends Model
{
    protected $DBGroup = 'tgdb';
    public $Agent_Id                = '';
    public $ScreenType              = '';
    public $FType_Id                = '';
    public $FType_Code              = '';
    public $FType_Name              = '';
    public $FType_AlertB4_Days      = '';
    public $FType_AlertAgain_Days   = '';
    public $FType_OrderBy           = '';
    public $FType_Status            = '';


        /**
     * @param Agent_Id
     * @param FType_Code
     * @param FType_Name
     * @param FType_AlertB4_Days
     * @param FType_AlertAgain_Days
     * @param FType_OrderBy
     * @param FType_Status
     */
    public function add()
    {
        $this->db->transOff();
        $this->db->transBegin();
        $storedProc = "EXEC ADM3_Follow_Up_Type_AddEdit @Agent_Id=?,@ScreenType=?,@FType_Id=?,@FType_Code=?,@FType_Name=?,@FType_AlertB4_Days=?,@FType_AlertAgain_Days=?,@FType_OrderBy=?,@FType_Status=?";
        $params     = [$this->Agent_Id,
                        'ADD',
                        $this->FType_Id,
                        $this->FType_Code,
                        $this->FType_Name,
                        $this->FType_AlertB4_Days,
                        $this->FType_AlertAgain_Days,
                        $this->FType_OrderBy,
                        $this->FType_Status];
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
     * @param FType_Id
     * @param FType_Code
     * @param FType_Name
     * @param FType_AlertB4_Days
     * @param FType_AlertAgain_Days
     * @param FType_OrderBy
     * @param FType_Status
     */
    public function edit()
    {
        $this->db->transOff();
        $this->db->transBegin();
        $storedProc = "EXEC ADM3_Follow_Up_Type_AddEdit @Agent_Id=?,@ScreenType=?,@FType_Id=?,@FType_Code=?,@FType_Name=?,@FType_AlertB4_Days=?,@FType_AlertAgain_Days=?,@FType_OrderBy=?,@FType_Status=?";
        $params     = [$this->Agent_Id,
                        'EDIT',
                        $this->FType_Id,
                        $this->FType_Code,
                        $this->FType_Name,
                        $this->FType_AlertB4_Days,
                        $this->FType_AlertAgain_Days,
                        $this->FType_OrderBy,
                        $this->FType_Status];
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
     * @param FType_Id
     */
    public function del()
    {
        $this->db->transOff();
        $this->db->transBegin();
        $storedProc = "EXEC ADM3_Follow_Up_Type_AddEdit @Agent_Id=?,@ScreenType=?,@FType_Id=?,@FType_Code=?,@FType_Name=?,@FType_AlertB4_Days=?,@FType_AlertAgain_Days=?,@FType_OrderBy=?,@FType_Status=?";
        $params     = [$this->Agent_Id,
                        'DELETE',
                        $this->FType_Id,
                        $this->FType_Code,
                        $this->FType_Name,
                        $this->FType_AlertB4_Days,
                        $this->FType_AlertAgain_Days,
                        $this->FType_OrderBy,
                        $this->FType_Status];
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
     * @param FType_Id
     */
    public function get()
    {
        $storedProc = "EXEC ADM3_Follow_Up_Type_AddEdit @Agent_Id=?,@ScreenType=?,@FType_Id=?,@FType_Code=?,@FType_Name=?,@FType_AlertB4_Days=?,@FType_AlertAgain_Days=?,@FType_OrderBy=?,@FType_Status=?";
        $params     = [$this->Agent_Id,
                        'List',
                        $this->FType_Id,
                        $this->FType_Code,
                        $this->FType_Name,
                        $this->FType_AlertB4_Days,
                        $this->FType_AlertAgain_Days,
                        $this->FType_OrderBy,
                        $this->FType_Status];
        $query      = $this->db->query($storedProc, $params);
        $results    = $query->getRowArray();
        return $results;
    }
}