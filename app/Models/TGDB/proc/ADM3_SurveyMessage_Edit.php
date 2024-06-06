<?php

namespace App\Models\TGDB\proc;

use CodeIgniter\Model;

class ADM3_SurveyMessage_Edit extends Model
{
    protected $DBGroup = 'tgdb';
    public $Agent_Id     = '';
    public $ScreenType   = '';
    public $SurveyMsg_Id = '';
    public $Question     = '';
    public $Sore1        = '';
    public $Sore2        = '';
    public $Sore3        = '';
    public $Sore4        = '';
    public $Sore5        = '';
    public $Thank_text   = '';
    public $Logo_Survey  = '';
    public $Updateby     = '';
    public $Update_Date  = '';


    /**
     * @param Agent_Id
     * @param SurveyMsg_Id
     * @param Question
     * @param Sore1
     * @param Sore2
     * @param Sore3
     * @param Sore4
     * @param Sore5
     * @param Thank_text
     * @param Logo_Survey
     * @param Updateby
     * @param Update_Date
     */
    public function edit()
    {
        $this->db->transOff();
        $this->db->transBegin();
        $storedProc = "EXEC ADM3_SurveyMessage_Edit @Agent_Id=?,@ScreenType=?,@SurveyMsg_Id=?,@Question=?,@Sore1=?,@Sore2=?,@Sore3=?,@Sore4=?,@Sore5=?,@Thank_text=?,@Logo_Survey=?,@Updateby=?,@Update_Date=?";
        $params     = [$this->Agent_Id,
                        'EDIT',
                        $this->SurveyMsg_Id,
                        $this->Question,
                        $this->Sore1,
                        $this->Sore2,
                        $this->Sore3,
                        $this->Sore4,
                        $this->Sore5,
                        $this->Thank_text,
                        $this->Logo_Survey,
                        $this->Updateby,
                        $this->Update_Date];
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