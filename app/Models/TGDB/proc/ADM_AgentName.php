<?php

namespace App\Models\TGDB\proc;

use CodeIgniter\Model;

/** ## select 
 * - list
*/
class ADM_AgentName extends Model
{
    protected $DBGroup = 'tgdb';

    public int $Agent_Id;
    public $Agroup_Id='';
    public $Agent_Id_E='';

    /**
     * @param int Agent_Id
     * @param int Agroup_Id
     * @param int Agent_Id_E
     */
    public function list()
    {
        $storedProc = "EXEC ADM_AgentName  @Agent_Id= ?, @Agroup_Id= ?, @Agent_Id_E= ?";
        $params     = [$this->Agent_Id,$this->Agroup_Id,$this->Agent_Id_E];
        $query      = $this->db->query($storedProc, $params);
        $results    = $query->getResultArray();
        return $results;
        
    }
}