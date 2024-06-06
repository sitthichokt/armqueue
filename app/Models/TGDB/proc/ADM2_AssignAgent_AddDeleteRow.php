<?php

namespace App\Models\TGDB\proc;

use CodeIgniter\Model;

class ADM2_AssignAgent_AddDeleteRow extends Model
{
    protected $DBGroup = 'tgdb';
    public $Agent_Id='';
    public $AssignAgent_Id='';
    public $Agent_Id_PK='';
    public $CustSocial_Id='';
    public $Answer_Chat='';
    public $Answer_Post='';
    public $ScreenType='';
    public $Display_Order='';

    /**
     * @param Agent_Id
     * @param Agent_Id_PK
     * @param CustSocial_Id
     * @param Answer_Chat
     * @param Answer_Post
     * @param Display_Order
     */
    public function add()
    {
        $this->db->transOff();
        $this->db->transBegin();
        $storedProc = "EXEC ADM2_AssignAgent_AddDeleteRow @Agent_Id=?,@AssignAgent_Id=?,@Agent_Id_PK=?,@CustSocial_Id=?,@Answer_Chat=?,@Answer_Post=?,@ScreenType=?,@Display_Order=?";
        $params     = [$this->Agent_Id
                    ,0
                    ,$this->Agent_Id_PK
                    ,$this->CustSocial_Id
                    ,$this->Answer_Chat
                    ,$this->Answer_Post
                    ,'ADD'
                    ,$this->Display_Order];
        $query      = $this->db->query($storedProc, $params);
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
     * @param AssignAgent_Id
     */
    public function get()
    {
        $storedProc = "EXEC ADM2_AssignAgent_AddDeleteRow @Agent_Id=?,@AssignAgent_Id=?,@Agent_Id_PK=?,@CustSocial_Id=?,@Answer_Chat=?,@Answer_Post=?,@ScreenType=?,@Display_Order=?";
        $params     = [$this->Agent_Id
                    ,$this->AssignAgent_Id
                    ,$this->Agent_Id_PK
                    ,$this->CustSocial_Id
                    ,$this->Answer_Chat
                    ,$this->Answer_Post
                    ,'List'
                    ,$this->Display_Order];
        $query      = $this->db->query($storedProc, $params);
        $results    = $query->getRowArray();
        return $results;  
    }

     /**
     * @param Agent_Id
     * @param AssignAgent_Id
     * @param Agent_Id_PK
     * @param CustSocial_Id
     * @param Answer_Chat
     * @param Answer_Post
     * @param Display_Order
     */
    public function edit()
    {
        $this->db->transOff();
        $this->db->transBegin();
        $storedProc = "EXEC ADM2_AssignAgent_AddDeleteRow @Agent_Id=?,@AssignAgent_Id=?,@Agent_Id_PK=?,@CustSocial_Id=?,@Answer_Chat=?,@Answer_Post=?,@ScreenType=?,@Display_Order=?";
        $params     = [$this->Agent_Id
                    ,$this->AssignAgent_Id
                    ,$this->Agent_Id_PK
                    ,$this->CustSocial_Id
                    ,$this->Answer_Chat
                    ,$this->Answer_Post
                    ,'UPDATE'
                    ,$this->Display_Order];
        $query      = $this->db->query($storedProc, $params);
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
     * @param AssignAgent_Id
     */
    public function del(){
        $this->db->transOff();
        $this->db->transBegin();
        $storedProc = "EXEC ADM2_AssignAgent_AddDeleteRow @Agent_Id=?,@AssignAgent_Id=?,@Agent_Id_PK=?,@CustSocial_Id=?,@Answer_Chat=?,@Answer_Post=?,@ScreenType=?,@Display_Order=?";
        $params     = [$this->Agent_Id
                    ,$this->AssignAgent_Id
                    ,$this->Agent_Id_PK
                    ,$this->CustSocial_Id
                    ,$this->Answer_Chat
                    ,$this->Answer_Post
                    ,'DELETE'
                    ,$this->Display_Order];
        $query      = $this->db->query($storedProc, $params);
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