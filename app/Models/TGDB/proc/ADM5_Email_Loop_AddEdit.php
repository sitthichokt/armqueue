<?php

namespace App\Models\TGDB\proc;

use CodeIgniter\Model;

class ADM5_Email_Loop_AddEdit extends Model
{
    protected $DBGroup = 'tgdb';
    public $Agent_Id       = '';
    public $ScreenType     = '';
    public $CaseType       = '';
    public $CaseType_Sub_1 = '';
    public $CaseType_Sub_2 = '';
    public $Project_id     = '';
    public $Email_to       = '';
    public $Email_cc       = '';
    public $Email_bcc      = '';
    public $Edit_id        = '';
    public $status_s       = '';



    /**
     * @param Agent_Id
     * @param CaseType
     * @param CaseType_Sub_1
     * @param CaseType_Sub_2
     * @param Project_id
     * @param Email_to
     * @param Email_cc
     * @param Email_bcc
     * @param status_s
     */
    public function add()
    {
        $this->db->transOff();
        $this->db->transBegin();
        $storedProc = "EXEC ADM5_Email_Loop_AddEdit @Agent_Id=?,@ScreenType=?,@CaseType=?,@CaseType_Sub_1=?,@CaseType_Sub_2=?,@Project_id=?,@Email_to=?,@Email_cc=?,@Email_bcc=?,@Edit_id=?,@status_s=?";
        $params     = [$this->Agent_Id,
                        'ADD',
                        $this->CaseType,
                        $this->CaseType_Sub_1,
                        $this->CaseType_Sub_2,
                        $this->Project_id,
                        $this->Email_to,
                        $this->Email_cc,
                        $this->Email_bcc,
                        $this->Edit_id,
                        $this->status_s];
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
     * @param Agent_Id
     * @param CaseType
     * @param CaseType_Sub_1
     * @param CaseType_Sub_2
     * @param Project_id
     * @param Email_to
     * @param Email_cc
     * @param Email_bcc
     * @param Edit_id
     * @param status_s
     */
    public function edit()
    {
        $this->db->transOff();
        $this->db->transBegin();
        $storedProc = "EXEC ADM5_Email_Loop_AddEdit @Agent_Id=?,@ScreenType=?,@CaseType=?,@CaseType_Sub_1=?,@CaseType_Sub_2=?,@Project_id=?,@Email_to=?,@Email_cc=?,@Email_bcc=?,@Edit_id=?,@status_s=?";
        $params     = [$this->Agent_Id,
                        'EDIT',
                        $this->CaseType,
                        $this->CaseType_Sub_1,
                        $this->CaseType_Sub_2,
                        $this->Project_id,
                        $this->Email_to,
                        $this->Email_cc,
                        $this->Email_bcc,
                        $this->Edit_id,
                        $this->status_s];
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
     * @param Agent_Id
     * @param Edit_id
     */
    public function get()
    {
    
        $storedProc = "EXEC ADM5_Email_Loop_AddEdit @Agent_Id=?,@ScreenType=?,@CaseType=?,@CaseType_Sub_1=?,@CaseType_Sub_2=?,@Project_id=?,@Email_to=?,@Email_cc=?,@Email_bcc=?,@Edit_id=?,@status_s=?";
        $params     = [$this->Agent_Id,
                        'SHOWEDIT',
                        $this->CaseType,
                        $this->CaseType_Sub_1,
                        $this->CaseType_Sub_2,
                        $this->Project_id,
                        $this->Email_to,
                        $this->Email_cc,
                        $this->Email_bcc,
                        $this->Edit_id,
                        $this->status_s];
        $query  = $this->db->query($storedProc, $params);
        $results    = $query->getRowArray();
        unset($query,$storedProc);
        return $results;   
        
    }
}