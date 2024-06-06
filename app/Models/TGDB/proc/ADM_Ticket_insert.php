<?php

namespace App\Models\TGDB\proc;

use CodeIgniter\Model;

class ADM_Ticket_insert extends Model
{
    protected $DBGroup = 'tgdb';
    public $ScreenType;
    public $Ticket_Id ;
    public $CustUser_Id;
    public $Who_Comment;
    public $Message_Status;
    public $Line_Message;
    public $Line_CreateDate;
    public $Line_Reply_Token;
    public $Line_Reply_Date;

    /**
     * @param ScreenType
     * @param Ticket_Id 
     * @param CustUser_Id
     * @param Who_Comment
     * @param Message_Status
     * @param Line_Message
     * @param Line_CreateDate
     * @param Line_Reply_Token
     * @param Line_Reply_Date
     */
    public function inserts()
    {
        $this->db->transOff();
        $this->db->transBegin();
        $storedProc = "EXEC ADM_Ticket_insert   @ScreenType= ?, @Ticket_Id = ?, @CustUser_Id= ?, @Who_Comment= ?, @Message_Status= ?, @Line_Message= ?, @Line_CreateDate= ?, @Line_Reply_Token= ?, @Line_Reply_Date= ?";
        $params     = [$this->ScreenType
                    , $this->Ticket_Id 
                    , $this->CustUser_Id
                    , $this->Who_Comment
                    , $this->Message_Status
                    , $this->Line_Message
                    , $this->Line_CreateDate
                    , $this->Line_Reply_Token
                    , $this->Line_Reply_Date];
      
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