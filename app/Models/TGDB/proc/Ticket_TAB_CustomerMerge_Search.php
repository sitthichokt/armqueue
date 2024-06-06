<?php
namespace App\Models\TGDB\proc;
use CodeIgniter\Model;


class Ticket_TAB_CustomerMerge_Search extends Model
{
	protected $DBGroup = 'tgdb';
    public $Agent_Id      = '';
    public $Search_Group  = '';
    public $Search_Text   = '';

    /** 
     * @param Agent_Id
     * @param Search_Group
     * @param Search_Text
     */
    public function get() {
		$storedProc = "EXEC Ticket_TAB_CustomerMerge_Search @Agent_Id=?,@Search_Group=?,@Search_Text=?";
		$params     = [$this->Agent_Id,
                        $this->Search_Group,
                        $this->Search_Text];
		$query      = $this->db->query($storedProc, $params);
		$results    = $query->getResultArray();  
		return $results;		
	}
}