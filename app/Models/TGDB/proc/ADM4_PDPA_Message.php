<?php
namespace App\Models\TGDB\proc;
use CodeIgniter\Model;

class ADM4_PDPA_Message extends Model
{
    protected $DBGroup  = 'tgdb';
    public $Agent_Id    = '';
    public $Social_Type = '';
    public $ScreenType  = 'List';
    public $PDPA_Message_status = '';

    /**
     * @param Agent_Id
     * @param Social_Type
     * @param ScreenType
     */
    public function list()
    {
        $storedProc = "EXEC ADM4_PDPA_Message @Agent_Id=?,@Social_Type=?,@Status=?,@ScreenType=?";
        $params     = [ $this->Agent_Id,
                        $this->Social_Type,
                        $this->PDPA_Message_status,
                        $this->ScreenType];
        $query      = $this->db->query($storedProc, $params);
        $results    = $query->getResultArray();
        
        unset($query,$storedProc);
        return $results;   
    }
}