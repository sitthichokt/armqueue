<?php

namespace App\Models\TGDB\proc;

use CodeIgniter\Model;

class ADM3_Media_AddEdit extends Model
{
    protected $DBGroup = 'tgdb';
    public $P_MediaCat_Desc    = '';
    public $P_MediaCat_Active  = '';
    public $P_ARCust_Id        = '';
    public $P_MediaCat_Order   = '';
    public $ScreenType         = '';
    public $P_MediaCat_Id         = '';


    /**
     * @param P_MediaCat_Desc
     * @param P_MediaCat_Active
     * @param P_ARCust_Id
     * @param P_MediaCat_Order
     * @param ScreenType
     */
    private function exec()
    {       
        $storedProc = "EXEC ADM3_Media_AddEdit @P_MediaCat_Desc=?,@P_MediaCat_Active=?,@P_ARCust_Id=?,@P_MediaCat_Order=?,@ScreenType=?,@P_MediaCat_Id=?";
        $params     = [$this->P_MediaCat_Desc
                        , $this->P_MediaCat_Active
                        , $this->P_ARCust_Id
                        , $this->P_MediaCat_Order
                        , $this->ScreenType
                        , $this->P_MediaCat_Id];
        $query  = $this->db->query($storedProc, $params);
        if (!$query) {
            return false;
        } else {		
            unset($query);	
            return true;
        }
    }

    /**
     * @param P_MediaCat_Desc
     * @param P_MediaCat_Active
     * @param P_ARCust_Id
     * @param P_MediaCat_Order
     */
    public function add(){
        $this->ScreenType = 'ADD';
        $data = $this->exec();
        return $data;
    }

    /**
     * @param P_MediaCat_Desc
     * @param P_MediaCat_Active
     * @param P_MediaCat_Order
     * @param P_MediaCat_Id
     */
    public function edit(){
        $this->ScreenType = 'EDIT';
        $data = $this->exec();
        return $data;
    }



    /**
     * @param P_ARCust_Id
     * @param P_MediaCat_Active
     */
    public function list(){
        $storedProc = "EXEC ADM3_Media_AddEdit @P_MediaCat_Desc=?,@P_MediaCat_Active=?,@P_ARCust_Id=?,@P_MediaCat_Order=?,@ScreenType=?,@P_MediaCat_Id=?";
        $params     = [$this->P_MediaCat_Desc
                        , $this->P_MediaCat_Active
                        , $this->P_ARCust_Id
                        , $this->P_MediaCat_Order
                        , 'List'
                        , $this->P_MediaCat_Id];
        $query      = $this->db->query($storedProc, $params);
        $results    = $query->getResultArray();
        unset($query,$storedProc,$params);
        return $results;   
    }

    /**
     * @param P_MediaCat_Id
     */
    public function get(){
        $storedProc = "EXEC ADM3_Media_AddEdit @P_MediaCat_Desc=?,@P_MediaCat_Active=?,@P_ARCust_Id=?,@P_MediaCat_Order=?,@ScreenType=?,@P_MediaCat_Id=?";
        $params     = [$this->P_MediaCat_Desc
                        , $this->P_MediaCat_Active
                        , $this->P_ARCust_Id
                        , $this->P_MediaCat_Order
                        , 'Get'
                        , $this->P_MediaCat_Id];
        $query      = $this->db->query($storedProc, $params);
        $results    = $query->getRowArray();
        unset($query,$storedProc,$params);
        return $results;   
    }
}