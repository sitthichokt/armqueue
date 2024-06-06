<?php
namespace App\Models\TGDB\proc;
use CodeIgniter\Model;


class SupervisorAssignAgent extends Model
{
    protected $DBGroup = 'tgdb';

    public $AGroup_Id;
    public $Agent_Id;
    public $Ticket_Id;
 
    /**
     * @param AGroup_Id
     * @param Agent_Id
     * @param Ticket_Id
     */
    public function Assign()
    {
        $this->db->transOff();
        $this->db->transBegin();
        $storedProc = "EXEC SupervisorAssignAgent  @AGroup_Id= ?, @Agent_Id= ?, @Ticket_Id= ?";
        $params     = [$this->AGroup_Id,$this->Agent_Id,$this->Ticket_Id];
        $query      = $this->db->query($storedProc, $params);
        $results    = $query->getResultArray();
    
        if ($this->db->transStatus() === false) {
            //$this->db->transRollback();
            //$this->db->close();
            $data['message'] = 'เกิดข้อผิดพลาด ไม่สามารถนำเข้าข้อมูล Ticket_PopUp ได้';
            $data['status']  = false;
        } else {
            $this->db->transCommit();
            //$this->db->close();
            $data['message'] = $results;
            $data['status']  = true;
        } 
        return $results;   
    }
}