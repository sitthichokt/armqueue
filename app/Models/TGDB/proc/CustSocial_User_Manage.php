<?php
namespace App\Models\TGDB\proc;
use CodeIgniter\Model;


class CustSocial_User_Manage extends Model
{
    protected $DBGroup = 'tgdb';

    public $P_CustUser_Id;
    public $P_User_Id;
    public $P_User_Name;
    public $P_User_ScreenName;
    public $P_User_Picture;
 
    /**
     * @param int P_CustUser_Id
     * @param string P_User_Id
     * @param string P_User_Name
     * @param string P_User_ScreenName
     * @param string P_User_Picture
     */
    public function updates()
    {
        $storedProc = "EXEC CustSocial_User_Manage   @P_CustUser_Id= ?, @P_User_Id= ?, @P_User_Name= N?, @P_User_ScreenName= N?, @P_User_Picture= ?";
        $params     = [$this->P_CustUser_Id
                        ,$this->P_User_Id
                        ,$this->P_User_Name
                        ,$this->P_User_ScreenName
                        ,$this->P_User_Picture];
        $query      = $this->db->query($storedProc, $params);
        $results    = $query->getResultArray();
        return $results;
        
    }

     /**
     * @param int P_CustUser_Id
     * @param string P_User_Id
     * @param string P_User_Name
     * @param string P_User_ScreenName
     * @param string P_User_Picture
     */
    public function edit()
    {
        $storedProc = "EXEC CustSocial_User_Manage   @P_CustUser_Id= ?, @P_User_Id= ?, @P_User_Name= N?, @P_User_ScreenName= N?, @P_User_Picture= ?";
        $params     = [$this->P_CustUser_Id
                        ,$this->P_User_Id
                        ,$this->P_User_Name
                        ,$this->P_User_ScreenName
                        ,$this->P_User_Picture];
        $query      = $this->db->query($storedProc, $params);
        $results    = $query->getRowArray();
        return $results;    
    }
}