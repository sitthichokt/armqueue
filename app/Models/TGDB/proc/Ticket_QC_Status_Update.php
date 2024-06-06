<?php
namespace App\Models\TGDB\proc;
use CodeIgniter\Model;


class Ticket_QC_Status_Update extends Model
{
    protected $DBGroup = 'tgdb';
    public $QC_Status;
    public $QC_Id;
    public $Agen_Id;
 
    public function updates()
    {
        $storedProc = "EXEC Ticket_QC_Status_Update  @QC_Status= ?,@QC_Id= ?,@Agen_Id= ?";
        $params     = [$this->QC_Status,
                        $this->QC_Id,
                        $this->Agen_Id];
        $query      = $this->db->query($storedProc, $params);
        $results    = $query->getRowArray();
        return $results;
        
    }
}