<?php

namespace App\Models\TGDB\proc;

use CodeIgniter\Model;


class Admin_MenuList extends Model
{
    protected $DBGroup = 'tgdb';

    public $Agent_Id;
    /**
     * @param int Agent_Id
     */
    public function get()
    {
        $storedProc = "EXEC Admin_MenuList  @Agent_Id= ?";
        $params     = [$this->Agent_Id];
        $query      = $this->db->query($storedProc, $params);
        $results    = $query->getResultArray();
        return $results;
        
    }
}