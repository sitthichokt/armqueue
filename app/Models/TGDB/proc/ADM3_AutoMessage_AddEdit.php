<?php

namespace App\Models\TGDB\proc;

use CodeIgniter\Model;

class ADM3_AutoMessage_AddEdit extends Model
{
    protected $DBGroup = 'tgdb';
    public $Agent_Id            = '';
    public $ScreenType          = '';
    public $AutoMsg_Id          = '';
    public $AutoMsg_Name        = '';
    public $AutoMsg_Message     = '';
    public $AutoMsg_PictureFile = '';
    public $AutoMsg_Status      = '';
    public $AGroup_Id           = '';
    public $AutoMsg_OrderBy     = '';


    /**
     * @param Agent_Id
     * @param AutoMsg_Name
     * @param AutoMsg_Message
     * @param AutoMsg_PictureFile
     * @param AutoMsg_Status
     * @param AGroup_Id
     * @param AutoMsg_OrderBy
     */
    public function add()
    {
        $this->db->transOff();
        $this->db->transBegin();
        $storedProc = "EXEC ADM3_AutoMessage_AddEdit @Agent_Id=?,@ScreenType=?,@AutoMsg_Id=?,@AutoMsg_Name=?,@AutoMsg_Message=?,@AutoMsg_PictureFile=?,@AutoMsg_Status=?,@AGroup_Id=?,@AutoMsg_OrderBy=?";
        $params     = [$this->Agent_Id,
                        'ADD',
                        $this->AutoMsg_Id,
                        $this->AutoMsg_Name,
                        $this->AutoMsg_Message,
                        $this->AutoMsg_PictureFile,
                        $this->AutoMsg_Status,
                        $this->AGroup_Id,
                        $this->AutoMsg_OrderBy];
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
     * @param AutoMsg_Id
     * @param AutoMsg_Name
     * @param AutoMsg_Message
     * @param AutoMsg_PictureFile
     * @param AutoMsg_Status
     * @param AGroup_Id
     * @param AutoMsg_OrderBy
     */
    public function edit()
    {
        $this->db->transOff();
        $this->db->transBegin();
        $storedProc = "EXEC ADM3_AutoMessage_AddEdit @Agent_Id=?,@ScreenType=?,@AutoMsg_Id=?,@AutoMsg_Name=?,@AutoMsg_Message=?,@AutoMsg_PictureFile=?,@AutoMsg_Status=?,@AGroup_Id=?,@AutoMsg_OrderBy=?";
        $params     = [$this->Agent_Id,
                        'EDIT',
                        $this->AutoMsg_Id,
                        $this->AutoMsg_Name,
                        $this->AutoMsg_Message,
                        $this->AutoMsg_PictureFile,
                        $this->AutoMsg_Status,
                        $this->AGroup_Id,
                        $this->AutoMsg_OrderBy];
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
     * @param AutoMsg_Id
     */
    public function del()
    {
        $this->db->transOff();
        $this->db->transBegin();
        $storedProc = "EXEC ADM3_AutoMessage_AddEdit @Agent_Id=?,@ScreenType=?,@AutoMsg_Id=?,@AutoMsg_Name=?,@AutoMsg_Message=?,@AutoMsg_PictureFile=?,@AutoMsg_Status=?,@AGroup_Id=?,@AutoMsg_OrderBy=?";
        $params     = [$this->Agent_Id,
                        'DELETE',
                        $this->AutoMsg_Id,
                        $this->AutoMsg_Name,
                        $this->AutoMsg_Message,
                        $this->AutoMsg_PictureFile,
                        $this->AutoMsg_Status,
                        $this->AGroup_Id,
                        $this->AutoMsg_OrderBy];
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