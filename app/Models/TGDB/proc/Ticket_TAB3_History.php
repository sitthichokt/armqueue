<?php
namespace App\Models\TGDB\proc;
use CodeIgniter\Model;

/** แสดง ticket ประวัติการสนทนา */
class Ticket_TAB3_History extends Model
{
	protected $DBGroup = 'tgdb';
    public $arcut_id;
    public $custuser_id;

    public function get() {
		$storedProc = "EXEC Ticket_TAB3_History @CustUser_Id=?, @ARCust_Id=?";
		$params     = [$this->custuser_id,$this->arcut_id];
		$query      = $this->db->query($storedProc, $params);
		$results    = $query->getResultArray();  
		return $results;		
	}
}