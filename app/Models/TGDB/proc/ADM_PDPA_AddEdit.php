<?php

namespace App\Models\TGDB\proc;

use CodeIgniter\Model;

class ADM_PDPA_AddEdit extends Model
{
    protected $DBGroup = 'tgdb';
    public $ScreenType='';
    public $ARCust_Id='';
    public $action='';
    public $label='';
    public $message='';
    public $Order='';
    public $Status='';
    public $Color='';
    public $CustSocial_Id='';
    public $PDPA_Id='';

    /**
     *@param ARCust_Id
     *@param action
     *@param label
     *@param message
     *@param Order
     *@param Status
     *@param Color
     *@param CustSocial_Id
     */
    public function add()
    {
        $this->db->transOff();
        $this->db->transBegin();
        $storedProc = "EXEC ADM_PDPA_AddEdit  @ScreenType=?,@ARCust_Id=?,@action=?,@label=?,@message=?,@Order=?,@Status=?,@Color=?,@CustSocial_Id=?,@PDPA_Id=?";
        $params     = ['ADD',
                        $this->ARCust_Id,
                        $this->action,
                        $this->label,
                        $this->message,
                        $this->Order,
                        $this->Status,
                        $this->Color,
                        $this->CustSocial_Id,
                        $this->PDPA_Id];
      
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
     *@param ARCust_Id
     *@param action
     *@param label
     *@param message
     *@param Order
     *@param Status
     *@param Color
     *@param PDPA_Id
     */
    public function edit()
    {
        $this->db->transOff();
        $this->db->transBegin();
        $storedProc = "EXEC ADM_PDPA_AddEdit  @ScreenType=?,@ARCust_Id=?,@action=?,@label=?,@message=?,@Order=?,@Status=?,@Color=?,@CustSocial_Id=?,@PDPA_Id=?";
        $params     = ['EDIT',
                        $this->ARCust_Id,
                        $this->action,
                        $this->label,
                        $this->message,
                        $this->Order,
                        $this->Status,
                        $this->Color,
                        0,
                        $this->PDPA_Id];
      
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