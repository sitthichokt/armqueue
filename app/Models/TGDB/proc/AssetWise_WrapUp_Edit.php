<?php

namespace App\Models\TGDB\proc;

use CodeIgniter\Model;

/** ## get id type  CaseType,subtype1,subtype2*/
class AssetWise_WrapUp_Edit extends Model
{
    protected $DBGroup = 'tgdb';

    public $ASW_WrapUp_Id;

    /**
     * @param ASW_WrapUp_Id
     */
    public function get()
    {
        $storedProc = "EXEC AssetWise_WrapUp_Edit  @ASW_WrapUp_Id= ?";
        $params     = [$this->ASW_WrapUp_Id];
        $query      = $this->db->query($storedProc, $params);
        $results    = $query->getRowArray();
        return $results;
        
    }
}