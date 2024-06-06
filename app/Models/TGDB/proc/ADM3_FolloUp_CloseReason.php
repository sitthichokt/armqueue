<?php

namespace App\Models\TGDB\proc;

use CodeIgniter\Model;


class ADM3_FolloUp_CloseReason extends Model
{
    protected $DBGroup = 'tgdb';
    public $Agent_Id        = '';
    public $FollowUp        = '';
    public $FollowUp_Status = '';
    public $ScreenType      = 'List';

    /**
     * @param Agent_Id
     * @param FollowUp
     * @param FollowUp_Status
     */
    public function get()
    {
        $storedProc = "EXEC ADM3_FolloUp_CloseReason @Agent_Id=?,@FollowUp=?,@FollowUp_Status=?,@ScreenType=?";
        $params     = [$this->Agent_Id,
                        $this->FollowUp,
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