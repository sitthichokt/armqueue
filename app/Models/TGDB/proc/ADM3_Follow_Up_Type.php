<?php

namespace App\Models\TGDB\proc;

use CodeIgniter\Model;


class ADM3_Follow_Up_Type extends Model
{
    protected $DBGroup = 'tgdb';
    public $Agent_Id          = '';
    public $FollowUp_Status   = '';
    public $ScreenType        = 'List';

    /**
     * @param Agent_Id
     * @param FollowUp_Status
     * @param ScreenType
     */
    public function get()
    {
        $storedProc = "EXEC ADM3_Follow_Up_Type  @Agent_Id=?,@FollowUp_Status=?,@ScreenType=?";
        $params     = [$this->Agent_Id,
                        $this->FollowUp_Status,
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