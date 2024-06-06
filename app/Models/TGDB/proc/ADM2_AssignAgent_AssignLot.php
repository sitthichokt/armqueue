<?php

namespace App\Models\TGDB\proc;

use CodeIgniter\Model;

class ADM2_AssignAgent_AssignLot extends Model
{
    protected $DBGroup = 'tgdb';
    public $Agent_Id='';
    public $Agent_Group_Id='';
    public $Agent_Id_PK='';
    public $CustSocial_Type='';
    public $CustSocial_Id='';
    public $Answer_Chat='';
    public $Answer_Post='';
    public $ScreenType='';

    /**
     * @param Agent_Id
     * @param Agent_Group_Id
     * @param Agent_Id_PK
     * @param CustSocial_Type
     * @param CustSocial_Id
     * @param Answer_Chat
     * @param Answer_Post
     */
    public function get()
    {
        $storedProc = "EXEC ADM2_AssignAgent_AssignLot @Agent_Id=?,@Agent_Group_Id=?,@Agent_Id_PK=?,@CustSocial_Type=?,@CustSocial_Id=?,@Answer_Chat=?,@Answer_Post=?,@ScreenType=?";
        $params     = [$this->Agent_Id
                        ,$this->Agent_Group_Id
                        ,$this->Agent_Id_PK
                        ,$this->CustSocial_Type
                        ,$this->CustSocial_Id
                        ,$this->Answer_Chat
                        ,$this->Answer_Post
                        ,'List'];
        $query      = $this->db->query($storedProc, $params);
        $results    = $query->getResultArray();
        return $results;  
    }

    /**
     * @param Agent_Id
     * @param Agent_Group_Id
     * @param Agent_Id_PK
     * @param CustSocial_Type
     * @param CustSocial_Id
     * @param Answer_Chat
     * @param Answer_Post
     */
    public function addall()
    {
        $this->db->transOff();
        $this->db->transBegin();
        $storedProc = "EXEC ADM2_AssignAgent_AssignLot @Agent_Id=?,@Agent_Group_Id=?,@Agent_Id_PK=?,@CustSocial_Type=?,@CustSocial_Id=?,@Answer_Chat=?,@Answer_Post=?,@ScreenType=?";
        $params     = [$this->Agent_Id
                        ,$this->Agent_Group_Id
                        ,$this->Agent_Id_PK
                        ,$this->CustSocial_Type
                        ,$this->CustSocial_Id
                        ,$this->Answer_Chat
                        ,$this->Answer_Post
                        ,'AddAll'];
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
     * @param Agent_Group_Id
     * @param Agent_Id_PK
     * @param CustSocial_Type
     * @param CustSocial_Id
     * @param Answer_Chat
     * @param Answer_Post
     */
    public function deleteall()
    {
        $this->db->transOff();
        $this->db->transBegin();
        $storedProc = "EXEC ADM2_AssignAgent_AssignLot @Agent_Id=?,@Agent_Group_Id=?,@Agent_Id_PK=?,@CustSocial_Type=?,@CustSocial_Id=?,@Answer_Chat=?,@Answer_Post=?,@ScreenType=?";
        $params     = [$this->Agent_Id
                        ,$this->Agent_Group_Id
                        ,$this->Agent_Id_PK
                        ,$this->CustSocial_Type
                        ,$this->CustSocial_Id
                        ,$this->Answer_Chat
                        ,$this->Answer_Post
                        ,'DelAll'];
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