<?php

namespace App\Models\TGDB\proc;

use CodeIgniter\Model;

class ADM3_ContactChannel_AddEdit extends Model
{
    protected $DBGroup = 'tgdb';
    public $P_ARCust_Id           ='';
    public $P_Channel_Name        ='';
    public $P_Announce_Status     ='';
    public $P_Announce_By         ='';
    public $ScreenType            ='';
    public $P_Channel_Id          ='';


    /**
     * @param P_ARCust_Id int
     * @param P_Channel_Name varchar
     * @param P_Announce_Status bit
     * @param P_Announce_By int
	 * @param ScreenType varchar
     */
    private function exec()
    {       
        $storedProc = "EXEC ADM3_ContactChannel_AddEdit @P_ARCust_Id=?,@P_Channel_Name=?,@P_Announce_Status=?,@P_Announce_By =?,@ScreenType=?,@P_Channel_Id=?";
        $params     = [$this->P_ARCust_Id
                        ,$this->P_Channel_Name
                        ,$this->P_Announce_Status
                        ,$this->P_Announce_By 
                        ,$this->ScreenType
                        ,$this->P_Channel_Id];
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
     * @param P_Channel_Name varchar
     * @param P_Announce_Status bit
     * @param P_Announce_By int
     */
    public function add(){
        $this->ScreenType = 'ADD';
        $data = $this->exec();
        return $data;
    }

    /**
     * @param P_Channel_Name varchar
     * @param P_Announce_Status bit
     * @param P_Announce_By int
     * @param P_Channel_Id int
     */
    public function edit(){
        $this->ScreenType = 'EDIT';
        $data = $this->exec();
        return $data;
    }



    /**
     * @param P_ARCust_Id
     * @param P_Announce_Status
     */
    public function list(){
        $storedProc = "EXEC ADM3_ContactChannel_AddEdit @P_ARCust_Id=?,@P_Channel_Name=?,@P_Announce_Status=?,@P_Announce_By =?,@ScreenType=?,@P_Channel_Id=?";
        $params     = [$this->P_ARCust_Id
                        ,$this->P_Channel_Name
                        ,$this->P_Announce_Status
                        ,$this->P_Announce_By
                        ,'List'
                        ,$this->P_Channel_Id];
        $query  = $this->db->query($storedProc, $params);
        $results    = $query->getResultArray();
        unset($query,$storedProc,$params);
        return $results;   
    }

    /**
     * @param P_Channel_Id
     */
    public function get(){
        $storedProc = "EXEC ADM3_ContactChannel_AddEdit @P_ARCust_Id=?,@P_Channel_Name=?,@P_Announce_Status=?,@P_Announce_By =?,@ScreenType=?,@P_Channel_Id=?";
        $params     = [$this->P_ARCust_Id
                        ,$this->P_Channel_Name
                        ,$this->P_Announce_Status
                        ,$this->P_Announce_By 
                        ,'Get'
                        ,$this->P_Channel_Id];
        $query      = $this->db->query($storedProc, $params);
        $results    = $query->getRowArray();
        unset($query,$storedProc,$params);
        return $results;   
    }
}