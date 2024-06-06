<?php

namespace App\Models\TGDB\proc;
use CodeIgniter\Model;

class Webhook_message_upd extends Model
{
    protected $DBGroup = 'tgdb';
    public $ScreenType = '';
    public $hookId     = '';

    /**
     * @param string ScreenType Date,Status
     * @param int hookId
     */
    public function upd()
    {
        $this->db->transOff();
        $this->db->transBegin();
        $storedProc = "EXEC Webhook_message_upd @ScreenType=?,@hookId=?";
        $params     = [$this->ScreenType,                     
                        $this->hookId];
        $query      = $this->db->query($storedProc, $params);

        if ($this->db->transStatus() === false) {
            // //$this->db->transRollback();
            // //$this->db->close();
            return false;
        } else {
            $this->db->transCommit();
            //$this->db->close();
            unset($storedProc, $params, $query);
            return true;
        }
    }
}