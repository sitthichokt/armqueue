<?php

namespace App\Models\TGDB\proc;

use CodeIgniter\Model;

/** ## จัดการรายละเอียด ticket  REMINDER */
class Ticket_Follow_AddEdit extends Model
{
    protected $DBGroup = 'tgdb';

    public $Agent_Id    = '';
    public $ScreenType  = '';
    public $Follow_Id   = 0;
    public $Ticket_Id   = '';
    public $FType_Id    = 0;
    public $Follow_Date = '';
    public $Follow_Note = '';
    public $ASWProj_Id  = '';

    /** REMINDER แสดงข้อมูล 
     * @param int Ticket_Id 
     * @param int Follow_Id 
     */
    public function list()
    {
        $storedProc = "EXEC Ticket_Follow_AddEdit  @Agent_Id= ?, @ScreenType= ?, @Follow_Id= ?, @Ticket_Id= ?, @FType_Id= ?, @Follow_Date= ?, @Follow_Note= ?, @ASWProj_Id= ?";
        $params     = [
            session()->get('agent')['agent_id'],
            'LIST',
            $this->Follow_Id,
            $this->Ticket_Id,
            $this->FType_Id,
            $this->Follow_Date,
            $this->Follow_Note,
            $this->ASWProj_Id,
        ];
        $query      = $this->db->query($storedProc, $params);
        $results    = $query->getResultArray();
        return $results;
    }

    /** REMINDER เพิ่มใหม่
     * @param int Ticket_Id
     * @param int FType_Id    Follow Up Type
     * @param datetime Follow_Date Date Time
     * @param string Follow_Note Note
     * @param int ASWProj_Id  Project Name
     */
    public function add()
    {
        $this->db->transOff();
        $this->db->transBegin();
        $storedProc = "EXEC Ticket_Follow_AddEdit  @Agent_Id= ?, @ScreenType= ?, @Follow_Id= ?, @Ticket_Id= ?, @FType_Id= ?, @Follow_Date= ?, @Follow_Note= ?, @ASWProj_Id= ?";
        $params     = [
            session()->get('agent')['agent_id'],
            'ADD',
            $this->Follow_Id,
            $this->Ticket_Id,
            $this->FType_Id,
            $this->Follow_Date,
            $this->Follow_Note,
            $this->ASWProj_Id,
        ];
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

    /** REMINDER แก้ไข
     * @param int Follow_Id   pk Ticket_Follow
     * @param int FType_Id    Follow Up Type
     * @param datetime Follow_Date Date Time
     * @param string Follow_Note Note
     * @param int ASWProj_Id  Project Name
     */
    public function deit()
    {
        $this->db->transOff();
        $this->db->transBegin();
        $storedProc = "EXEC Ticket_Follow_AddEdit  @Agent_Id= ?, @ScreenType= ?, @Follow_Id= ?, @Ticket_Id= ?, @FType_Id= ?, @Follow_Date= ?, @Follow_Note= ?, @ASWProj_Id= ?";
        $params     = [
            session()->get('agent')['agent_id'],
            'EDIT',
            $this->Follow_Id,
            $this->Ticket_Id,
            $this->FType_Id,
            $this->Follow_Date,
            $this->Follow_Note,
            $this->ASWProj_Id,
        ];
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

    /** REMINDER ลบ
     * @param Follow_Id
     * @param Ticket_Id
     */
    public function del()
    {
        $this->db->transOff();
        $this->db->transBegin();
        $storedProc = "EXEC Ticket_Follow_AddEdit  @Agent_Id= ?, @ScreenType= ?, @Follow_Id= ?, @Ticket_Id= ?, @FType_Id= ?, @Follow_Date= ?, @Follow_Note= ?, @ASWProj_Id= ?";
        $params     = [
            session()->get('agent')['agent_id'],
            'DELETE',
            $this->Follow_Id,
            $this->Ticket_Id,
            $this->FType_Id,
            $this->Follow_Date,
            $this->Follow_Note,
            $this->ASWProj_Id,
        ];
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
