<?php
namespace App\Models\TGDB\proc;
use CodeIgniter\Model;


class Ticket_QC_Choice_Value extends Model
{
	protected $DBGroup = 'tgdb';
    public $QNO_ID = '';

    public function get()
     {         
    	$storedProc = "EXEC Ticket_QC_Choice_Value @QNO_ID = ?";
		$params     = [$this->QNO_ID];
		$query      = $this->db->query($storedProc, $params);
		$results    = $query->getResultArray(); 
        unset($storedProc,$params,$query); 
		return $results;
	}
}