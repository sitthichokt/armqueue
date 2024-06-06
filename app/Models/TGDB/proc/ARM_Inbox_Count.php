<?php

namespace App\Models\TGDB\proc;
use CodeIgniter\Model;

class ARM_Inbox_Count extends Model
{
    protected $DBGroup = 'tgdb';

    public function get($Agent_Id, $CustSocial_Id, $InboxType) {
        $storedProc = "EXEC ARM_Inbox_Count @Agent_Id=?, @CustSocial_Id=?, @InboxType=?";
        $params     = [	  $Agent_Id
						, $CustSocial_Id
						, $InboxType];
		$query      = $this->db->query($storedProc, $params);
		$results    = $query->getResultArray(); 
		$num = !empty($results)?$results[0]['']:0;
        unset($storedProc, $params, $Agent_Id, $CustSocial_Id, $InboxType,$query);
		
        return $num;
	}
}