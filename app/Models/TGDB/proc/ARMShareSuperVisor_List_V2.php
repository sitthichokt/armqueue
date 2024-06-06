<?php
namespace App\Models\TGDB\proc;
use CodeIgniter\Model;


class ARMShareSuperVisor_List_V2 extends Model
{
    protected $DBGroup = 'tgdb';
  
    public $Agent_Id;
    public $CaseCreate_from;
    public $CaseCreate_to;
    public $Case_Status;
    public $SearchAll;
    public $Ticket_No;
    
    /**
     * @param Agent_Id
     * @param CaseCreate_from
     * @param CaseCreate_to
     * @param Case_Status
     * @param SearchAll
     * @param Ticket_No
     */

    public function get()
    {         
        $storedProc = "EXEC ARMShareSuperVisor_List_V2   @Agent_Id= ?,@CaseCreate_from= ?,@CaseCreate_to= ?,@Case_Status= ?,@SearchAll= ?,@Ticket_No= ?";
        $params     = [$this->Agent_Id,
                        $this->CaseCreate_from,
                        $this->CaseCreate_to,
                        $this->Case_Status,
                        $this->SearchAll,
                        $this->Ticket_No];
        $query      = $this->db->query($storedProc, $params);
        $results    = $query->getResultArray();
        return $results;      
    }
}