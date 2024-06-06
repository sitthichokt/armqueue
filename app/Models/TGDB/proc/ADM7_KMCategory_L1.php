<?php

namespace App\Models\TGDB\proc;

use CodeIgniter\Model;

class ADM7_KMCategory_L1 extends Model
{
    protected $DBGroup = 'tgdb';

    public $Agent_Id;
    public $ScreenType ='List';
    public $KM_Lv1_Stat=1;
   
    /**
     * @param Agent_Id
     * @param ScreenType
     * @param KM_Lv1_Stat
     */
    public function list()
    {
        $storedProc = "EXEC ADM7_KMCategory_L1  @Agent_Id= ?,@ScreenType= ?,@KM_Lv1_Stat= ?";
        $params     = [$this->Agent_Id,
                            $this->ScreenType,
                            $this->KM_Lv1_Stat];
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