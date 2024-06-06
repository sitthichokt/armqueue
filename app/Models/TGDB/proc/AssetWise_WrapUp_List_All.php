<?php
namespace App\Models\TGDB\proc;
use CodeIgniter\Model;

/** ประวัติการติดต่อ */
class AssetWise_WrapUp_List_All extends Model
{
    protected $DBGroup = 'tgdb';

    public $Ticket_Id;
 
    /**
     * @param Ticket_Id
     */
    public function list()
    {
        $storedProc = "EXEC AssetWise_WrapUp_List_All  @Ticket_Id= ?";
        $params     = [$this->Ticket_Id];
        $query      = $this->db->query($storedProc, $params);
        $results    = $query->getResultArray();
        return $results;
        
    }
}