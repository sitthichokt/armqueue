<?php

namespace App\Models\TGDB\proc;
use CodeIgniter\Model;

class Ticket_TAB_CustomerMerge_AddEdit extends Model
{
    protected $DBGroup = 'tgdb';
    public $Agent_Id            = '';
    public $ScreenType          = '';
    public $SocialUserPro_Id    = 0;
    public $MergeGroup_Id       = 0;
    public $SocialUser_Name     = '';
    public $SocialUser_LastName = '';
    public $User_NickName       = '';
    public $User_Mobile         = '';
    public $User_Email          = '';
    public $User_Product        = '';
    public $Social_Cat_Id       = '';
    public $Social_SubCat_Id    = '';
    public $Social_Desc1        = '';
    public $Social_Desc2        = '';


    /**
     * @param int Agent_Id
     * @param int SocialUserPro_Id
     * @param string SocialUser_Name
     * @param string SocialUser_LastName
     * @param string User_NickName
     * @param string User_Mobile
     * @param string User_Email
     * @param string User_Product
     * @param int Social_Cat_Id
     * @param int Social_SubCat_Id
     * @param string Social_Desc1
     * @param string Social_Desc2
     */
    public function add()
    {
        $this->db->transOff();
        $this->db->transBegin();
        $storedProc = "EXEC Ticket_TAB_CustomerMerge_AddEdit @Agent_Id=?,@ScreenType=?,@SocialUserPro_Id=?,@MergeGroup_Id=?,@SocialUser_Name=?,@SocialUser_LastName=?,@User_NickName=?,@User_Mobile=?,@User_Email=?,@User_Product=?,@Social_Cat_Id=?,@Social_SubCat_Id=?,@Social_Desc1=?,@Social_Desc2=?";
        $params     = [$this->Agent_Id,
                        'ADD',
                        $this->SocialUserPro_Id,
                        $this->MergeGroup_Id,
                        $this->SocialUser_Name,
                        $this->SocialUser_LastName,
                        $this->User_NickName,
                        $this->User_Mobile,
                        $this->User_Email,
                        $this->User_Product,
                        $this->Social_Cat_Id,
                        $this->Social_SubCat_Id,
                        $this->Social_Desc1,
                        $this->Social_Desc2];
        $query      = $this->db->query($storedProc, $params);

        if ($this->db->transStatus() === false) {
            //$this->db->transRollback();
            //$this->db->close();
            return false;
        } else {
            $this->db->transCommit();
            //$this->db->close();
            unset($storedProc, $params, $query);
            return true;
        }
    }

      /**
     * @param int Agent_Id
     * @param int MergeGroup_Id
     * @param string SocialUser_Name
     * @param string SocialUser_LastName
     * @param string User_NickName
     * @param string User_Mobile
     * @param string User_Email
     * @param string User_Product
     * @param int Social_Cat_Id
     * @param int Social_SubCat_Id
     * @param string Social_Desc1
     * @param string Social_Desc2
     */
    public function edit()
    {
        $this->db->transOff();
        $this->db->transBegin();
        $storedProc = "EXEC Ticket_TAB_CustomerMerge_AddEdit @Agent_Id=?,@ScreenType=?,@SocialUserPro_Id=?,@MergeGroup_Id=?,@SocialUser_Name=?,@SocialUser_LastName=?,@User_NickName=?,@User_Mobile=?,@User_Email=?,@User_Product=?,@Social_Cat_Id=?,@Social_SubCat_Id=?,@Social_Desc1=?,@Social_Desc2=?";
        $params     = [$this->Agent_Id,
                        'EDIT',
                        $this->SocialUserPro_Id,
                        $this->MergeGroup_Id,
                        $this->SocialUser_Name,
                        $this->SocialUser_LastName,
                        $this->User_NickName,
                        $this->User_Mobile,
                        $this->User_Email,
                        $this->User_Product,
                        $this->Social_Cat_Id,
                        $this->Social_SubCat_Id,
                        $this->Social_Desc1,
                        $this->Social_Desc2];
        $query      = $this->db->query($storedProc, $params);

        if ($this->db->transStatus() === false) {
            //$this->db->transRollback();
            //$this->db->close();
            return false;
        } else {
            $this->db->transCommit();
            //$this->db->close();
            unset($storedProc, $params, $query);
            return true;
        }
    }
}
