<?php
namespace App\Models\TGDB\proc;
use CodeIgniter\Model;


class ARM_PDPA_Check extends Model
{
    protected $DBGroup = 'tgdb';

    public $CustSocial_Id;
    public $Ticket_Id;
 
    /**
     * @param CustSocial_Id
     * @param Ticket_Id
     */
    public function check()
    {
        $storedProc = "EXEC ARM_PDPA_Check  @CustSocial_Id= ?, @Ticket_Id= ?";
        $params     = [$this->CustSocial_Id,$this->Ticket_Id];
        $query      = $this->db->query($storedProc, $params);
        $results    = $query->getRowArray();
        return $results;      
    }
}