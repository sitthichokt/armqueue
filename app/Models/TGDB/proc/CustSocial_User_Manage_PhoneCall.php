<?php

namespace App\Models\TGDB\proc;

use CodeIgniter\Model;

class CustSocial_User_Manage_PhoneCall extends Model
{
    protected $DBGroup = 'tgdb';

    public $CustSocial_Id = 0;
    public $Phonecall = '';
    public $User_Name = '';
    public $User_ScreenName = '';
    public $User_Picture = '';
    public $Screen_Type = '';

    /**
     * @param int CustSocial_Id
     * @param string Phonecall
     * @param string User_Name
     * @param string User_ScreenName
     * @param string User_Picture
     */
    public function create_case()
    {
        $storedProc = "EXEC CustSocial_User_Manage_PhoneCall @P_CustSocial_Id=?, @P_Phonecall=?, @P_User_Name=?, @P_User_ScreenName=?, @P_User_Picture=?";
        $params     = [  $this->CustSocial_Id
                        ,$this->Phonecall
                        ,$this->User_Name
                        ,$this->User_ScreenName
                        ,$this->User_Picture];
      
        $query  = $this->db->query($storedProc, $params);
        if(!empty($query) && $query->getNumRows()>0){
            $results  = $query->getRowArray();
			return $results['CustUser_Id'];
		}else{
            return '';
		}
    }
}