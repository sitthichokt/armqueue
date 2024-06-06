<?php

namespace App\Models\TGDB\proc;

use CodeIgniter\Model;

class ADM7_KM_CONTENT_AddEdit extends Model
{
    protected $DBGroup = 'tgdb';
    public $Agent_Id        = '';
    public $ScreenType      = '';
    public $KM_CONTENT_ID   = '';
    public $KM_HDR_ID       = '';
    public $KM_TITLE        = '';
    public $KM_CONTENT      = '';
    public $KM_FILENAME     = '';
    public $KM_PATH         = '';
    public $KM_CONTENT_STAT = '';

    /**
     * @param Agent_Id
     * @param ScreenType
     * @param KM_CONTENT_ID
     * @param KM_HDR_ID
     * @param KM_TITLE
     * @param KM_CONTENT
     * @param KM_FILENAME
     * @param KM_PATH
     * @param KM_CONTENT_STAT
     */
    private function exec(){
        $this->db->transOff();
        $this->db->transBegin();
        $storedProc = "EXEC ADM7_KM_CONTENT_AddEdit @Agent_Id=?,@ScreenType=?,@KM_CONTENT_ID=?,@KM_HDR_ID=?,@KM_TITLE=N?,@KM_CONTENT=N?,@KM_FILENAME=?,@KM_PATH=?,@KM_CONTENT_STAT=?";
        $params     = [$this->Agent_Id,
                        $this->ScreenType,
                        $this->KM_CONTENT_ID,
                        $this->KM_HDR_ID,
                        $this->KM_TITLE,
                        $this->KM_CONTENT,
                        $this->KM_FILENAME,
                        $this->KM_PATH,
                        $this->KM_CONTENT_STAT];
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
     * @param KM_CONTENT_ID
     */
    public function del(){
        $this->ScreenType = 'DELETE';
        $data = $this->exec();
        return $data;
    }

    /**
     * @param Agent_Id
     * @param KM_HDR_ID
     * @param KM_TITLE
     * @param KM_CONTENT
     * @param KM_FILENAME
     * @param KM_PATH
     * @param KM_CONTENT_STAT
     */
    public function add(){
        $this->ScreenType = 'ADD';
        $data = $this->exec();
        return $data;
    }

     /**
     * @param Agent_Id
     * @param KM_CONTENT_ID
     * @param KM_HDR_ID
     * @param KM_TITLE
     * @param KM_CONTENT
     * @param KM_FILENAME
     * @param KM_PATH
     * @param KM_CONTENT_STAT
     */
    public function edit(){
        $this->ScreenType = 'EDIT';
        $data = $this->exec();
        return $data;
    }

     /**
     * @param Agent_Id
     * @param KM_CONTENT_ID
     */
    public function get(){
        $storedProc = "EXEC ADM7_KM_CONTENT_AddEdit @Agent_Id=?,@ScreenType=?,@KM_CONTENT_ID=?,@KM_HDR_ID=?,@KM_TITLE=?,@KM_CONTENT=?,@KM_FILENAME=?,@KM_PATH=?,@KM_CONTENT_STAT=?";
        $params     = [$this->Agent_Id,
                        'List',
                        $this->KM_CONTENT_ID,
                        $this->KM_HDR_ID,
                        $this->KM_TITLE,
                        $this->KM_CONTENT,
                        $this->KM_FILENAME,
                        $this->KM_PATH,
                        $this->KM_CONTENT_STAT];
        $query      = $this->db->query($storedProc, $params);
        $results    = $query->getRowArray();
        unset($storedProc,$query,$params);
        return $results;
        
    }
}