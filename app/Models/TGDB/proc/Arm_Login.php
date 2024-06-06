<?php
namespace App\Models\TGDB\proc;
use CodeIgniter\Model;

class Arm_Login extends Model
{
	protected $DBGroup = 'tgdb';

    public function insert_arm_login($P_Agent_Id, $P_date, $P_ip, $P_device, $P_event) {

		$this->db->transOff();
		$this->db->transBegin();
		$storedProc = "EXEC Arm_Login @P_Agent_Id = ?, @P_date = ?, @P_ip = ?, @P_device = ?, @P_event = ?";
		$params     = [	  $P_Agent_Id
						, $P_date
						, $P_ip
						, $P_device
						, $P_event];
		$query      = $this->db->query($storedProc, $params);
		unset($storedProc,$params,$P_Agent_Id, $P_date, $P_ip, $P_device, $P_event);

		if ($this->db->transStatus() === false) {
			//$this->db->transRollback();
			//$this->db->close();	
			return false;
		} else {
			$results    = $query->getRowArray();  
			$this->db->transCommit();
			//$this->db->close();
			unset($query);	
			return $results['AgentLog_Id'];
		}
	}
}