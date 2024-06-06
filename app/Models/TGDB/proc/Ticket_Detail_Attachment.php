<?php
namespace App\Models\TGDB\proc;
use CodeIgniter\Model;

/** ข้อความการสนทนา */
class Ticket_Detail_Attachment extends Model
{
	protected $DBGroup = 'tgdb';
    public $ScreenType;
    public $Ticket_Id;
    public $TicketSocial_Id = '';

    public function get()
    {  
    	$storedProc = "EXEC Ticket_Detail_Attachment @ScreenType=?, @Ticket_Id=?, @TicketSocial_Id=?";
		$params     = [$this->ScreenType, $this->Ticket_Id, $this->TicketSocial_Id];
		$query      = $this->db->query($storedProc, $params);
		$results    = $query->getResultArray();
        unset($storedProc,$params,$query); 
		return $results;
	}
}