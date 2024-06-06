<?php

namespace App\Models\TGDB\proc;

use CodeIgniter\Model;

class Ticket_PhoneCall_AddEdit extends Model
{
    protected $DBGroup = 'tgdb';

    public $p_Ticket_Id;
    public $p_CustUser_Id; 
    public $p_Agent_Id;
    public $p_Update_By;
    public $p_Ticket_Phone_Id;

    public $p_Sub_Comment = 0; 
    public $p_Who_Comment = 'C'; 
    public $p_Chat_Comment_Id = ''; 
    public $p_Message_Status = 'R'; 

    public $p_Phone_Number; 
    public $p_Phone_Message; 
    public $p_Channel_Id; 
    public $p_ContactChannel_Others = ''; 
    public $p_Media_Id; 
    public $p_Media_Sub_Id;
    public $p_Media_Others = ''; 

    public function add()
    {
        $storedProc = "EXEC Ticket_PhoneCall_AddEdit @ScreenType=? ,@p_Ticket_Id=? ,@p_Sub_Comment=? ,@p_CustUser_Id=? ,@p_Agent_Id=? ,@p_Who_Comment=? ,@p_Chat_Comment_Id=? ,@p_Message_Status=? ,@p_Phone_Number=? ,@p_Phone_Message=? ,@p_Channel_Id=? ,@p_Update_By=? ,@p_ContactChannel_Others=? ,@p_Media_Id=? ,@p_Media_Sub_Id=? ,@p_Media_Others=? ,@p_Ticket_Phone_Id=?";
        $params     = [
            'ADD'
            ,$this->p_Ticket_Id
            ,$this->p_Sub_Comment 
            ,$this->p_CustUser_Id 
            ,$this->p_Agent_Id 
            ,$this->p_Who_Comment 
            ,$this->p_Chat_Comment_Id 
            ,$this->p_Message_Status 
            ,$this->p_Phone_Number 
            ,$this->p_Phone_Message 
            ,$this->p_Channel_Id 
            ,$this->p_Update_By 
            ,$this->p_ContactChannel_Others 
            ,$this->p_Media_Id 
            ,$this->p_Media_Sub_Id 
            ,$this->p_Media_Others 
            ,$this->p_Ticket_Phone_Id
        ];
        $query      = $this->db->query($storedProc, $params);
        if ($this->db->transStatus() === false) {
            return false;
        } else {
            $this->db->transCommit();
            $results  = $query->getRowArray();
            unset($query);
            return $results['Ticket_Phone_Id'];
        }
    }

    public function edit()
    {
        $storedProc = "EXEC Ticket_PhoneCall_AddEdit @ScreenType=? ,@p_Ticket_Id=? ,@p_Sub_Comment=? ,@p_CustUser_Id=? ,@p_Agent_Id=? ,@p_Who_Comment=? ,@p_Chat_Comment_Id=? ,@p_Message_Status=? ,@p_Phone_Number=? ,@p_Phone_Message=? ,@p_Channel_Id=? ,@p_Update_By=? ,@p_ContactChannel_Others=? ,@p_Media_Id=? ,@p_Media_Sub_Id=? ,@p_Media_Others=? ,@p_Ticket_Phone_Id=?";
        $params     = [
            'EDIT'
            ,$this->p_Ticket_Id
            ,$this->p_Sub_Comment 
            ,$this->p_CustUser_Id 
            ,$this->p_Agent_Id 
            ,$this->p_Who_Comment 
            ,$this->p_Chat_Comment_Id 
            ,$this->p_Message_Status 
            ,$this->p_Phone_Number 
            ,$this->p_Phone_Message 
            ,$this->p_Channel_Id 
            ,$this->p_Update_By 
            ,$this->p_ContactChannel_Others 
            ,$this->p_Media_Id 
            ,$this->p_Media_Sub_Id 
            ,$this->p_Media_Others 
            ,$this->p_Ticket_Phone_Id
        ];
        $query      = $this->db->query($storedProc, $params);
        if ($this->db->transStatus() === false) {
            return false;
        } else {
            $this->db->transCommit();
            $results    = $query->getRowArray();
            unset($query);
            return $results['Ticket_Phone_Id'];
        }
    }
}
