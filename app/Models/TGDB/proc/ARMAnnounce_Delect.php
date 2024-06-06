<?php

namespace App\Models\TGDB\proc;

use CodeIgniter\Model;

class ARMAnnounce_Delect extends Model
{
    protected $DBGroup = 'tgdb';
    public $ARCust_Id   = '';
    public $announce_id = '';  

    /**
     * @param ARCust_Id
     * @param announce_id
     */
    public function del()
    {
        $this->db->transOff();
        $this->db->transBegin();
        $storedProc = "EXEC ARMAnnounce_Delect @ARCust_Id=?,@announce_id=?";
        $params     = [$this->ARCust_Id,
                        $this->announce_id,];
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