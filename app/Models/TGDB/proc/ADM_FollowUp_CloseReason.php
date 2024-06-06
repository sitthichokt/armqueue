<?php

namespace App\Models\TGDB\proc;

use CodeIgniter\Model;

/** ## select list Follow Up Type reminder 
 * - list
*/
class ADM_FollowUp_CloseReason extends Model
{
    protected $DBGroup = 'tgdb';

    public int $Agent_Id;
    /**
     * @param int Agent_Id
     */
    public function list()
    {
        $storedProc = "EXEC ADM_FollowUp_CloseReason  @Agent_Id= ?";
        $params     = [$this->Agent_Id];
        $query      = $this->db->query($storedProc, $params);
        $results    = $query->getResultArray();
        return $results;
        
    }
}