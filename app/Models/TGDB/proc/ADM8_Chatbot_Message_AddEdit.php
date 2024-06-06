<?php

namespace App\Models\TGDB\proc;

use CodeIgniter\Model;

class ADM8_Chatbot_Message_AddEdit extends Model
{
    protected $DBGroup = 'tgdb';
    public $Agent_Id      ='';
    public $ScreenType    ='';
    public $Message_Id    ='';
    public $CustSocial_Id ='';
    public $Message_Name  ='';
    public $action_type   ='';
    public $action_text   ='';
    public $quick_reply   ='';
    public $action_label  ='';

    /**
     * @param Agent_Id
     * @param ScreenType
     * @param Message_Id
     * @param CustSocial_Id
     * @param Message_Name
     * @param action_type
     * @param action_text
     * @param quick_reply
     * @param action_label
     */
    private function exec()
    {
        $this->db->transOff();
        $this->db->transBegin();
        $storedProc = "EXEC ADM8_Chatbot_Message_AddEdit @Agent_Id=?,@ScreenType=?,@Message_Id=?,@CustSocial_Id=?,@Message_Name=?,@action_type=?,@action_text=?,@quick_reply=?,@action_label=?";
        $params     = [$this->Agent_Id,
                        $this->ScreenType,
                        $this->Message_Id,
                        $this->CustSocial_Id,
                        $this->Message_Name,
                        $this->action_type,
                        $this->action_text,
                        $this->quick_reply,
                        $this->action_label];
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

    /**
     * @param int Agent_Id
     * @param int CustSocial_Id
     * @param string Message_Name
     * @param string action_type flex
     * @param json action_text
     * @param json quick_reply
     * @param string action_label
     */
    public function add()
    {
        $this->ScreenType = 'ADD';
        $data = $this->exec();
        return $data;
    }

    /**
     * @param int Agent_Id
     * @param int Message_Id
     * @param int CustSocial_Id
     * @param string Message_Name
     * @param string action_type flex
     * @param json action_text
     * @param json quick_reply
     * @param string action_label
     */
    public function edit()
    {
        $this->ScreenType = 'EDIT';
        $data = $this->exec();
        return $data;
    }

    /**
     * @param int Agent_Id
     * @param int Message_Id
     */
    public function del()
    {
        $this->ScreenType = 'DELETE';
        $data = $this->exec();
        return $data;
    }
}