<?php

namespace App\Models\TGDB\proc;

use CodeIgniter\Model;

class ADM5_CompanyProject_AddEdit extends Model
{
    protected $DBGroup = 'tgdb';
    public $Agent_Id      = '';
    public $ScreenType    = '';
    public $Proj_Id       = '';
    public $Proj_Code     = '';
    public $Proj_NameThai = '';
    public $Proj_NameEng  = '';
    public $ProductType   = '';
    public $Proj_OrderBy  = '';
    public $Proj_Status   = '';

    /**
     * @param Agent_Id
     * @param Proj_Code
     * @param Proj_NameThai
     * @param Proj_NameEng
     * @param ProductType
     * @param Proj_OrderBy
     * @param Proj_Status
     */
    public function add()
    {
        $this->db->transOff();
        $this->db->transBegin();
        $storedProc = "EXEC ADM5_CompanyProject_AddEdit @Agent_Id=?,@ScreenType=?,@Proj_Id=?,@Proj_Code=?,@Proj_NameThai=?,@Proj_NameEng=?,@ProductType=?,@Proj_OrderBy=?,@Proj_Status=?";
        $params     = [$this->Agent_Id,
                        'ADD',
                        0,
                        $this->Proj_Code,
                        $this->Proj_NameThai,
                        $this->Proj_NameEng,
                        $this->ProductType,
                        $this->Proj_OrderBy,
                        $this->Proj_Status];
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
     * @param Proj_Id
     * @param Proj_Code
     * @param Proj_NameThai
     * @param Proj_NameEng
     * @param ProductType
     * @param Proj_OrderBy
     * @param Proj_Status
     */
    public function edit()
    {
        $this->db->transOff();
        $this->db->transBegin();
        $storedProc = "EXEC ADM5_CompanyProject_AddEdit @Agent_Id=?,@ScreenType=?,@Proj_Id=?,@Proj_Code=?,@Proj_NameThai=?,@Proj_NameEng=?,@ProductType=?,@Proj_OrderBy=?,@Proj_Status=?";
        $params     = [$this->Agent_Id,
                        'EDIT',
                        $this->Proj_Id,
                        $this->Proj_Code,
                        $this->Proj_NameThai,
                        $this->Proj_NameEng,
                        $this->ProductType,
                        $this->Proj_OrderBy,
                        $this->Proj_Status];
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
     * @param Proj_Id
     */
    public function get()
    {
        $this->db->transOff();
        $this->db->transBegin();
        $storedProc = "EXEC ADM5_CompanyProject_AddEdit @Agent_Id=?,@ScreenType=?,@Proj_Id=?,@Proj_Code=?,@Proj_NameThai=?,@Proj_NameEng=?,@ProductType=?,@Proj_OrderBy=?,@Proj_Status=?";
        $params     = [$this->Agent_Id,
                        'List',
                        $this->Proj_Id,
                        $this->Proj_Code,
                        $this->Proj_NameThai,
                        $this->Proj_NameEng,
                        $this->ProductType,
                        $this->Proj_OrderBy,
                        $this->Proj_Status];
        $query      = $this->db->query($storedProc, $params);
        $results    = $query->getRowArray();
        unset($query,$storedProc);
        return $results;   
    }

}