<?php

namespace App\Models\TGDB\proc;

use CodeIgniter\Model;

class ADM3_FollowUp_CloseReason_AddEdit extends Model
{
    protected $DBGroup = 'tgdb';
    public $Agent_Id        = '';
    public $ScreenType      = '';
    public $FReason_Id      = '';
    public $FReason_Code    = '';
    public $FReason_Name    = '';
    public $FReason_follow  = '';
    public $FReason_Status  = '';
    public $FReason_orderby = '';


    /**
     * @param Agent_Id
     * @param FReason_Code
     * @param FReason_Name
     * @param FReason_follow
     * @param FReason_Status
     * @param FReason_orderby
     */
    public function add()
    {
        $this->db->transOff();
        $this->db->transBegin();
        $storedProc = "EXEC ADM3_FollowUp_CloseReason_AddEdit @Agent_Id=?,@ScreenType=?,@FReason_Id=?,@FReason_Code=?,@FReason_Name=?,@FReason_follow=?,@FReason_Status=?,@FReason_orderby=?";
        $params     = [$this->Agent_Id,
                        'ADD',
                        $this->FReason_Id,
                        $this->FReason_Code,
                        $this->FReason_Name,
                        $this->FReason_follow,
                        $this->FReason_Status,
                        $this->FReason_orderby];
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
     * @param FReason_Id
     * @param FReason_Code
     * @param FReason_Name
     * @param FReason_follow
     * @param FReason_Status
     * @param FReason_orderby
     */
    public function edit()
    {
        $this->db->transOff();
        $this->db->transBegin();
        $storedProc = "EXEC ADM3_FollowUp_CloseReason_AddEdit @Agent_Id=?,@ScreenType=?,@FReason_Id=?,@FReason_Code=?,@FReason_Name=?,@FReason_follow=?,@FReason_Status=?,@FReason_orderby=?";
        $params     = [$this->Agent_Id,
                        'EDIT',
                        $this->FReason_Id,
                        $this->FReason_Code,
                        $this->FReason_Name,
                        $this->FReason_follow,
                        $this->FReason_Status,
                        $this->FReason_orderby];
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
     * @param FReason_Id
     */
    public function get()
    {
        $storedProc = "EXEC ADM3_FollowUp_CloseReason_AddEdit @Agent_Id=?,@ScreenType=?,@FReason_Id=?,@FReason_Code=?,@FReason_Name=?,@FReason_follow=?,@FReason_Status=?,@FReason_orderby=?";
        $params     = [$this->Agent_Id,
                        'List',
                        $this->FReason_Id,
                        $this->FReason_Code,
                        $this->FReason_Name,
                        $this->FReason_follow,
                        $this->FReason_Status,
                        $this->FReason_orderby];
        $query      = $this->db->query($storedProc, $params);
        $results    = $query->getRowArray();
        return $results;
    }

    /**
     * @param Agent_Id
     * @param FType_Id
     */
    public function del()
    {
        $this->db->transOff();
        $this->db->transBegin();
        $storedProc = "EXEC ADM3_FollowUp_CloseReason_AddEdit @Agent_Id=?,@ScreenType=?,@FReason_Id=?,@FReason_Code=?,@FReason_Name=?,@FReason_follow=?,@FReason_Status=?,@FReason_orderby=?";
        $params     = [$this->Agent_Id,
                        'DELETE',
                        $this->FReason_Id,
                        $this->FReason_Code,
                        $this->FReason_Name,
                        $this->FReason_follow,
                        $this->FReason_Status,
                        $this->FReason_orderby];
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