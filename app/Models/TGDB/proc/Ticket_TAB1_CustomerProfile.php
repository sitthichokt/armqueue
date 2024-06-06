<?php
namespace App\Models\TGDB\proc;
use CodeIgniter\Model;

/** แสดงข้อมูลโปรไฟล์ของ คู่สนทนา */
class Ticket_TAB1_CustomerProfile extends Model
{
	protected $DBGroup = 'tgdb';
    public $custuser_id;
    public $arcut_id;


    public function get() {
		$storedProc = "EXEC Ticket_TAB1_CustomerProfile @CustUser_Id=?, @ARCust_Id=?";
		$params     = [$this->custuser_id,$this->arcut_id];
		$query      = $this->db->query($storedProc, $params);
		$results    = $query->getRowArray();  
		return $results;		
	}
}