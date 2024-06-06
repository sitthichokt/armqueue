<?php

namespace App\Models\TGDB\proc;

use CodeIgniter\Model;


class ADM3_SurveyMessage extends Model
{
    protected $DBGroup = 'tgdb';
    public $Agent_Id        = '';

    /**
     * @param Agent_Id
     */
    public function get()
    {
        $storedProc = "EXEC ADM3_SurveyMessage @Agent_Id=?";
        $params     = [$this->Agent_Id];
        $query      = $this->db->query($storedProc, $params);
        $results    = $query->getRowArray();
        return $results;
    }
}