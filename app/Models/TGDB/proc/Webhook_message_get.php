<?php
namespace App\Models\TGDB\proc;
use CodeIgniter\Model;

/**  */
class Webhook_message_get extends Model
{
	protected $DBGroup = 'tgdb';
    public $ScreenType;

    /**
     * @param string ScreenType Facebook,Line,Instagram,Twitter
     */
    public function get() {
		$storedProc = "EXEC Webhook_message_get @ScreenType=?";
		$params     = [$this->ScreenType];
		$query      = $this->db->query($storedProc, $params);
		// $results    = $query->getRowArray();  
		$results    = $query->getResultArray();  
		return $results;		
	}
}