<?php
namespace App\Models\TGDB\proc;
use CodeIgniter\Model;

class Ticket_QC_Menu_New extends Model
{
	protected $DBGroup = 'tgdb';
    public int $LoginAgent_Id;
    public $P_Ticket_No;
    public $P_ScreenType='SHOW';

    /**
     *  @param int LoginAgent_Id
     *  @param varchar P_Ticket_No
     *  @param varchar P_ScreenType SHOW
     */
    
    public function get()
     {         
    	$storedProc = "EXEC Ticket_QC_Menu_New   @LoginAgent_Id= ?, @P_Ticket_No= ?, @P_ScreenType= ?";
		$params     = [$this->LoginAgent_Id
                    ,$this->P_Ticket_No
                    ,$this->P_ScreenType];
		$query      = $this->db->query($storedProc, $params);
		$results    = $query->getRowArray(); 
        unset($storedProc,$params,$query); 
		return $results;
	}
}