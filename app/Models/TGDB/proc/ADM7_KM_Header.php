<?php

namespace App\Models\TGDB\proc;

use CodeIgniter\Model;

class ADM7_KM_Header extends Model
{
    protected $DBGroup = 'tgdb';
    public $Agent_Id       = '';
    public $ScreenType     = 'List';
    public $KM_Lv1_Id      = '';
    public $KM_Lv2_Id      = '';
    public $KM_Lv3_Id      = '';
    public $KM_Header_Stat = '';

    /**
     * @param Agent_Id
     * @param KM_Lv1_Id
     * @param KM_Lv2_Id
     * @param KM_Lv3_Id
     * @param KM_Header_Stat
     */
    public function list()
    {
        $storedProc = "EXEC ADM7_KM_Header @Agent_Id=?,@ScreenType=?,@KM_Lv1_Id=?,@KM_Lv2_Id=?,@KM_Lv3_Id=?,@KM_Header_Stat=?";
        $params     = [$this->Agent_Id,
                        $this->ScreenType,
                        $this->KM_Lv1_Id,
                        $this->KM_Lv2_Id,
                        $this->KM_Lv3_Id,
                        $this->KM_Header_Stat];
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