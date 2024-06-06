<?php
namespace App\Models\TGDB\proc;
use CodeIgniter\Model;

/** แสดง ticket ประวัติการสนทนา */
class Ticket_FollowUp_Menu_Assign extends Model
{
	protected $DBGroup = 'tgdb';
 
    public $Agent_Id ='';
    public $ScreenType ='ASSIGN';
    public $Follow_Id ='';
    public $Assign_Agent_Id ='';

    
    /**
     * @param  int Agent_Id
     * @param  int ScreenType
     * @param  int Follow_Id
     * @param  int Assign_Agent_Id
     */
    public function assign() {
		$storedProc = "EXEC Ticket_FollowUp_Menu_Assign @Agent_Id=?,@ScreenType=?,@Follow_Id=?,@Assign_Agent_Id=?";
		$params     = [$this->Agent_Id,
                        $this->ScreenType,
                        $this->Follow_Id,
                        $this->Assign_Agent_Id];
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