<?php
namespace App\Models\TGDB\proc;
use CodeIgniter\Model;


class SupervisorListAgent extends Model
{
    protected $DBGroup = 'tgdb';
    public $Ticket_Id;
    public $AGroup_Id;
    public $CustSocial_Group;
    public $CustSocial_Id;

    /**
     * @param Ticket_Id
     * @param AGroup_Id
     * @param CustSocial_Group
     * @param CustSocial_Id
     */
    public function list()
    {
        $storedProc = "EXEC SupervisorListAgent  @Ticket_Id= ?, @AGroup_Id= ?";
        $params     = [ $this->Ticket_Id,
                        $this->AGroup_Id];
        $query      = $this->db->query($storedProc, $params);
        $results    = $query->getResultArray();
        return $results;      
    }
}