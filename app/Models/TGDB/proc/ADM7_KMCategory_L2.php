<?php

namespace App\Models\TGDB\proc;

use CodeIgniter\Model;

/** ## ข้อความที่บันทึกไว้ */
class ADM7_KMCategory_L2 extends Model
{
    protected $DBGroup = 'tgdb';

    public $Agent_Id;
    public $ScreenType ='List';
    public $KM_Lv1_Id ='';
    public $KM_Lv2_Stat=1;
   
    /**
     * @param Agent_Id
     * @param ScreenType
     * @param KM_Lv1_Id
     * @param KM_Lv2_Stat
     */
    public function list()
    {
        $storedProc = "EXEC ADM7_KMCategory_L2  @Agent_Id= ?, @ScreenType= ?, @KM_Lv1_Id= ?, @KM_Lv2_Stat= ?";
        $params     = [
            $this->Agent_Id,
            $this->ScreenType,
            $this->KM_Lv1_Id,
            $this->KM_Lv2_Stat,
        ];
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