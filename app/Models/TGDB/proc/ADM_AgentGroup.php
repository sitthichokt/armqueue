<?php

namespace App\Models\TGDB\proc;

use CodeIgniter\Model;

/** ## select 
 * - list
*/
class ADM_AgentGroup extends Model
{
    protected $DBGroup = 'tgdb';

    public int $Agent_Id;
    public $Agroup_Id='';
    /**
     * @param int Agent_Id
     * @param string Agroup_Id
     */
    public function list()
    {
        $storedProc = "EXEC ADM_AgentGroup  @Agent_Id= ?, @Agroup_Id= ?";
        $params     = [$this->Agent_Id,$this->Agroup_Id];
        $query      = $this->db->query($storedProc, $params);
        $results    = $query->getResultArray();
        return $results;
        
    }
}