<?php
namespace App\Models\TGDB\proc;
use CodeIgniter\Model;

/** แสดงจำนวนข้อความใหม่ของ FollowUp_Menu */
class Message_PopUpBySocial extends Model
{
	protected $DBGroup = 'tgdb';

    public function get($Social='',$limit=1)
     {   
		$storedProc = "exec Message_PopUpBySocial @Social = ?,@limit = ?";
        $params     = [$Social,$limit];
		$query      = $this->db->query($storedProc, $params);
		$results    = $query->getResultArray();  
		// if(!empty($query) && $query->getNumRows()>0){
		// 	$results    = $query->getRowArray();
		// }else{
		// 	$results    = [];
		// }
		
        return $results;		
	}
}