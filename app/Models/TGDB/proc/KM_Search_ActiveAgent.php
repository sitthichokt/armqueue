<?php
namespace App\Models\TGDB\proc;
use CodeIgniter\Model;

/** เรียกข้อมูลการส่ง mail contacthistory*/
class KM_Search_ActiveAgent extends Model
{
    protected $DBGroup = 'tgdb';

    public $KMLoginName='';
    public $Keyword='';
    public $KM_CAT_LVL1='';
    public $KM_CAT_LVL2='';
    public $KM_CAT_LVL3='';

     
    /**
     * @param string KMLoginName
     * @param string Keyword
     * @param int KM_CAT_LVL1
     * @param int KM_CAT_LVL2
     * @param int KM_CAT_LVL3
     */
    public function get()
    {
        $storedProc = "EXEC KM_Search_ActiveAgent  @KMLoginName= ?, @Keyword= ?, @KM_CAT_LVL1= ?, @KM_CAT_LVL2= ?, @KM_CAT_LVL3= ?";
        $params     = [ $this->KMLoginName
                        ,$this->Keyword
                        ,$this->KM_CAT_LVL1
                        ,$this->KM_CAT_LVL2
                        ,$this->KM_CAT_LVL3];
        $query      = $this->db->query($storedProc, $params);
        $results    = $query->getResultArray();
        return $results;
        
    }
}