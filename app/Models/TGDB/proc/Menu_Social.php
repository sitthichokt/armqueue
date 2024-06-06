<?php
namespace App\Models\TGDB\proc;
use CodeIgniter\Model;

/** แสดงจำนวนข้อความใหม่ของ FollowUp_Menu */
class Menu_Social extends Model
{
	protected $DBGroup = 'tgdb';

	/** นับจำนวนข้อความใหม่ สำหรับเมนู */
    public function get() {
        $P_Agent_Id = session()->get('agent')['agent_id'];
		$storedProc = "EXEC Menu_Social @Agent_Id = ?";
		$params     = [$P_Agent_Id];
		$query      = $this->db->query($storedProc, $params);
		$results    = $query->getResultArray();  
		return $results;
		
	}
}