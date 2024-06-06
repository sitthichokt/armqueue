<?php
namespace App\Models\TGDB\proc;
use CodeIgniter\Model;

/**  */
class uspAgentMonitoring_use extends Model
{
	protected $DBGroup = 'tgdb';
    public $arcut_id;

    public function get() {
		$storedProc = "EXEC uspAgentMonitoring_use @ARCust_Id=?";
		$params     = [$this->arcut_id];
		$query      = $this->db->query($storedProc, $params);
		$results    = $query->getResultArray();  
		return $results;		
	}
}