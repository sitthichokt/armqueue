<?php
namespace App\Models\TGDB\proc;
use CodeIgniter\Model;

/** ตาราง FollowUp_Menu */
class Ticket_FollowUp_Datatable extends Model
{
	protected $DBGroup = 'tgdb';
   
    public function get($P_start,$P_length,$P_Search) {
        $P_Agent_Id = session()->get('agent')['agent_id'];
		$storedProc = "EXEC Ticket_FollowUp_Datatable @Agent_Id = ?,@start = ?,@length = ?,@P_Search = ?";
		$params     = [ $P_Agent_Id
                        ,$P_start
                        ,$P_length
						,$P_Search];
		$query      = $this->db->query($storedProc, $params);
		$data			= $query->getNextRowArray(0); 
		$data['table']  = $query->getNextRowArray(1); 
		return $data;
	}
}