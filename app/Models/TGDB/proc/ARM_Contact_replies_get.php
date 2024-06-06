<?php
namespace App\Models\TGDB\proc;
use CodeIgniter\Model;


class ARM_Contact_replies_get extends Model
{
    protected $DBGroup = 'tgdb';
    public $CustUser_Id;
    public $CustSocial_Id;
    public $Ticket_Id;

    /**
     * @param int CustUser_Id
     * @param int CustSocial_Id
     * @param int Ticket_Id
     */
    public function get()
    {         
        $storedProc = "EXEC ARM_Contact_replies_get @CustUser_Id=?,@CustSocial_Id=?,@Ticket_Id=?";
        $params     = [$this->CustUser_Id, $this->CustSocial_Id, $this->Ticket_Id];
        $query      = $this->db->query($storedProc, $params);
        $results    = $query->getResultArray();
        return $results;      
    }
}