<?php

namespace App\Models\TGDB\proc;

use CodeIgniter\Model;

class ADM2_AgentProfile extends Model
{
    protected $DBGroup = 'tgdb';
    public $Agent_Id='';
    public $AGroup_Id='';
    public $Agent_Name='';
    public $Agent_Status='';
    public $ScreenType='List';




    /**
     * @param Agent_Id
     * @param AGroup_Id
     * @param Agent_Name
     * @param Agent_Status
     * @param ScreenType 
     */
    public function get()
    {
        $storedProc = "EXEC ADM2_AgentProfile @Agent_Id=?,@AGroup_Id=?,@Agent_Name=?,@Agent_Status=?,@ScreenType=?";
        $params     = [$this->Agent_Id,
                        $this->AGroup_Id,
                        $this->Agent_Name,
                        $this->Agent_Status,
                        $this->ScreenType];
        $query      = $this->db->query($storedProc, $params); 
        if($this->ScreenType==='Excel'){
            $results['head'] = $query->getFieldNames();
            $results['body'] = $query->getResultArray(); 
        }else{
            $results    = $query->getResultArray();
        }
        return $results;  
    }

}