<?php

namespace App\Models\TGDB\proc;

use CodeIgniter\Model;

/** ## select 
 * - list
*/
class ADM_ARTableLookup extends Model
{
    protected $DBGroup = 'tgdb';
    public $LookupGroup;


    /**
     * @param LookupGroup
     */
    public function list()
    {
        $storedProc = "EXEC ADM_ARTableLookup  @LookupGroup=?";
        $params     = [$this->LookupGroup];
        $query      = $this->db->query($storedProc, $params);
        $results    = $query->getResultArray();
        return $results;
        
    }
}