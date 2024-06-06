<?php

namespace App\Models\TGDB\proc;

use CodeIgniter\Model;

class ADM3_MediaSub_AddEdit extends Model
{
    protected $DBGroup = 'tgdb';
        public $P_MediaCat_Id             = '';
        public $P_MediaSubCat_Desc        = '';
        public $P_MediaSubCat_Active      = '';
        public $P_MediaSubCat_CreateBy    = '';
        public $P_MediaSubCat_Order       = '';
        public $ScreenType                = '';
        public $P_ARCust_Id               = '';
        public $P_MediaSubCat_Id          = '';


    /**
     * @param   P_MediaCat_Id
     * @param   P_MediaSubCat_Desc
     * @param   P_MediaSubCat_Active
     * @param   P_MediaSubCat_CreateBy
     * @param   P_MediaSubCat_Order
     * @param   ScreenType
     * @param   P_ARCust_Id
     * @param   P_MediaSubCat_Id
     */
    private function exec()
    {      
         
        $storedProc = "EXEC ADM3_MediaSub_AddEdit  @P_MediaCat_Id=?,@P_MediaSubCat_Desc=?,@P_MediaSubCat_Active=?,@P_MediaSubCat_CreateBy=?,@P_MediaSubCat_Order=?,@ScreenType=?,@P_ARCust_Id=?,@P_MediaSubCat_Id=?";
        $params     = [$this->P_MediaCat_Id
                        ,$this->P_MediaSubCat_Desc
                        ,$this->P_MediaSubCat_Active
                        ,$this->P_MediaSubCat_CreateBy
                        ,$this->P_MediaSubCat_Order
                        ,$this->ScreenType
                        ,$this->P_ARCust_Id
                        ,$this->P_MediaSubCat_Id];
        $query  = $this->db->query($storedProc, $params);
        if (!$query) {
            return false;
        } else {		
            unset($query);	
            return true;
        }
    }

     /**
     * @param  P_MediaCat_Id   int
     * @param  P_MediaSubCat_Desc varchar
     * @param  P_MediaSubCat_Active bit
     * @param  P_MediaSubCat_CreateBy int
     * @param  P_MediaSubCat_Order int
     */
    public function add(){
        $this->ScreenType = 'ADD';
        $data = $this->exec();
        return $data;
    }

     /**
     * @param  P_MediaCat_Id   int
     * @param  P_MediaSubCat_Desc varchar
     * @param  P_MediaSubCat_Active bit
     * @param  P_MediaSubCat_CreateBy int
     * @param  P_MediaSubCat_Order int
     * @param  P_MediaSubCat_Id int
     */
    public function edit(){
        $this->ScreenType = 'EDIT';
        $data = $this->exec();
        return $data;
    }



    /**
     * @param P_ARCust_Id
     * @param P_MediaCat_Id
     * @param P_MediaSubCat_Desc
     * @param P_MediaSubCat_Active
     */
    public function list(){
        $storedProc = "EXEC ADM3_MediaSub_AddEdit  @P_MediaCat_Id=?,@P_MediaSubCat_Desc=?,@P_MediaSubCat_Active=?,@P_MediaSubCat_CreateBy=?,@P_MediaSubCat_Order=?,@ScreenType=?,@P_ARCust_Id=?,@P_MediaSubCat_Id=?";
        $params     = [$this->P_MediaCat_Id
                        ,$this->P_MediaSubCat_Desc
                        ,$this->P_MediaSubCat_Active
                        ,$this->P_MediaSubCat_CreateBy
                        ,$this->P_MediaSubCat_Order
                        ,'List'
                        ,$this->P_ARCust_Id
                        ,$this->P_MediaSubCat_Id];
        $query      = $this->db->query($storedProc, $params);
        $results    = $query->getResultArray();
        unset($query,$storedProc,$params);
        return $results;   
    }

    /**
     * @param P_MediaSubCat_Id
     */
    public function get(){
        $storedProc = "EXEC ADM3_MediaSub_AddEdit  @P_MediaCat_Id=?,@P_MediaSubCat_Desc=?,@P_MediaSubCat_Active=?,@P_MediaSubCat_CreateBy=?,@P_MediaSubCat_Order=?,@ScreenType=?,@P_ARCust_Id=?,@P_MediaSubCat_Id=?";
        $params     = [$this->P_MediaCat_Id
                        ,$this->P_MediaSubCat_Desc
                        ,$this->P_MediaSubCat_Active
                        ,$this->P_MediaSubCat_CreateBy
                        ,$this->P_MediaSubCat_Order
                        ,'Get'
                        ,$this->P_ARCust_Id
                        ,$this->P_MediaSubCat_Id];
        $query      = $this->db->query($storedProc, $params);
        $results    = $query->getRowArray();
        unset($query,$storedProc,$params);
        return $results;   
    }
}