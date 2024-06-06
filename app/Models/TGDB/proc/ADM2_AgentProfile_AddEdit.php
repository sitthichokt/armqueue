<?php

namespace App\Models\TGDB\proc;

use CodeIgniter\Model;

/** ## select 
 * - list
*/
class ADM2_AgentProfile_AddEdit extends Model
{
    protected $DBGroup = 'tgdb';
    public $Agent_Id='';
    public $ScreenType='';
    public $Agent_Id_PK='';
    public $Agent_Name='';
    public $AGroup_Id='';
    public $Agent_Username='';
    public $Agent_Password='';
    public $Agent_Telephone='';
    public $Agent_Mobile='';
    public $Agent_Email='';
    public $Agent_StartDate='';
    public $Agent_EndDate='';
    public $Agent_Remark='';
    public $Agent_Status='';
    public $Agent_Picture='';
    public $Agent_Notification='';
    public $Agent_BlockMobile='';
    public $Agent_Lockscreen='';


    /**
     * @param Agent_Id
     * @param Agent_Name
     * @param AGroup_Id
     * @param Agent_Username
     * @param Agent_Password
     * @param Agent_Telephone
     * @param Agent_Mobile
     * @param Agent_Email
     * @param Agent_StartDate
     * @param Agent_EndDate
     * @param Agent_Status
     * @param Agent_Picture
     * @param Agent_Notification
     * @param Agent_BlockMobile
     * @param Agent_Lockscreen
     */
    public function add()
    {
        $storedProc = "EXEC ADM2_AgentProfile_AddEdit @Agent_Id=?,@ScreenType=?,@Agent_Id_PK=?,@Agent_Name=?,@AGroup_Id=?,@Agent_Username=?,@Agent_Password=?,@Agent_Telephone=?,@Agent_Mobile=?,@Agent_Email=?,@Agent_StartDate=?,@Agent_EndDate=?,@Agent_Remark=?,@Agent_Status=?,@Agent_Picture=?,@Agent_Notification=?,@Agent_BlockMobile=?,@Agent_Lockscreen=?";
        $params     = [$this->Agent_Id,
                        'ADD',
                        $this->Agent_Id_PK,
                        $this->Agent_Name,
                        $this->AGroup_Id,
                        $this->Agent_Username,
                        $this->Agent_Password,
                        $this->Agent_Telephone,
                        $this->Agent_Mobile,
                        $this->Agent_Email,
                        $this->Agent_StartDate,
                        $this->Agent_EndDate,
                        $this->Agent_Remark,
                        $this->Agent_Status,
                        $this->Agent_Picture,
                        $this->Agent_Notification,
                        $this->Agent_BlockMobile,
                        $this->Agent_Lockscreen];
        $query      = $this->db->query($storedProc, $params);
        $results    = $query->getRowArray();
        return $results;  
    }

    /**
     * @param Agent_Id
     * @param Agent_Id_PK
     */
    public function edit_get()
    {
        $storedProc = "EXEC ADM2_AgentProfile_AddEdit @Agent_Id=?,@ScreenType=?,@Agent_Id_PK=?,@Agent_Name=?,@AGroup_Id=?,@Agent_Username=?,@Agent_Password=?,@Agent_Telephone=?,@Agent_Mobile=?,@Agent_Email=?,@Agent_StartDate=?,@Agent_EndDate=?,@Agent_Remark=?,@Agent_Status=?,@Agent_Picture=?,@Agent_Notification=?,@Agent_BlockMobile=?,@Agent_Lockscreen=?";
        $params     = [$this->Agent_Id,
                        'List',
                        $this->Agent_Id_PK,
                        $this->Agent_Name,
                        $this->AGroup_Id,
                        $this->Agent_Username,
                        $this->Agent_Password,
                        $this->Agent_Telephone,
                        $this->Agent_Mobile,
                        $this->Agent_Email,
                        $this->Agent_StartDate,
                        $this->Agent_EndDate,
                        $this->Agent_Remark,
                        $this->Agent_Status,
                        $this->Agent_Picture,
                        $this->Agent_Notification,
                        $this->Agent_BlockMobile,
                        $this->Agent_Lockscreen];
        $query      = $this->db->query($storedProc, $params);
        $results    = $query->getRowArray();
        return $results;  
    }

    /**
     * @param Agent_Id
     * @param Agent_Id_PK
     * @param Agent_Name
     * @param AGroup_Id
     * @param Agent_Username
     * @param Agent_Password
     * @param Agent_Telephone
     * @param Agent_Mobile
     * @param Agent_Email
     * @param Agent_StartDate
     * @param Agent_EndDate
     * @param Agent_Status
     * @param Agent_Picture
     * @param Agent_Notification
     * @param Agent_BlockMobile
     * @param Agent_Lockscreen
     */
    public function edit_save()
    {
        $storedProc = "EXEC ADM2_AgentProfile_AddEdit @Agent_Id=?,@ScreenType=?,@Agent_Id_PK=?,@Agent_Name=?,@AGroup_Id=?,@Agent_Username=?,@Agent_Password=?,@Agent_Telephone=?,@Agent_Mobile=?,@Agent_Email=?,@Agent_StartDate=?,@Agent_EndDate=?,@Agent_Remark=?,@Agent_Status=?,@Agent_Picture=?,@Agent_Notification=?,@Agent_BlockMobile=?,@Agent_Lockscreen=?";
        $params     = [$this->Agent_Id,
                        'EDIT',
                        $this->Agent_Id_PK,
                        $this->Agent_Name,
                        $this->AGroup_Id,
                        $this->Agent_Username,
                        $this->Agent_Password,
                        $this->Agent_Telephone,
                        $this->Agent_Mobile,
                        $this->Agent_Email,
                        $this->Agent_StartDate,
                        $this->Agent_EndDate,
                        $this->Agent_Remark,
                        $this->Agent_Status,
                        $this->Agent_Picture,
                        $this->Agent_Notification,
                        $this->Agent_BlockMobile,
                        $this->Agent_Lockscreen];
        $query      = $this->db->query($storedProc, $params);
        $results    = $query->getRowArray();
        return $results;  
    }


}