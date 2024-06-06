<?php

namespace App\Models\TGDB\proc;

use CodeIgniter\Model;

class ADM3_ENDCallSurvey_AddEdit extends Model
{

    protected $DBGroup = 'tgdb';
    public $P_ENDCall_Id     ='';
    public $P_ARCust_Id      ='';
    public $P_ENDCall_Desc   ='';
    public $P_ENDCall_ACtive ='';
    public $P_ENDCall_Order  ='';
    public $ScreenType       ='';

    /**
     * @param P_ENDCall_Id int
     * @param P_ARCust_Id int
     * @param P_ENDCall_Desc varchar
     * @param P_ENDCall_ACtive int
     * @param P_ENDCall_Order int
     * @param ScreenType varchar
     */
    private function exec()
    {      
         
        $storedProc = "EXEC ADM3_ENDCallSurvey_AddEdit  @P_ENDCall_Id=?,@P_ARCust_Id=?,@P_ENDCall_Desc=?,@P_ENDCall_ACtive=?,@P_ENDCall_Order=?,@ScreenType=?";
        $params     = [$this->P_ENDCall_Id
                        ,$this->P_ARCust_Id
                        ,$this->P_ENDCall_Desc
                        ,$this->P_ENDCall_ACtive
                        ,$this->P_ENDCall_Order
                        ,$this->ScreenType];
        $query  = $this->db->query($storedProc, $params);
        if (!$query) {
            return false;
        } else {		
            unset($query);	
            return true;
        }
    }

    /**
     * @param P_ARCust_Id int
     * @param P_ENDCall_Desc varchar
     * @param P_ENDCall_ACtive int
     * @param P_ENDCall_Order int
     */
    public function add(){
        $this->ScreenType = 'ADD';
        $data = $this->exec();
        return $data;
    }

    /**
     * @param P_ENDCall_Id int
     * @param P_ENDCall_Desc varchar
     * @param P_ENDCall_ACtive int
     * @param P_ENDCall_Order int
     */
    public function edit(){
        $this->ScreenType = 'EDIT';
        $data = $this->exec();
        return $data;
    }



    /**
     * @param P_ARCust_Id int
     * @param P_ENDCall_ACtive int
     */
    public function list(){
        $storedProc = "EXEC ADM3_ENDCallSurvey_AddEdit  @P_ENDCall_Id=?,@P_ARCust_Id=?,@P_ENDCall_Desc=?,@P_ENDCall_ACtive=?,@P_ENDCall_Order=?,@ScreenType=?";
        $params     = [$this->P_ENDCall_Id
                        ,$this->P_ARCust_Id
                        ,$this->P_ENDCall_Desc
                        ,$this->P_ENDCall_ACtive
                        ,$this->P_ENDCall_Order
                        ,'List'];
        $query      = $this->db->query($storedProc, $params);
        $results    = $query->getResultArray();
        unset($query,$storedProc,$params);
        return $results;   
    }

     /**
     * @param P_ENDCall_Id int
     */
    public function get(){
        $storedProc = "EXEC ADM3_ENDCallSurvey_AddEdit  @P_ENDCall_Id=?,@P_ARCust_Id=?,@P_ENDCall_Desc=?,@P_ENDCall_ACtive=?,@P_ENDCall_Order=?,@ScreenType=?";
        $params     = [$this->P_ENDCall_Id
                        ,$this->P_ARCust_Id
                        ,$this->P_ENDCall_Desc
                        ,$this->P_ENDCall_ACtive
                        ,$this->P_ENDCall_Order
                        ,'Get'];
        $query      = $this->db->query($storedProc, $params);
        $results    = $query->getRowArray();
        unset($query,$storedProc,$params);
        return $results;   
    }
}