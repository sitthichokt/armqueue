<?php

namespace App\Models\TGDB\proc;

use CodeIgniter\Model;

class ADM8_BotML_BotAnswerAddEdit extends Model
{
    protected $DBGroup = 'tgdb';
    public $Agent_Id        = '';
    public $CustSocial_Id   = '';
    public $ScreenType      = '';
    public $MLQuest_Id      = 0;
    public $MLQuest_Name    = '';
    public $MLTrain_Id      = 0;
    public $MLTrain_Message = '';
    public $P_MLQuest_Id = 0;


    /**
     * @param Agent_Id
     * @param CustSocial_Id
     * @param ScreenType
     * @param MLQuest_Id
     * @param MLQuest_Name
     * @param MLTrain_Id
     * @param MLTrain_Message
     */
    private function exec()
    {
        $this->db->transOff();
        $this->db->transBegin();
        $storedProc = "EXEC ADM8_BotML_BotAnswerAddEdit @Agent_Id=?,@CustSocial_Id=?,@ScreenType=?,@MLQuest_Id=?,@MLQuest_Name=?,@MLTrain_Id=?,@MLTrain_Message=?";
        $params     = [$this->Agent_Id,
                        $this->CustSocial_Id,
                        $this->ScreenType,
                        $this->MLQuest_Id,
                        $this->MLQuest_Name,
                        $this->MLTrain_Id,
                        $this->MLTrain_Message];
        $query  = $this->db->query($storedProc, $params);
        if ($this->db->transStatus() === false) {
            //$this->db->transRollback();
            //$this->db->close();
            return false;
        } else {
            $this->P_MLQuest_Id = $query->getRowArray();
            $this->db->transCommit();
            //$this->db->close();
            unset($query);
            return true;
        }
    }

    /**
     * @param Agent_Id
     * @param CustSocial_Id
     * @param MLQuest_Name
     */
    public function add_l1()
    {
        $this->ScreenType = 'ADD_L1';
        $data = $this->exec();
        return $data;
    }

    /**
     * @param Agent_Id
     * @param CustSocial_Id
     * @param MLQuest_Id
     * @param MLTrain_Message
     */
    public function add_l2()
    {
        $this->ScreenType = 'ADD_L2';
        $data = $this->exec();
        return $data;
    }

    /**
     * @param Agent_Id
     * @param CustSocial_Id
     * @param MLQuest_Id
     * @param MLQuest_Name
     */
    public function edit_l1()
    {
        $this->ScreenType = 'EDIT_L1';
        $data = $this->exec();
        return $data;
    }

    /**
     * @param Agent_Id
     * @param CustSocial_Id
     * @param MLQuest_Id
     */
    public function del_l1()
    {
        $this->ScreenType = 'DELETE_L1';
        $data = $this->exec();
        return $data;
    }
    
    /**
     * @param Agent_Id
     * @param MLTrain_Id
     */
    public function del_l2()
    {
        $this->ScreenType = 'DELETE_L2';
        $data = $this->exec();
        return $data;
    }

    public function get_id(){
        if($this->P_MLQuest_Id===0 || $this->P_MLQuest_Id==='' || $this->P_MLQuest_Id === null){
            $id = 0;
        }else{
            $data = $this->P_MLQuest_Id;
            if(!empty($data) && !empty($data['MLQuest_Id'])){
                $id = $data['MLQuest_Id'];
            }else{
                $id = 0;
            }
           
        }
        return $id;
    }

}