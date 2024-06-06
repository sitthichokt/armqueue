<?php

namespace App\Models\TGDB\proc;

use CodeIgniter\Model;

class ADM7_KM_Content extends Model
{
    protected $DBGroup = 'tgdb';
    public $Agent_Id        = '';
    public $ScreenType      = 'List';
    public $KM_LV1          = '';
    public $KM_LV2          = '';
    public $KM_LV3          = '';
    public $KM_Content_Stat = '';

    /**
     * @param Agent_Id
     * @param ScreenType
     * @param KM_LV1
     * @param KM_LV2
     * @param KM_LV3
     * @param KM_Content_Stat
     */
    public function list()
    {
        $storedProc = "EXEC ADM7_KM_Content @Agent_Id=?,@ScreenType=?,@KM_LV1=?,@KM_LV2=?,@KM_LV3=?,@KM_Content_Stat=?";
        $params     = [$this->Agent_Id,
                        $this->ScreenType,
                        $this->KM_LV1,
                        $this->KM_LV2,
                        $this->KM_LV3,
                        $this->KM_Content_Stat];
        $query      = $this->db->query($storedProc, $params);
        if($this->ScreenType==='Excel'){
            $results['head'] = $query->getFieldNames();
            $results['body'] = $query->getResultArray(); 
        }else{
            $results    = $query->getResultArray();
        }
        unset($query,$storedProc,$params);
        return $results;  

        
    }
}