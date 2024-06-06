<?php
namespace App\Models\TGDB\proc;
use CodeIgniter\Model;

/** แสดงประวัติ pdpa */
class Ticket_TAB3_History_PDPA extends Model
{
	protected $DBGroup = 'tgdb';
    public $custuser_id;
    public $arcut_id;

    public function get() {
		$storedProc = "EXEC Ticket_TAB3_History_PDPA @CustUser_Id=?, @ARCust_Id=?";
		$params     = [$this->custuser_id,$this->arcut_id];
		$query      = $this->db->query($storedProc, $params);
		$results    = $query->getResultArray();  
		return $results;		
	}
}