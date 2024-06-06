<?php
namespace App\Models\TGDB\proc;
use CodeIgniter\Model;


class SupervisorListAgent_Page extends Model
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
        $storedProc = "EXEC SupervisorListAgent_Page  @Ticket_Id= ?, @AGroup_Id= ?, @CustSocial_Group= ?, @CustSocial_Id= ?";
        $params     = [  $this->Ticket_Id
                        ,$this->AGroup_Id
                        ,$this->CustSocial_Group
                        ,$this->CustSocial_Id];
        $query      = $this->db->query($storedProc, $params);
        $results    = $query->getResultArray();
        return $results;      
    }
}