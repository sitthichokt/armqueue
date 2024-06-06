<?php

namespace App\Models\TGDB\proc;

use CodeIgniter\Model;

/** ## ข้อความที่บันทึกไว้ */
class ARM_IVR_Check_test extends Model
{
    protected $DBGroup = 'tgdb';

    public $Ticket_Id;

    /**
     * @param int Ticket_Id
     */
    public function check()
    {
        $storedProc = "EXEC ARM_IVR_Check_test  @Ticket_Id= ?";
        $params     = [$this->Ticket_Id];
        $query      = $this->db->query($storedProc, $params);
        $results    = $query->getRowArray();
        return $results;
        
    }
}