<?php

namespace App\Models\TGDB\proc;

use CodeIgniter\Model;

class ARM_IVR_AssignGroup extends Model
{
    protected $DBGroup = 'tgdb';
    public $AGroup_Id = '';
    public $Ticket_Id = '';

    /**
     * @param AGroup_Id
     * @param Ticket_Id
     */
    public function Assign()
    {
        $this->db->transOff();
        $this->db->transBegin();
        $storedProc = "EXEC ARM_IVR_AssignGroup  @AGroup_Id=?,@Ticket_Id=?";
        $params     = [$this->AGroup_Id,
                        $this->Ticket_Id];
        $query  = $this->db->query($storedProc, $params);
        $results    = $query->getRowArray();
        if ($this->db->transStatus() === false) {
            //$this->db->transRollback();
            return false;
        } else {		
            $this->db->transCommit();        
            unset($query);	
            return $results;
        }
    }

  
}