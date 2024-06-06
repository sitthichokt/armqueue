<?php

namespace App\Models\TGDB\proc;

use CodeIgniter\Model;

class ADM8_Chatbot_PatternAns_AddEdit extends Model
{
    protected $DBGroup = 'tgdb';
    public $Agent_Id         = '';
    public $ScreenType       = '';
    public $Pattern_Id       = '';
    public $CustSocial_Id    = '';
    public $Message_Id       = '';
    public $Keyword_Id       = '';
    public $Pattern_Sequence = '';

    /**
     * @param Agent_Id
     * @param ScreenType
     * @param Pattern_Id
     * @param CustSocial_Id
     * @param Message_Id
     * @param Keyword_Id
     * @param Pattern_Sequence
     */
    private function exec()
    {
        $this->db->transOff();
        $this->db->transBegin();
        $storedProc = "EXEC ADM8_Chatbot_PatternAns_AddEdit @Agent_Id=?,@ScreenType=?,@Pattern_Id=?,@CustSocial_Id=?,@Message_Id=?,@Keyword_Id=?,@Pattern_Sequence=?";
        $params     = [$this->Agent_Id,
                        $this->ScreenType,
                        $this->Pattern_Id,
                        $this->CustSocial_Id,
                        $this->Message_Id,
                        $this->Keyword_Id,
                        $this->Pattern_Sequence];
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
     * @param Agent_Id
     * @param CustSocial_Id
     * @param Message_Id
     * @param Keyword_Id
     * @param Pattern_Sequence
     */
    public function add()
    {
        $this->ScreenType = 'ADD';
        $data = $this->exec();
        return $data;
    }

    /**
     * @param Agent_Id
     * @param Pattern_Id
     * @param CustSocial_Id
     * @param Message_Id
     * @param Keyword_Id
     * @param Pattern_Sequence
     */
    public function edit()
    {
        $this->ScreenType = 'EDIT';
        $data = $this->exec();
        return $data;
    }

    /**
     * @param Agent_Id
     * @param Pattern_Id
     */
    public function del()
    {
        $this->ScreenType = 'DELETE';
        $data = $this->exec();
        return $data;
    }

    /**
     * @param Agent_Id
     * @param Pattern_Id
     */
    public function get()
    {
        $storedProc = "EXEC ADM8_Chatbot_PatternAns_AddEdit @Agent_Id=?,@ScreenType=?,@Pattern_Id=?,@CustSocial_Id=?,@Message_Id=?,@Keyword_Id=?,@Pattern_Sequence=?";
        $params     = [$this->Agent_Id,
                        'List',
                        $this->Pattern_Id,
                        $this->CustSocial_Id,
                        $this->Message_Id,
                        $this->Keyword_Id,
                        $this->Pattern_Sequence];
        $query      = $this->db->query($storedProc, $params);
        $results    = $query->getRowArray();
        unset($storedProc, $query, $params);
        return $results;
    }

}