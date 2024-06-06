<?php

namespace App\Models\TGDB\proc;

use CodeIgniter\Model;

/** ## get id type  CaseType,subtype1,subtype2*/
class ARCust_SocialUser_Profile_Update extends Model
{
    protected $DBGroup = 'tgdb';

    public $SocialUserPro_Id;
    public $User_NickNames;
    public $SocialUser_Name;
    public $SocialUser_Mobile;
    public $SocialUser_Email;
    public $SocialUser_LastName;
    public $Social_Cat_Id;
    public $Social_SubCat_Id;
    public $Social_Desc1;
    public $Social_Desc2;
    public $SocialUser_Product;
    public $SocialGroup;
    public $SocialName;

    /**
     * @param int    SocialUserPro_Id
     * @param string User_NickNames
     * @param string SocialUser_Name
     * @param string SocialUser_Mobile
     * @param string SocialUser_Email
     * @param string SocialUser_LastName
     * @param int    Social_Cat_Id
     * @param int    Social_SubCat_Id
     * @param string Social_Desc1
     * @param string Social_Desc2
     * @param string SocialUser_Product
     * @param string SocialGroup
     * @param string SocialName
     */
    public function updates()
    {
        $this->db->transOff();
        $this->db->transBegin();
        $storedProc = "EXEC ARCust_SocialUser_Profile_Update @SocialUserPro_Id=?,@User_NickNames=?,@SocialUser_Name=?,@SocialUser_Mobile=?,@SocialUser_Email=?,@SocialUser_LastName=?,@Social_Cat_Id=?,@Social_SubCat_Id=?,@Social_Desc1=?,@Social_Desc2=?,@SocialUser_Product=?,@SocialGroup=?,@SocialName=?";
        $params     = [$this->SocialUserPro_Id
                        ,$this->User_NickNames
                        ,$this->SocialUser_Name
                        ,$this->SocialUser_Mobile
                        ,$this->SocialUser_Email
                        ,$this->SocialUser_LastName
                        ,$this->Social_Cat_Id
                        ,$this->Social_SubCat_Id
                        ,$this->Social_Desc1
                        ,$this->Social_Desc2
                        ,$this->SocialUser_Product
                        ,$this->SocialGroup
                        ,$this->SocialName];
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
}