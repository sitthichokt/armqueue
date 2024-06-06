<?php
namespace App\Models\TGDB\proc;
use CodeIgniter\Model;

class ADM4_PDPA_Message_AddEdit extends Model
{
    protected $DBGroup  = 'tgdb';
    public $Agent_Id            = 0;
    public $ScreenType          = '';
    public $CustSocial_Group    = '';
    public $Message_Id          = 0;
    public $Message_Name        = '';
    public $action_type         = '';
    public $action_text         = '';
    public $quick_reply         = '';
    public $action_label        = '';
    public $PDPA_Message_status = '';

    public function add()
    {
        $storedProc = "EXEC ADM4_PDPA_Message_AddEdit @Agent_Id=?,@ScreenType=?,@CustSocial_Group=?,@Message_Id=?,@Message_Name=?,@action_type=?,@action_text=?,@quick_reply=?,@action_label=?,@Status=?";
        $params     = [$this->Agent_Id,
                        'ADD',
                        $this->CustSocial_Group,
                        $this->Message_Id,
                        $this->Message_Name,
                        $this->action_type,
                        $this->action_text,
                        $this->quick_reply,
                        $this->action_label,
                        $this->PDPA_Message_status];
        $query      = $this->db->query($storedProc, $params);
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

    public function edit()
    {
        $storedProc = "EXEC ADM4_PDPA_Message_AddEdit @Agent_Id=?,@ScreenType=?,@CustSocial_Group=?,@Message_Id=?,@Message_Name=?,@action_type=?,@action_text=?,@quick_reply=?,@action_label=?,@Status=?";
        $params     = [$this->Agent_Id,
                        'EDIT',
                        $this->CustSocial_Group,
                        $this->Message_Id,
                        $this->Message_Name,
                        $this->action_type,
                        $this->action_text,
                        $this->quick_reply,
                        $this->action_label,
                        $this->PDPA_Message_status];
        $query      = $this->db->query($storedProc, $params);
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

    public function list()
    {
        $storedProc = "EXEC ADM4_PDPA_Message_AddEdit @Agent_Id=?,@ScreenType=?,@CustSocial_Group=?,@Message_Id=?,@Message_Name=?,@action_type=?,@action_text=?,@quick_reply=?,@action_label=?,@Status=?";
        $params     = [$this->Agent_Id,
                        'List',
                        $this->CustSocial_Group,
                        $this->Message_Id,
                        $this->Message_Name,
                        $this->action_type,
                        $this->action_text,
                        $this->quick_reply,
                        $this->action_label,
                        $this->PDPA_Message_status];
        $query      = $this->db->query($storedProc, $params);
        $results    = $query->getResultArray();
        
        unset($query,$storedProc,$params);
        return $results; 
    }

    public function del()
    {
        $storedProc = "EXEC ADM4_PDPA_Message_AddEdit @Agent_Id=?,@ScreenType=?,@CustSocial_Group=?,@Message_Id=?,@Message_Name=?,@action_type=?,@action_text=?,@quick_reply=?,@action_label=?,@Status=?";
        $params     = [$this->Agent_Id,
                        'DELETE',
                        $this->CustSocial_Group,
                        $this->Message_Id,
                        $this->Message_Name,
                        $this->action_type,
                        $this->action_text,
                        $this->quick_reply,
                        $this->action_label,
                        $this->PDPA_Message_status];
        $query      = $this->db->query($storedProc, $params);
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