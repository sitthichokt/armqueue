<?php

namespace App\Models\TGDB\proc;

use CodeIgniter\Model;

class ADM3_TagCategory_AddEdit extends Model
{
    protected $DBGroup = 'tgdb';
    public $Agent_Id        = '';
    public $ScreenType      = '';
    public $TagGrp_Id       = '';
    public $TagCat_Id       = '';
    public $TagCat_Name     = '';
    public $TagCat_OrderBy  = '';
    public $TagCat_Status   = '';

    /**
     * @param Agent_Id
     * @param TagGrp_Id
     * @param TagCat_Name
     * @param TagCat_OrderBy
     * @param TagCat_Status
     */
    public function add()
    {
        $this->db->transOff();
        $this->db->transBegin();
        $storedProc = "EXEC ADM3_TagCategory_AddEdit @Agent_Id=?,@ScreenType=?,@TagGrp_Id=?,@TagCat_Id=?,@TagCat_Name=?,@TagCat_OrderBy=?,@TagCat_Status=?";
        $params     = [$this->Agent_Id,
                        'ADD',
                        $this->TagGrp_Id,
                        $this->TagCat_Id,
                        $this->TagCat_Name,
                        $this->TagCat_OrderBy,
                        $this->TagCat_Status];
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
     * @param TagCat_Id
     * @param TagCat_Name
     * @param TagCat_OrderBy
     * @param TagCat_Status
     */
    public function edit()
    {
        $this->db->transOff();
        $this->db->transBegin();
        $storedProc = "EXEC ADM3_TagCategory_AddEdit @Agent_Id=?,@ScreenType=?,@TagGrp_Id=?,@TagCat_Id=?,@TagCat_Name=?,@TagCat_OrderBy=?,@TagCat_Status=?";
        $params     = [$this->Agent_Id,
                        'EDIT',
                        $this->TagGrp_Id,
                        $this->TagCat_Id,
                        $this->TagCat_Name,
                        $this->TagCat_OrderBy,
                        $this->TagCat_Status];
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