<?php
namespace App\Models\TGDB\proc;
use CodeIgniter\Model;


class Ticket_CallChatBot extends Model
{
    protected $DBGroup = 'tgdb';

    public $P_Ticket_Id;
    public $P_Ticket_Detail_Id ;

    /**
     * @param P_Ticket_Id
     * @param P_Ticket_Detail_Id
     */
    public function get()
    {
        $storedProc = "EXEC Ticket_CallChatBot  @P_Ticket_Id= ?,@P_Ticket_Detail_Id= ?";
        $params     = [$this->P_Ticket_Id
                     ,$this->P_Ticket_Detail_Id];
        $query      = $this->db->query($storedProc, $params);
        $results    = $query->getRowArray();
        return $results;      
    }
}