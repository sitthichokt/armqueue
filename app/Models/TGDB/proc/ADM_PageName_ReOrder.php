<?php

namespace App\Models\TGDB\proc;

use CodeIgniter\Model;

class ADM_PageName_ReOrder extends Model
{
    protected $DBGroup = 'tgdb';
    public $Agent_Id          ='';


    /**
     * @param Agent_Id
     */
    public function order()
    {
        $this->db->transOff();
        $this->db->transBegin();
        $storedProc = "EXEC ADM_PageName_ReOrder @Agent_Id=?";
        $params     = [$this->Agent_Id];
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