<?php
namespace App\Models\TGDB\proc;
use CodeIgniter\Model;

class ADM_PageName extends Model
{
    protected $DBGroup = 'tgdb';


    public $Agent_Id='';
    public $Social_Type='';
    public $Social_Id=0;

  

    /**
     * @param int Agent_Id
     * @param varchar Social_Type
     * @param int Social_Id
     */
    public function list()
    {
        $storedProc = "EXEC ADM_PageName  @Agent_Id= ?,@Social_Type= ?,@Social_Id= ?";
        $params     = [ $this->Agent_Id,
                        $this->Social_Type,
                        $this->Social_Id,];
        $query      = $this->db->query($storedProc, $params);
        $results    = $query->getResultArray();
        return $results;
        
    }
}