<?php

namespace App\Models\TGDB\proc;

use CodeIgniter\Model;

class ARM_LineBroadcast_Delete extends Model
{
    protected $DBGroup  = 'tgdb';
    public $Agent_Id    = '';
    public $ARCust_Id   = '';
    public $Broad_Id    = '';

    /**
     * @param ARCust_Id
     * @param Broad_Id
     */
    public function del()
    {
        $this->db->transOff();
        $this->db->transBegin();
        $storedProc = "EXEC ARM_LineBroadcast_Delete @Agent_Id=? @ARCust_Id=?,@Broad_Id=?";
        $params     = [ $this->Agent_Id,
                        $this->ARCust_Id,
                        $this->Broad_Id];
        $query  = $this->db->query($storedProc, $params);
        if ($this->db->transStatus() === false) {
            //$this->db->transRollback();
            //$this->db->close();	
            return false;
        } else {		
            $this->db->transCommit();
            //$this->db->close();
            unset($query);	
            return true;
        }
    }

  
}