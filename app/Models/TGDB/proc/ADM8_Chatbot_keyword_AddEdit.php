<?php

namespace App\Models\TGDB\proc;

use CodeIgniter\Model;

class ADM8_Chatbot_keyword_AddEdit extends Model
{
    protected $DBGroup = 'tgdb';
    public $Agent_Id      = '';
    public $ScreenType    = '';
    public $Keyword_Id    = '';
    public $CustSocial_Id = '';
    public $Keyword_text  = '';
    public $Keyword_match = '';


    /**
     * @param Agent_Id
     * @param ScreenType
     * @param Keyword_Id
     * @param CustSocial_Id
     * @param Keyword_text
     * @param Keyword_match
     */
    private function exec()
    {
        $this->db->transOff();
        $this->db->transBegin();
        $storedProc = "EXEC ADM8_Chatbot_keyword_AddEdit @Agent_Id=?,@ScreenType=?,@Keyword_Id=?,@CustSocial_Id=?,@Keyword_text=?,@Keyword_match=?";
        $params     = [$this->Agent_Id,
                        $this->ScreenType,
                        $this->Keyword_Id,
                        $this->CustSocial_Id,
                        $this->Keyword_text,
                        $this->Keyword_match];
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
     * @param Keyword_text
     * @param Keyword_match
     */
    public function add()
    {
        $this->ScreenType = 'ADD';
        $data = $this->exec();
        return $data;
    }

    /**
     * @param Agent_Id
     * @param Keyword_Id
     * @param CustSocial_Id
     * @param Keyword_text
     * @param Keyword_match
     */
    public function edit()
    {
        $this->ScreenType = 'EDIT';
        $data = $this->exec();
        return $data;
    }

    /**
     * @param Agent_Id
     * @param Keyword_Id
     */
    public function del()
    {
        $this->ScreenType = 'DELETE';
        $data = $this->exec();
        return $data;
    }


     /**
     * @param Agent_Id
     * @param Keyword_Id
     */
    public function get()
    {
        $storedProc = "EXEC ADM8_Chatbot_keyword_AddEdit @Agent_Id=?,@ScreenType=?,@Keyword_Id=?,@CustSocial_Id=?,@Keyword_text=?,@Keyword_match=?";
        $params     = [$this->Agent_Id,
                        'List',
                        $this->Keyword_Id,
                        $this->CustSocial_Id,
                        $this->Keyword_text,
                        $this->Keyword_match];
        $query      = $this->db->query($storedProc, $params);
        $results    = $query->getRowArray();
        unset($storedProc, $query, $params);
        return $results;
    }


}