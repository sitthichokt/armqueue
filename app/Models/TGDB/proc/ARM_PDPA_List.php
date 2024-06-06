<?php
namespace App\Models\TGDB\proc;
use CodeIgniter\Model;


class ARM_PDPA_List extends Model
{
    protected $DBGroup = 'tgdb';
    public $CustSocial_Id='';
    public $ARCust_Id='';

    /**
     * @param CustSocial_Id
     * @param ARCust_Id
     */
    public function get()
    {
        $storedProc = "EXEC ARM_PDPA_List @CustSocial_Id=?,@ARCust_Id=?";
        $params     = [$this->CustSocial_Id,
                    $this->ARCust_Id];
        $query      = $this->db->query($storedProc, $params);
        $results    = $query->getResultArray();
        return $results;      
    }
}