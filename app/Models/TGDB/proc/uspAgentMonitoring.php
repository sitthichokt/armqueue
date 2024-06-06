<?php
namespace App\Models\TGDB\proc;
use CodeIgniter\Model;

/**  */
class uspAgentMonitoring extends Model
{
	protected $DBGroup = 'tgdb';
    public $arcut_id;
    public $agroup_id;

    public function get() {
		$storedProc = "EXEC uspAgentMonitoring @ARCust_Id=?, @AGroup_Id=?";
		$params     = [$this->arcut_id,$this->agroup_id];
		$query      = $this->db->query($storedProc, $params);
		$results    = $query->getResultArray();  
		return $results;		
	}
}