<?php
namespace App\Models\TGDB\proc;
use CodeIgniter\Model;


class ADM3_PageManage extends Model
{
    protected $DBGroup = 'tgdb';
    public $Agent_Id='';
    public $ScreenType='List';
    public $Social_Type='';
    public $Pang_Name='';


    /**
     * @param Agent_Id
     * @param Social_Type
     * @param Pang_Name
     */
    public function list()
    {
        $storedProc = "EXEC ADM3_PageManage @Agent_Id=?,@ScreenType=?,@Social_Type=?,@Pang_Name=?";
        $params     = [$this->Agent_Id,
                        $this->ScreenType,
                        $this->Social_Type,
                        $this->Pang_Name];
        $query      = $this->db->query($storedProc, $params);
   
        if($this->ScreenType==='Excel'){
            $results['head'] = $query->getFieldNames();
            $results['body'] = $query->getResultArray(); 
        }else{
            $results    = $query->getResultArray();
        }
        unset($query,$storedProc);
        return $results;   

   
    }
}