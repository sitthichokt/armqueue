<?php

namespace App\Models\TGDB\proc;

use CodeIgniter\Model;

class ADM3_TagManage_AddEdit extends Model
{
    protected $DBGroup = 'tgdb';
    public $Agent_Id    = '';
    public $ScreenType  = '';
    public $Tag_Id      = 0;
    public $TagCat_Id   = '';
    public $Tag_Name    = '';
    public $Tag_OrderBy = '';
    public $Tag_Status  = '';

      /**
     * @param Agent_Id

     * @param TagCat_Id
     * @param Tag_Name
     * @param Tag_OrderBy
     * @param Tag_Status
     */
    public function add()
    {
        $this->db->transOff();
        $this->db->transBegin();
        $storedProc = "EXEC ADM3_TagManage_AddEdit @Agent_Id=?,@ScreenType=?,@Tag_Id=?,@TagCat_Id=?,@Tag_Name=?,@Tag_OrderBy=?,@Tag_Status=?";
        $params     = [$this->Agent_Id,
                        'ADD',
                        $this->Tag_Id,
                        $this->TagCat_Id,
                        $this->Tag_Name,
                        $this->Tag_OrderBy,
                        $this->Tag_Status];
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
     * @param Tag_Id
     * @param TagCat_Id
     * @param Tag_Name
     * @param Tag_OrderBy
     * @param Tag_Status
     */
    public function edit()
    {
        $this->db->transOff();
        $this->db->transBegin();
        $storedProc = "EXEC ADM3_TagManage_AddEdit @Agent_Id=?,@ScreenType=?,@Tag_Id=?,@TagCat_Id=?,@Tag_Name=?,@Tag_OrderBy=?,@Tag_Status=?";
        $params     = [$this->Agent_Id,
                        'EDIT',
                        $this->Tag_Id,
                        $this->TagCat_Id,
                        $this->Tag_Name,
                        $this->Tag_OrderBy,
                        $this->Tag_Status];
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