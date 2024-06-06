<?php
namespace App\Models\TGDB\proc;
use CodeIgniter\Model;


class ARM_Custsocial extends Model
{
    protected $DBGroup = 'tgdb';
    public $ARcust_Id;

    /**
     * @param int ARcust_Id
     */
    public function get()
    {         
        $storedProc = "EXEC ARM_Custsocial  @ARcust_Id= ?";
        $params     = [$this->ARcust_Id];
        $query      = $this->db->query($storedProc, $params);
        $results    = $query->getResultArray();
        return $results;      
    }
}