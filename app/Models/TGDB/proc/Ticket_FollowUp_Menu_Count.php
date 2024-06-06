<?php
namespace App\Models\TGDB\proc;
use CodeIgniter\Model;

/** แสดงจำนวนข้อความใหม่ของ FollowUp_Menu */
class Ticket_FollowUp_Menu_Count extends Model
{
	protected $DBGroup = 'tgdb';

	/** นับจำนวนข้อความใหม่ สำหรับเมนู */
    public function get_mesgnumber() {
        $P_Agent_Id = session()->get('agent')['agent_id'];
		$storedProc = "EXEC Ticket_FollowUp_Menu_Count @Agent_Id = ?";
		$params     = [$P_Agent_Id];
		$query      = $this->db->query($storedProc, $params);
		$results    = $query->getRowArray();  
		return $results['Total_Job'];
		
	}
}