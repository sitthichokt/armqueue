<?php

namespace App\Models\TGDB\proc;

use CodeIgniter\Model;

class Ticket_TAB_CustomerMerge_List extends Model
{
    protected $DBGroup = 'tgdb';
    public $Agent_Id          = '';
    public $ScreenType        = '';
    public $SocialUserPro_Id  = '';
    public $MergeGroup_Id     = 0;


     /**
     * @param Agent_Id
     * @param MergeGroup_Id
     */
    public function get()
    {
        $storedProc = "EXEC Ticket_TAB_CustomerMerge_List @Agent_Id=?,@ScreenType=?,@SocialUserPro_Id=?,@MergeGroup_Id=?";
        $params     = [$this->Agent_Id,
                        'LIST',
                        $this->SocialUserPro_Id,
                        $this->MergeGroup_Id];
        $query      = $this->db->query($storedProc, $params);
    
        $data['form']      = $query->getNextRowArray(0); 
        $data['table']     = $query->getNextRowArray(1); 
        unset($storedProc,$params,$query);
        return  $data;
    }


    /**
     * @param Agent_Id
     * @param MergeGroup_Id
     * @param SocialUserPro_Id
     */
    public function edit()
    {
        $this->db->transOff();
        $this->db->transBegin();
        $storedProc = "EXEC Ticket_TAB_CustomerMerge_List @Agent_Id=?,@ScreenType=?,@SocialUserPro_Id=?,@MergeGroup_Id=?";
        $params     = [$this->Agent_Id,
                        'UPDATE',
                        $this->SocialUserPro_Id,
                        $this->MergeGroup_Id];
        $query      = $this->db->query($storedProc, $params);

        if ($this->db->transStatus() === false) {
            //$this->db->transRollback();
            //$this->db->close();
            return false;
        } else {
            $this->db->transCommit();
            //$this->db->close();
            unset($storedProc, $params, $query);
            return true;
        }
    }

    /**
     * @param Agent_Id
     * @param SocialUserPro_Id
     */
    public function del()
    {
        $this->db->transOff();
        $this->db->transBegin();
        $storedProc = "EXEC Ticket_TAB_CustomerMerge_List @Agent_Id=?,@ScreenType=?,@SocialUserPro_Id=?,@MergeGroup_Id=?";
        $params     = [$this->Agent_Id,
                        'DELETE',
                        $this->SocialUserPro_Id,
                        $this->MergeGroup_Id];
        $query      = $this->db->query($storedProc, $params);

        if ($this->db->transStatus() === false) {
            //$this->db->transRollback();
            //$this->db->close();
            return false;
        } else {
            $this->db->transCommit();
            //$this->db->close();
            unset($storedProc, $params, $query);
            return true;
        }
    }
}
