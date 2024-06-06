<?php
namespace App\Models\TGDB\proc;
use CodeIgniter\Model;


class ADM3_TagManage extends Model
{
    protected $DBGroup = 'tgdb';
    public $Agent_Id    = '';
    public $TagGrp_Id   = '';
    public $TagCat_Id   = '';
    public $Tag_Status  = '';
    public $ScreenType  = 'List';

    /**
     * @param Agent_Id
     * @param TagGrp_Id
     * @param TagCat_Id
     * @param Tag_Status
     * @param ScreenType
     */
    public function list()
    {
        $storedProc = "EXEC ADM3_TagManage @Agent_Id=?,@TagGrp_Id=?,@TagCat_Id=?,@Tag_Status=?,@ScreenType=?";
        $params     = [$this->Agent_Id,
                        $this->TagGrp_Id,
                        $this->TagCat_Id,
                        $this->Tag_Status,
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