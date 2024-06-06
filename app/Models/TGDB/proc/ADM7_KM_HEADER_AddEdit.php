<?php

namespace App\Models\TGDB\proc;

use CodeIgniter\Model;

class ADM7_KM_HEADER_AddEdit extends Model
{
    protected $DBGroup = 'tgdb';
    public $Agent_Id     = '';
    public $ScreenType   = '';
    public $KM_HEADER_ID = '';
    public $KM_TITLE     = '';
    public $KM_LV1       = '';
    public $KM_LV2       = '';
    public $KM_LV3       = '';
    public $KM_START_DT  = '';
    public $KM_END_DT    = '';
    public $KM_KEYWORD   = '';
    public $KM_DESC      = '';
    public $KM_PRIORITY  = '';
    public $KM_STAT      = '';

    /**
     * @param Agent_Id
     * @param ScreenType
     * @param KM_HEADER_ID
     * @param KM_TITLE
     * @param KM_LV1
     * @param KM_LV2
     * @param KM_LV3
     * @param KM_START_DT
     * @param KM_END_DT
     * @param KM_KEYWORD
     * @param KM_DESC
     * @param KM_PRIORITY
     * @param KM_STAT
     */
    private function exec()
    {
        $this->db->transOff();
        $this->db->transBegin();
        $storedProc = "EXEC ADM7_KM_HEADER_AddEdit @Agent_Id=?,@ScreenType=?,@KM_HEADER_ID=?,@KM_TITLE=N?,@KM_LV1=?,@KM_LV2=?,@KM_LV3=?,@KM_START_DT=?,@KM_END_DT=?,@KM_KEYWORD=?,@KM_DESC=N?,@KM_PRIORITY=?,@KM_STAT=?";
        $params     = [
            $this->Agent_Id,
            $this->ScreenType,
            $this->KM_HEADER_ID,
            $this->KM_TITLE,
            $this->KM_LV1,
            $this->KM_LV2,
            $this->KM_LV3,
            $this->KM_START_DT,
            $this->KM_END_DT,
            $this->KM_KEYWORD,
            $this->KM_DESC,
            $this->KM_PRIORITY,
            $this->KM_STAT
        ];
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
     * @param KM_TITLE
     * @param KM_LV1
     * @param KM_LV2
     * @param KM_LV3
     * @param KM_START_DT
     * @param KM_END_DT
     * @param KM_KEYWORD
     * @param KM_DESC
     * @param KM_PRIORITY
     * @param KM_STAT
     */
    public function add()
    {
        $this->ScreenType = 'ADD';
        $data = $this->exec();
        return $data;
    }

    /**
     * @param Agent_Id
     * @param KM_HEADER_ID
     * @param KM_TITLE
     * @param KM_LV1
     * @param KM_LV2
     * @param KM_LV3
     * @param KM_START_DT
     * @param KM_END_DT
     * @param KM_KEYWORD
     * @param KM_DESC
     * @param KM_PRIORITY
     * @param KM_STAT
     */
    public function edit()
    {
        $this->ScreenType = 'EDIT';
        $data = $this->exec();
        return $data;
    }

     /**
     * @param Agent_Id
     * @param KM_HEADER_ID
     */
    public function del()
    {
        $this->ScreenType = 'DELETE';
        $data = $this->exec();
        return $data;
    }

    /**
     * @param Agent_Id
     * @param KM_HEADER_ID
     */
    public function get()
    {
        $storedProc = "EXEC ADM7_KM_HEADER_AddEdit @Agent_Id=?,@ScreenType=?,@KM_HEADER_ID=?,@KM_TITLE=?,@KM_LV1=?,@KM_LV2=?,@KM_LV3=?,@KM_START_DT=?,@KM_END_DT=?,@KM_KEYWORD=?,@KM_DESC=?,@KM_PRIORITY=?,@KM_STAT=?";
        $params     = [
            $this->Agent_Id,
            'List',
            $this->KM_HEADER_ID,
            $this->KM_TITLE,
            $this->KM_LV1,
            $this->KM_LV2,
            $this->KM_LV3,
            $this->KM_START_DT,
            $this->KM_END_DT,
            $this->KM_KEYWORD,
            $this->KM_DESC,
            $this->KM_PRIORITY,
            $this->KM_STAT
        ];
        $query      = $this->db->query($storedProc, $params);
        $results    = $query->getRowArray();
        unset($storedProc, $query, $params);
        return $results;
    }
}
