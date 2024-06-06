<?php

namespace App\Models\TGDB\proc;

use CodeIgniter\Model;

/** ## ข้อความที่บันทึกไว้ */
class ADM_SocilaType extends Model
{
    protected $DBGroup = 'tgdb';

    public $Agent_Id;

    /**
     * @param Agent_Id
     */
    public function list()
    {
        $storedProc = "EXEC ADM_SocilaType  @Agent_Id= ?";
        $params     = [$this->Agent_Id];
        $query      = $this->db->query($storedProc, $params);
        $results    = $query->getResultArray();
        return $results;
        
    }
}