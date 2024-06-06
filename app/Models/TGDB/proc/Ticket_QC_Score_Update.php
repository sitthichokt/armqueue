<?php
namespace App\Models\TGDB\proc;
use CodeIgniter\Model;


class Ticket_QC_Score_Update extends Model
{
    protected $DBGroup = 'tgdb';

    public $CHOICE_ID;
    public $ANSWER;
    public $QCScore_Id;
 
    /**
     * @param int ASW_WrapUp_Id  คืด pk from AssetWise_WrapUpTicket
     */
    public function updates()
    {
        $storedProc = "EXEC Ticket_QC_Score_Update  @CHOICE_ID= ?,@ANSWER= ?,@QCScore_Id= ?";
        $params     = [$this->CHOICE_ID,
                        $this->ANSWER,
                        $this->QCScore_Id];
        $query      = $this->db->query($storedProc, $params);
        $results    = $query->getRowArray();
        return $results;
        
    }
}