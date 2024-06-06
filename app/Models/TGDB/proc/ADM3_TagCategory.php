<?php
namespace App\Models\TGDB\proc;
use CodeIgniter\Model;


class ADM3_TagCategory extends Model
{
    protected $DBGroup = 'tgdb';
    public $Agent_Id       = '';
    public $TagGrp_Id      = '';
    public $TagCat_Status  = '';
    public $ScreenType     = 'List';


    /**
     * @param Agent_Id
     * @param TagGrp_Id
     * @param TagCat_Status
     * @param ScreenType
     */
    public function list()
    {
        $storedProc = "EXEC ADM3_TagCategory @Agent_Id=?,@TagGrp_Id=?,@TagCat_Status=?,@ScreenType=?";
        $params     = [$this->Agent_Id,
                        $this->TagGrp_Id,
                        $this->TagCat_Status,
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