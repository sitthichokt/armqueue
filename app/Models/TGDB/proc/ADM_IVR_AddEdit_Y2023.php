<?php

namespace App\Models\TGDB\proc;

use CodeIgniter\Model;

class ADM_IVR_AddEdit_Y2023 extends Model
{
    protected $DBGroup = 'tgdb';
    public $ScreenType          = '';
    public $action              = '';
    public $label               = '';
    public $message             = '';
    public $Order               = '';
    public $Status              = '';
    public $Color               = '';
    public $CustSocial_Id       = 0;
    public $IVR_Id              = '';
    public $Agent_Id            = '';
    public $IVR_start_date      = '';
    public $IVR_end_date        = '';
    public $IVR_EndDate_Message = '';
    public $IVR_EndDate_Message_Text = '';


    /**
     * @param CustSocial_Id
     * @param Agent_Id
     */
    public function list()
    {
        $storedProc = "EXEC ADM_IVR_AddEdit_Y2023 @ScreenType=?,@action=?,@label=?,@message=?,@Order=?,@Status=?,@Color=?,@CustSocial_Id=?,@IVR_Id=?,@Agent_Id=?,@IVR_start_date=?,@IVR_end_date=?,@IVR_EndDate_Message=?,@IVR_EndDate_Message_Text=?";
        $params     = ['LIST',
                        $this->action,
                        $this->label,
                        $this->message,
                        $this->Order,
                        $this->Status,
                        $this->Color,
                        $this->CustSocial_Id,
                        $this->IVR_Id,
                        $this->Agent_Id,
                        $this->IVR_start_date,
                        $this->IVR_end_date,
                        $this->IVR_EndDate_Message,
                        $this->IVR_EndDate_Message_Text];
        $query      = $this->db->query($storedProc, $params);
        $results    = $query->getResultArray();
        return $results; 
    }

    /**
     * @param action
     * @param label
     * @param message
     * @param Order
     * @param Status
     * @param Color
     * @param CustSocial_Id
     * @param Agent_Id
     * @param IVR_start_date
     * @param IVR_end_date
     * @param IVR_EndDate_Message
     */
    public function add()
    {
        $this->db->transOff();
        $this->db->transBegin();
        $storedProc = "EXEC ADM_IVR_AddEdit_Y2023 @ScreenType=?,@action=?,@label=?,@message=?,@Order=?,@Status=?,@Color=?,@CustSocial_Id=?,@IVR_Id=?,@Agent_Id=?,@IVR_start_date=?,@IVR_end_date=?,@IVR_EndDate_Message=?,@IVR_EndDate_Message_Text=?";
        $params     = ['ADD',
                        $this->action,
                        $this->label,
                        $this->message,
                        $this->Order,
                        $this->Status,
                        $this->Color,
                        $this->CustSocial_Id,
                        $this->IVR_Id,
                        $this->Agent_Id,
                        $this->IVR_start_date,
                        $this->IVR_end_date,
                        $this->IVR_EndDate_Message,
                        $this->IVR_EndDate_Message_Text];
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

       /**
     * @param action
     * @param label
     * @param message
     * @param Order
     * @param Status
     * @param Color
     * @param IVR_Id
     * @param Agent_Id
     * @param IVR_start_date
     * @param IVR_end_date
     * @param IVR_EndDate_Message
     */
    public function edit()
    {
        $this->db->transOff();
        $this->db->transBegin();
        $storedProc = "EXEC ADM_IVR_AddEdit_Y2023 @ScreenType=?,@action=?,@label=?,@message=?,@Order=?,@Status=?,@Color=?,@CustSocial_Id=?,@IVR_Id=?,@Agent_Id=?,@IVR_start_date=?,@IVR_end_date=?,@IVR_EndDate_Message=?,@IVR_EndDate_Message_Text=?";
        $params     = ['EDIT',
                        $this->action,
                        $this->label,
                        $this->message,
                        $this->Order,
                        $this->Status,
                        $this->Color,
                        $this->CustSocial_Id,
                        $this->IVR_Id,
                        $this->Agent_Id,
                        $this->IVR_start_date,
                        $this->IVR_end_date,
                        $this->IVR_EndDate_Message,
                        $this->IVR_EndDate_Message_Text];
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