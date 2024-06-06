<?php
namespace App\Models\TGDB\proc;
use CodeIgniter\Model;


class PHP_List_PageName extends Model
{
    protected $DBGroup = 'tgdb';

    public $Agent_Id;
    public $Social_Type;
 
    /**
     * @param Agent_Id
     * @param Social_Type
     */
    public function list()
    {
        $storedProc = "EXEC PHP_List_PageName  @Agent_Id= ?, @Social_Type= ?";
        $params     = [$this->Agent_Id,$this->Social_Type];
        $query      = $this->db->query($storedProc, $params);
        $results    = $query->getResultArray();
        return $results;      
    }
}