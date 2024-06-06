<?php

namespace App\Models\TGDB\proc;

use CodeIgniter\Model;

class CustSocial_User_Manage_PhoneCall2 extends Model
{
    protected $DBGroup = 'tgdb';


public $User_Id         = '';
public $CustSocial_Id   = 0;
public $User_Name       = '';
public $User_ScreenName = '';
public $User_Mobile     = '';
public $User_Sname      = '';
public $User_Lname      = '';
public $User_Email      = '';
public $User_Address    = '';
public $Screen_Type     = '';

    /**
      * @param int User_Id
      * @param int CustSocial_Id
      * @param string User_Name
      * @param string User_ScreenName
      * @param string User_Mobile
      * @param string User_Sname
      * @param string User_Lname
      * @param string User_Email
      * @param string User_Address
      * @param string Screen_Type (newContact,updContact)
     */
    private function exec()
    {
        $storedProc = "EXEC CustSocial_User_Manage_PhoneCall2 @P_User_Id=?,@P_CustSocial_Id=?,@P_User_Name=?,@P_User_ScreenName=?,@P_User_Mobile=?,@P_User_Sname=?,@P_User_Lname=?,@P_User_Email=?,@P_User_Address=?,@p_Screen_Type=?";
        $params     = [  $this->User_Id
                        ,$this->CustSocial_Id
                        ,$this->User_Name
                        ,$this->User_ScreenName
                        ,$this->User_Mobile
                        ,$this->User_Sname
                        ,$this->User_Lname
                        ,$this->User_Email
                        ,$this->User_Address
                        ,$this->Screen_Type];
      
        $query  = $this->db->query($storedProc, $params);
        if(!empty($query) && $query->getNumRows()>0){
            $results  = $query->getRowArray();
			return $results['CustUser_Id'];
		}else{
            return '';
		}
    }

    /**
      * @param int CustSocial_Id
      * @param string User_Name
      * @param string User_ScreenName
      * @param string User_Mobile
      * @param string User_Sname
      * @param string User_Lname
      * @param string User_Email
      * @param string User_Address
    */
    public function add(){
        $this->Screen_Type = 'newContact';
        $data = $this->exec();
        return $data;
    }

     /**
      * @param int User_Id
      * @param int CustSocial_Id
      * @param string User_Name
      * @param string User_ScreenName
      * @param string User_Mobile
      * @param string User_Sname
      * @param string User_Lname
      * @param string User_Email
      * @param string User_Address
     */
    public function upd(){
        $this->Screen_Type = 'updContact';
        $data = $this->exec();
        return $data;
    }
}