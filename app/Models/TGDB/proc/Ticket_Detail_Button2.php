<?php
namespace App\Models\TGDB\proc;
use CodeIgniter\Model;

/** ข้อความการสนทนา */
class Ticket_Detail_Button2 extends Model
{
	protected $DBGroup = 'tgdb';
    public $agent_id = '';
    public $ticket_id = '';

    public function get()
     {  
    	$storedProc = "EXEC Ticket_Detail_Button2 @Agent_id = ?, @ticket_id = ?";
		$params     = [$this->agent_id, $this->ticket_id];
		$query      = $this->db->query($storedProc, $params);
		$results    = $query->getResultArray(); 
        $this->agent_id = '';
        $this->ticket_id = '';
        unset($storedProc,$params,$query); 
		return $results;
	}
}