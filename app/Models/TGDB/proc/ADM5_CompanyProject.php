<?php
namespace App\Models\TGDB\proc;
use CodeIgniter\Model;


class ADM5_CompanyProject extends Model
{
    protected $DBGroup = 'tgdb';
    public $Agent_Id       = '';
    public $Project_Status = '';
    public $ScreenType     = 'List';

    /**
     * @param Agent_Id
     * @param Project_Status
     * @param ScreenType
     */
    public function list()
    {
        $storedProc = "EXEC ADM5_CompanyProject @Agent_Id=?,@Project_Status=?,@ScreenType=?";
        $params     = [$this->Agent_Id,
                        $this->Project_Status,
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