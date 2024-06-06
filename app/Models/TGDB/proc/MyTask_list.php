<?php

namespace App\Models\TGDB\proc;
use CodeIgniter\Model;

class MyTask_list extends Model
{
    protected $DBGroup = 'tgdb';

    public function get_mytask_list($Agent_Id, $start, $length, $P_Search) {
        $storedProc = "EXEC MyTask_list2 @Agent_Id = ?, @start = ?, @length = ?, @P_Search = ?";
        $params     = [	  $Agent_Id
						, $start
						, $length
						, $P_Search];
		$query      = $this->db->query($storedProc, $params);
		if(!empty($query) && $query->getNumRows()>0){
			$data			= $query->getNextRowArray(0); 
			$data['table']  = $query->getNextRowArray(1); 
		}else{
			$data=['totalrows'=>0,'table'=>[]];
		}
		
		return $data;

        // unset($storedProc, $params, $Agent_Id, $start, $length, $P_Search);

        // if ($this->db->transStatus() === false) {
        //     //$this->db->transRollback();
		// 	//$this->db->close();	
		// 	return false;
		// } else {
        //     $results = $query->getResultArray();  
		// 	$this->db->transCommit(); 
		// 	//$this->db->close();
		// 	unset($query);	
		// 	return $results;
		// }
	}
}