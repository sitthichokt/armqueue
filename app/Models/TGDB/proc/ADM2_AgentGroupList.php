<?php

namespace App\Models\TGDB\proc;

use CodeIgniter\Model;

/** ## select 
 * - list
*/
class ADM2_AgentGroupList extends Model
{
    protected $DBGroup = 'tgdb';
    public $Agent_Id='';
    public $Agent_Role='';
    public $ScreenType='';

    /**
     * @param Agent_Id
     * @param Agent_Role
     * @param ScreenType
     */
    public function get()
    {
        $storedProc = "EXEC ADM2_AgentGroupList @Agent_Id=?,@Agent_Role=?,@ScreenType=?";
        $params     = [$this->Agent_Id,
                        $this->Agent_Role,
                        $this->ScreenType];
        $query      = $this->db->query($storedProc, $params);
        $results    = $query->getResultArray();

        if($this->ScreenType==='Excel'){
            $results['head'] = $query->getFieldNames();
            $results['body'] = $query->getResultArray(); 
        }else{
            $results    = $query->getResultArray();
        }

        return $results;
        
    }
}