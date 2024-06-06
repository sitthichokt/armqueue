<?php
namespace App\Models\TGDB\proc;
use CodeIgniter\Model;


class ADM4_ContactCategory_List extends Model
{
    protected $DBGroup = 'tgdb';
    public $Agent_Id          = '';
    public $Social_Cat_Status = '';
    public $ScreenType        = 'List';

    /**
     * @param Agent_Id
     * @param Social_Cat_Status
     * @param ScreenType
     */
    public function list()
    {
        $storedProc = "EXEC ADM4_ContactCategory_List @Agent_Id=?,@Social_Cat_Status=?,@ScreenType=?";
        $params     = [$this->Agent_Id,
                        $this->Social_Cat_Status,
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