<?php

namespace App\Models\TGDB\proc;

use CodeIgniter\Model;

class ADM3_TagGroup_AddEdit extends Model
{
    protected $DBGroup = 'tgdb';
    public $Agent_Id        = '';
    public $ScreenType      = '';
    public $TagGrp_Id       = '';
    public $TagGrp_Name     = '';
    public $TagGrp_OrderBy  = '';
    public $TagGrp_Status   = '';

    /**
     * @param Agent_Id
     * @param TagGrp_Name
     * @param TagGrp_OrderBy
     * @param TagGrp_Status
     */
    public function add()
    {
        $this->db->transOff();
        $this->db->transBegin();
        $storedProc = "EXEC ADM3_TagGroup_AddEdit @Agent_Id=?,@ScreenType=?,@TagGrp_Id=?,@TagGrp_Name=?,@TagGrp_OrderBy=?,@TagGrp_Status=?";
        $params     = [$this->Agent_Id,
                        'ADD',
                        $this->TagGrp_Id,
                        $this->TagGrp_Name,
                        $this->TagGrp_OrderBy,
                        $this->TagGrp_Status,];
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
     * @param TagGrp_Id
     * @param TagGrp_Name
     * @param TagGrp_OrderBy
     * @param TagGrp_Status
     */
    public function edit()
    {
        $this->db->transOff();
        $this->db->transBegin();
        $storedProc = "EXEC ADM3_TagGroup_AddEdit @Agent_Id=?,@ScreenType=?,@TagGrp_Id=?,@TagGrp_Name=?,@TagGrp_OrderBy=?,@TagGrp_Status=?";
        $params     = [$this->Agent_Id,
                        'EDIT',
                        $this->TagGrp_Id,
                        $this->TagGrp_Name,
                        $this->TagGrp_OrderBy,
                        $this->TagGrp_Status,];
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