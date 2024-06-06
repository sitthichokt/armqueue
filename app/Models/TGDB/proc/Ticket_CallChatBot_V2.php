<?php
namespace App\Models\TGDB\proc;
use CodeIgniter\Model;


class Ticket_CallChatBot_V2 extends Model
{
    protected $DBGroup = 'tgdb';

    public $Ticket_Id;
    public $Ticket_Detail_Id;

    /**
     * @param Ticket_Id
     * @param Ticket_Detail_Id
     */
    public function get()
    {
        $storedProc = "EXEC Ticket_CallChatBot_V2  @P_Ticket_Id= ? ,@P_Ticket_Detail_Id= ?";
        $params     = [$this->Ticket_Id
                     ,$this->Ticket_Detail_Id];
        $query      = $this->db->query($storedProc, $params);
        $results    = $query->getRowArray();
        return $results;      
    }
}