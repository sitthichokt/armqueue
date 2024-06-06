<?php
namespace App\Models\TGDB\proc;
use CodeIgniter\Model;

class Ticket_QC_Menu_List extends Model
{
	protected $DBGroup = 'tgdb';
    public int $LoginAgent_Id;
    public $AGroup_Id='';
    public $Create_Date_From='';
    public $Create_Date_To='';
    public $QC_Status='';
    public $SearchAgent_Id='';
    public $SearchTicket_No='';
   
    /** 
    * @param int LoginAgent_Id
    * @param int AGroup_Id
    * @param datetime Create_Date_Fro
    * @param datetime Create_Date_To
    * @param varchar QC_Status
    * @param int SearchAgent_Id
    * @param varchar SearchTicket_No
    * */
    public function get()
     {         
    	$storedProc = "EXEC Ticket_QC_Menu_List @LoginAgent_Id= ?, @AGroup_Id= ?, @Create_Date_From= ?, @Create_Date_To= ?, @QC_Status= ?, @SearchAgent_Id= ?, @SearchTicket_No= ?";
		$params     = [$this->LoginAgent_Id,
                        $this->AGroup_Id,
                        $this->Create_Date_From,
                        $this->Create_Date_To,
                        $this->QC_Status,
                        $this->SearchAgent_Id,
                        $this->SearchTicket_No,];
		$query      = $this->db->query($storedProc, $params);
		$results    = $query->getResultArray(); 
        unset($storedProc,$params,$query); 
		return $results;
	}
}