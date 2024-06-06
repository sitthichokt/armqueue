<?php
namespace App\Models\TGDB\proc;
use CodeIgniter\Model;

/** แสดงข้อมูลของผู้ใช่งาน 
 * @param int SocialUserPro_Id
*/
class Ticket_TAB2_CustomerContact extends Model
{
	protected $DBGroup = 'tgdb';
    public $SocialUserPro_Id;
    public function get() {
		$storedProc = "EXEC Ticket_TAB2_CustomerContact @SocialUserPro_Id=?";
		$params     = [$this->SocialUserPro_Id];
		$query      = $this->db->query($storedProc, $params);
		$results    = $query->getResultArray();  
		return $results;		
	}
}