<?php
namespace App\Models\TGDB\proc;
use CodeIgniter\Model;

/** ประวัติข้อความการสนทนา */
class Ticket_History_Button extends Model
{
	protected $DBGroup = 'tgdb';
    public $ticket_id = '';
	public $limit = '';

    public function get()
     {         
    	$storedProc = "EXEC Ticket_History_Button @ticket_id = ?, @limit = ?";
		$params     = [$this->ticket_id, $this->limit];
		$query      = $this->db->query($storedProc, $params);
		$results    = $query->getResultArray(); 
        $this->ticket_id = '';
        unset($storedProc,$params,$query); 
		return $results;
	}
}