<?php
namespace App\Models\TGDB\proc;
use CodeIgniter\Model;

/** แสดงจำนวนข้อความใหม่ของ FollowUp_Menu */
class Message_PopUpBySocial_Count extends Model
{
	protected $DBGroup = 'tgdb';

    public function get($Social='')
     {   

        $storedProc = "EXEC Message_PopUpBySocial_Count @Social = ?";
        $params     = [$Social];
        $query      = $this->db->query($storedProc, $params);
        $results    = $query->getResultArray();  
        return $results;
            
     	
	}
}