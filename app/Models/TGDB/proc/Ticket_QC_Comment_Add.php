<?php
namespace App\Models\TGDB\proc;
use CodeIgniter\Model;


class Ticket_QC_Comment_Add extends Model
{
	protected $DBGroup = 'tgdb';
   
    public $ch;
    public $QC_Id;
    public $QC_Supervisor;
    public $QC_By;
    public $QCComment_Id='';
    public $Accept='';
    public $QC_Agent='';
   
    public function add()
     {         
    	$storedProc = "EXEC Ticket_QC_Comment_Add @ch= ?, @QC_Id= ?, @QC_Supervisor= ?, @QC_By= ?, @QCComment_Id= ?, @Accept= ?, @QC_Agent= ?";
		$params     = [ $this->ch
                        ,$this->QC_Id
                        ,$this->QC_Supervisor
                        ,$this->QC_By
                        ,$this->QCComment_Id
                        ,$this->Accept
                        ,$this->QC_Agent];
		$query      = $this->db->query($storedProc, $params);
		$results    = $query->getResultArray(); 
        unset($storedProc,$params,$query); 
		return $results;
	}
}