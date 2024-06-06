<?php
namespace App\Models\TGDB\proc;
use CodeIgniter\Model;

/** เรียกข้อมูลการส่ง mail contacthistory*/
class Mail_WrapupForCustomPage extends Model
{
    protected $DBGroup = 'tgdb';

    public $Ticket_Id;
    public $ASW_WrapUp_Id;
 
    /**
     * @param int Ticket_Id
     * @param int ASW_WrapUp_Id  คืด pk from AssetWise_WrapUpTicket

     */
    public function get()
    {
        $storedProc = "EXEC Mail_WrapupForCustomPage  @Ticket_Id= ?, @ASW_WrapUp_Id= ?";
        $params     = [$this->Ticket_Id,$this->ASW_WrapUp_Id];
        $query      = $this->db->query($storedProc, $params);
        $results    = $query->getRowArray();
        return $results;
        
    }
}