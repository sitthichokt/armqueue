<?php

namespace App\Models\TGDB\proc;

use CodeIgniter\Model;

/** ### อัพเกท ticket ใหม่ 
 * - header_update
 */
class Ticket_Header_Update extends Model
{
    protected $DBGroup = 'tgdb';
    public $ticket_id = '';
    public $agent_id = '';
    public $ticket_status = '';
    public $note = '';
    public $createby = '';
    public $survey = '';
    public $survey_reason = '';
    public $endcall_id = 0;

    /**
     * @param int ticket_id (ต้องมี)
     * @param int agent_id  (ต้องมี)
     * @param int ticket_status (ต้องมี)
     * @param int note
     * @param int createby (ต้องมี)
     * @param int survey
     * @param int survey_reason
     */
    public function header_update()
    {
        $this->db->transOff();
        $this->db->transBegin();
        $storedProc = "EXEC Ticket_Header_Update @P_Ticket_Id =?, @P_Agent_Id = ?, @P_Ticket_Status =?,@P_Note =?,@P_CreateByAgent_Id =?,@P_Survey =?,@P_Survey_Reason =?,@P_EndCall_Id =?";
        $params     = [
            $this->ticket_id
            ,$this->agent_id
            ,$this->ticket_status
            ,$this->note === '' ? NULL : $this->note
            ,$this->createby
            ,$this->survey
            ,$this->survey_reason === '' ? NULL : $this->survey_reason
            ,$this->endcall_id === 0 ? NULL : $this->endcall_id
        ];
        $query      = $this->db->query($storedProc, $params);

        if ($this->db->transStatus() === false) {
            //$this->db->transRollback();
            //$this->db->close();
            return false;
        } else {
            $results    = $query->getRowArray();
            $this->db->transCommit();
            //$this->db->close();
            unset($storedProc, $params, $query);
            return $results;
        }
    }
}
