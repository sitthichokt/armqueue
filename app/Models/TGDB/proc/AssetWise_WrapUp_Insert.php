<?php

namespace App\Models\TGDB\proc;

use CodeIgniter\Model;

/** ## get id type  CaseType,subtype1,subtype2*/
class AssetWise_WrapUp_Insert extends Model
{
    protected $DBGroup = 'tgdb';

    public $ASW_WrapUp_Id;
    public $Ticket_id;
    public $AssetWise_ProductType;
    public $ASWProj_Id;
    public $ASWCaseType_L1_Id;
    public $ASWCaseType_L2_Id;
    public $ASWCaseType_L3_Id;
    public $AssetWise_ContactChannel;
    public $AGroup_Id;
    public $WrapUp_Note;
    public $WrapUp_CreateByAgent_Id;
    public $WrapUp_UpdateByAgent_Id;
    public $Appointment_Date;
    public $Appointment_TimeFR;
    public $Appointment_TimeTo;
    public $Grade;
    public $FollowUp;
    public $FType_Id;
    public $Follow_Note;
    public $PersonalAccept;
    public $ContactAccept;
    public $News_Accept;
    public $News_Language;
    public $News_Type_Array;
    public $News_Channel_Array;
    public $PDPA_Remark;

    /**
     * @param int ASW_WrapUp_Id
     * @param int Ticket_id
     * @param string 30 AssetWise_ProductType
     * @param int ASWProj_Id
     * @param int ASWCaseType_L1_Id
     * @param int ASWCaseType_L2_Id
     * @param int ASWCaseType_L3_Id
     * @param string 30 AssetWise_ContactChannel
     * @param int AGroup_Id
     * @param string WrapUp_Note
     * @param int WrapUp_CreateByAgent_Id
     * @param int WrapUp_UpdateByAgent_Id
     * @param string Appointment_Date
     * @param string Appointment_TimeFR
     * @param string Appointment_TimeTo
     * @param string 1 Grade
     * @param string 1 FollowUp
     * @param int FType_Id
     * @param string 1000 Follow_Note
     * @param int PersonalAccept
     * @param int ContactAccept
     * @param int News_Accept
     * @param string News_Language
     * @param string News_Type_Array
     * @param string News_Channel_Array
     * @param string PDPA_Remark
     */
    public function inserts()
    {
        $this->db->transOff();
        $this->db->transBegin();
        $storedProc = "EXEC AssetWise_WrapUp_Insert @ASW_WrapUp_Id= ?,@Ticket_id= ?,@AssetWise_ProductType= ?,@ASWProj_Id= ?,@ASWCaseType_L1_Id= ?,@ASWCaseType_L2_Id= ?,@ASWCaseType_L3_Id= ?,@AssetWise_ContactChannel= ?,@AGroup_Id= ?,@WrapUp_Note= ?,@WrapUp_CreateByAgent_Id= ?,@WrapUp_UpdateByAgent_Id= ?,@Appointment_Date= ?,@Appointment_TimeFR= ?,@Appointment_TimeTo= ?,@Grade= ?,@FollowUp= ?,@FType_Id= ?,@Follow_Note= ?,@PersonalAccept= ?,@ContactAccept= ?,@News_Accept= ?,@News_Language= ?,@News_Type_Array= ?,@News_Channel_Array= ?,@PDPA_Remark= ?";
        $params     = [  $this->ASW_WrapUp_Id
                        ,$this->Ticket_id
                        ,$this->AssetWise_ProductType
                        ,$this->ASWProj_Id
                        ,$this->ASWCaseType_L1_Id
                        ,$this->ASWCaseType_L2_Id
                        ,$this->ASWCaseType_L3_Id
                        ,$this->AssetWise_ContactChannel
                        ,$this->AGroup_Id
                        ,$this->WrapUp_Note
                        ,$this->WrapUp_CreateByAgent_Id
                        ,$this->WrapUp_UpdateByAgent_Id
                        ,$this->Appointment_Date
                        ,$this->Appointment_TimeFR
                        ,$this->Appointment_TimeTo
                        ,$this->Grade
                        ,$this->FollowUp
                        ,$this->FType_Id
                        ,$this->Follow_Note
                        ,$this->PersonalAccept
                        ,$this->ContactAccept
                        ,$this->News_Accept
                        ,$this->News_Language
                        ,$this->News_Type_Array
                        ,$this->News_Channel_Array
                        ,$this->PDPA_Remark];
      
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