<?php
namespace App\Models\TGDB\proc;
use CodeIgniter\Model;


class ADM3_TagGroup extends Model
{
    protected $DBGroup = 'tgdb';
    public $Agent_Id='';
    public $TsgGroup_Status='';
    public $ScreenType='List';


    /**
     * @param Agent_Id
     * @param TsgGroup_Status
     * @param ScreenType
     */
    public function list()
    {
        $storedProc = "EXEC ADM3_TagGroup @Agent_Id=?,@TsgGroup_Status=?,@ScreenType=?";
        $params     = [$this->Agent_Id,
                        $this->TsgGroup_Status,
                        $this->ScreenType];
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