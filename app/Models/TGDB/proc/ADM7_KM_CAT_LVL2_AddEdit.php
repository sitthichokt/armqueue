<?php

namespace App\Models\TGDB\proc;

use CodeIgniter\Model;

class ADM7_KM_CAT_LVL2_AddEdit extends Model
{
    protected $DBGroup = 'tgdb';
    public $Agent_Id         = '';
    public $ScreenType       = '';
    public $KM_CAT_LVL2_ID   = '';
    public $KM_CAT_LVL1_ID   = '';
    public $KM_CAT_LVL2_DESC = '';
    public $KM_LVL2_STAT     = '';
    public $KM_LVL2_ORDER    = '';



    /**
     * @param Agent_Id
     * @param ScreenType
     * @param KM_CAT_LVL2_ID
     * @param KM_CAT_LVL1_ID
     * @param KM_CAT_LVL2_DESC
     * @param KM_LVL2_STAT
     * @param KM_LVL2_ORDER
     */
    private function exec()
    {
        $this->db->transOff();
        $this->db->transBegin();
        $storedProc = "EXEC ADM7_KM_CAT_LVL2_AddEdit @Agent_Id=?,@ScreenType=?,@KM_CAT_LVL2_ID=?,@KM_CAT_LVL1_ID=?,@KM_CAT_LVL2_DESC=?,@KM_LVL2_STAT=?,@KM_LVL2_ORDER=?";
        $params     = [$this->Agent_Id,
                        $this->ScreenType,
                        $this->KM_CAT_LVL2_ID,
                        $this->KM_CAT_LVL1_ID,
                        $this->KM_CAT_LVL2_DESC,
                        $this->KM_LVL2_STAT,
                        $this->KM_LVL2_ORDER];
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
     * @param KM_CAT_LVL1_ID
     * @param KM_CAT_LVL2_DESC
     * @param KM_LVL2_STAT
     * @param KM_LVL2_ORDER
     */
    public function add(){
        $this->ScreenType = 'ADD';
        $data = $this->exec();
        return $data;
    }

    /**
     * @param Agent_Id
     * @param KM_CAT_LVL2_ID
     * @param KM_CAT_LVL1_ID
     * @param KM_CAT_LVL2_DESC
     * @param KM_LVL2_STAT
     * @param KM_LVL2_ORDER
     */
    public function edit(){
        $this->ScreenType = 'EDIT';
        $data = $this->exec();
        return $data;
    }

    /**
     * @param Agent_Id
     * @param KM_CAT_LVL2_ID
     */
    public function del(){
        $this->ScreenType = 'DELETE';
        $data = $this->exec();
        return $data;
    }

    /**
     * @param Agent_Id
     * @param KM_CAT_LVL2_ID
     */
    public function get()
    {
        $storedProc = "EXEC ADM7_KM_CAT_LVL2_AddEdit @Agent_Id=?,@ScreenType=?,@KM_CAT_LVL2_ID=?,@KM_CAT_LVL1_ID=?,@KM_CAT_LVL2_DESC=?,@KM_LVL2_STAT=?,@KM_LVL2_ORDER=?";
        $params     = [$this->Agent_Id,
                        'List',
                        $this->KM_CAT_LVL2_ID,
                        $this->KM_CAT_LVL1_ID,
                        $this->KM_CAT_LVL2_DESC,
                        $this->KM_LVL2_STAT,
                        $this->KM_LVL2_ORDER];
        $query      = $this->db->query($storedProc, $params);
        $results    = $query->getRowArray();
        return $results;
    }
}