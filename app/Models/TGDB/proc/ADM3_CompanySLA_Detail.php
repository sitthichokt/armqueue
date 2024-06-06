<?php

namespace App\Models\TGDB\proc;

use CodeIgniter\Model;


class ADM3_CompanySLA_Detail extends Model
{
    protected $DBGroup = 'tgdb';
    public $Agent_id;

    /**
     * @param Agent_id
     */
    public function get()
    {
        $storedProc = "EXEC ADM3_CompanySLA_Detail  @Agent_id= ?";
        $params     = [$this->Agent_id];
        $query      = $this->db->query($storedProc, $params);
        $results    = $query->getRowArray();
        return $results;
        
    }
}