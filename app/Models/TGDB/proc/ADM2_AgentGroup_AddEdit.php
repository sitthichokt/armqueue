<?php

namespace App\Models\TGDB\proc;

use CodeIgniter\Model;

/** ## select 
 * - list
*/
class ADM2_AgentGroup_AddEdit extends Model
{
    protected $DBGroup = 'tgdb';
    public $Agent_Id='';
    public $ScreenType='';
    public $AGroup_Id='';
    public $Group_Name='';
    public $Agent_Role='';
    public $Remark='';
    public $Send_Mail='';


    /**
     * @param Agent_Id
     * @param AGroup_Id
     */
    public function get()
    {
        $storedProc = "EXEC ADM2_AgentGroup_AddEdit @Agent_Id=?,@ScreenType=?,@AGroup_Id=?,@Group_Name=?,@Agent_Role=?,@Remark=?,@Send_Mail=?";
        $params     = [$this->Agent_Id,
                        'List',
                        $this->AGroup_Id,
                        $this->Group_Name,
                        $this->Agent_Role,
                        $this->Remark,
                        $this->Send_Mail];
        $query      = $this->db->query($storedProc, $params);
        $results    = $query->getRowArray();
        return $results;  
    }

    /**
     * @param Agent_Id
     * @param Group_Name
     * @param Agent_Role
     * @param Remark
     * @param Send_Mail
     */
    public function add()
    {
        $this->db->transOff();
        $this->db->transBegin();
        $storedProc = "EXEC ADM2_AgentGroup_AddEdit @Agent_Id=?,@ScreenType=?,@AGroup_Id=?,@Group_Name=?,@Agent_Role=?,@Remark=?,@Send_Mail=?";
        $params     = [$this->Agent_Id,
                        'ADD',
                        $this->AGroup_Id,
                        $this->Group_Name,
                        $this->Agent_Role,
                        $this->Remark,
                        $this->Send_Mail];
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
     * @param AGroup_Id
     * @param Group_Name
     * @param Agent_Role
     * @param Remark
     * @param Send_Mail
     */
    public function edit()
    {
        $this->db->transOff();
        $this->db->transBegin();
        $storedProc = "EXEC ADM2_AgentGroup_AddEdit @Agent_Id=?,@ScreenType=?,@AGroup_Id=?,@Group_Name=?,@Agent_Role=?,@Remark=?,@Send_Mail=?";
        $params     = [$this->Agent_Id,
                        'EDIT',
                        $this->AGroup_Id,
                        $this->Group_Name,
                        $this->Agent_Role,
                        $this->Remark,
                        $this->Send_Mail];
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
     * @param int Agent_Id
     * @param int AGroup_Id
     */
    public function deletes()
    {
        $this->db->transOff();
        $this->db->transBegin();
        $storedProc = "EXEC ADM2_AgentGroup_AddEdit @Agent_Id=?,@ScreenType=?,@AGroup_Id=?,@Group_Name=?,@Agent_Role=?,@Remark=?,@Send_Mail=?";
        $params     = [$this->Agent_Id,
                        'DELETE',
                        $this->AGroup_Id,
                        $this->Group_Name,
                        $this->Agent_Role,
                        $this->Remark,
                        $this->Send_Mail];
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