<?php
namespace App\Models\TGDB\proc;
use CodeIgniter\Model;

/** แสดงจำนวนข้อความใหม่ของ FollowUp_Menu */
class Message_PopUp extends Model
{
	protected $DBGroup = 'tgdb';

    public function get()
     {   
		// $this->db->reconnect(); 
		$storedProc = "exec Message_PopUp";
		$query      = $this->db->query($storedProc);
		if(!empty($query) && $query->getNumRows()>0){
			// $results    = $query->getResultArray(); 
			$results    = $query->getRowArray();
		}else{
			$results    = [];
		}
		
        return $results;		
	}
}