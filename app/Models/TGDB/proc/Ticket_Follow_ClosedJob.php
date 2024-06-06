<?php

namespace App\Models\TGDB\proc;

use CodeIgniter\Model;

/** ### อัพเกท ticket ใหม่ 
 * - header_update
 */
class Ticket_Follow_ClosedJob extends Model
{
    protected $DBGroup = 'tgdb';
    public $Agent_Id;
    public $Follow_Id;
    public $FClose_Id ;
    public $Follow_Remark;

    /**
     * @param int Agent_Id
     * @param int Follow_Id
     * @param int FClose_Id 
     * @param string Follow_Remark
     */
    public function closedjob_update()
    {
        $this->db->transOff();
        $this->db->transBegin();
        $storedProc = "EXEC Ticket_Follow_ClosedJob  @Agent_Id=?, @Follow_Id=?, @FClose_Id=?, @Follow_Remark=?";
        $params     = [
            $this->Agent_Id
            ,$this->Follow_Id
            ,$this->FClose_Id
            ,$this->Follow_Remark
        ];
        $query      = $this->db->query($storedProc, $params);

        if ($this->db->transStatus() === false) {
            $results  = $this->db->error();
			//$this->db->transRollback();
			//$this->db->close();	
            $results['ststus'] = false;
			return $results;
		} else {
			$results  = $query->getRowArray();  
			$this->db->transCommit();
			//$this->db->close();
            $results['ststus'] = true;
			return $results;
		}
    }
}
