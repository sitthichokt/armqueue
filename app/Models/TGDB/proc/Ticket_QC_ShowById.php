<?php
namespace App\Models\TGDB\proc;
use CodeIgniter\Model;


class Ticket_QC_ShowById extends Model
{
    protected $DBGroup = 'tgdb';
    public $LoginAgent_Id;
    public $P_QC_Id;

    /**
     * @param int LoginAgent_Id
     * @param int P_QC_Id
     */
    public function get()
    {
        $storedProc = "EXEC Ticket_QC_ShowById  @LoginAgent_Id= ?, @P_QC_Id= ?";
        $params     = [$this->LoginAgent_Id
                       ,$this->P_QC_Id];
        $query      = $this->db->query($storedProc, $params);
    
        $data['card1']          = $query->getNextRowArray(0); 
        $data['card2_head']     = $query->getNextRowArray(1); 
        $data['card2_body']     = $query->getNextRowArray(2); 
        $data['card3']          = $query->getNextRowArray(3); 
        unset($storedProc,$params,$query);
        return  $data;
    }
}