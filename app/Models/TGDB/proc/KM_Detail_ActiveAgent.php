<?php
namespace App\Models\TGDB\proc;
use CodeIgniter\Model;

/** เรียกข้อมูลการส่ง mail contacthistory*/
class KM_Detail_ActiveAgent extends Model
{
    protected $DBGroup = 'tgdb';

    public $KMLoginName ='';
    public $KM_HDR_ID   ='';

     
    /**
     * @param string KMLoginName
     * @param string KM_HDR_ID
     */
    public function get()
    {
        $storedProc = "EXEC KM_Detail_ActiveAgent  @KMLoginName= ?, @KM_HDR_ID= ?";
        $params     = [ $this->KMLoginName
                        ,$this->KM_HDR_ID];
        $query      = $this->db->query($storedProc, $params);
        // $results    = $query->getResultArray();


		$data['a']           = $query->getNextRowArray(0); 
		$data['b']           = $query->getNextRowArray(1); 



        return $data;
        
    }
}