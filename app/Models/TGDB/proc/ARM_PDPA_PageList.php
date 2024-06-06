<?php
namespace App\Models\TGDB\proc;
use CodeIgniter\Model;


class ARM_PDPA_PageList extends Model
{
    protected $DBGroup = 'tgdb';
    public $ARCust_Id='';
    public $search='';
    public $social='';

    /**
     * @param ARCust_Id
     * @param search
     * @param social
     */
    public function get()
    {
        $storedProc = "EXEC ARM_PDPA_PageList @ARCust_Id=?,@search=?,@social=?";
        $params     = [$this->ARCust_Id,
                    $this->search,
                    $this->social,];
        $query      = $this->db->query($storedProc, $params);
        $results    = $query->getResultArray();
        return $results;      
    }
}