<?php
namespace App\Models\TGDB\proc;
use CodeIgniter\Model;

/** นำเข้าข้อความ การสนทนา
 * - insert_mes
*/
class Ticket_Detail_Manage extends Model
{
	protected $DBGroup = 'tgdb';

    public $P_Action          = '';
    public $P_Ticket_Id       = '';
    public $Parent_Comment_Id = '';
    public $CustUser_Id       = '';
    public $Agent_Id          = '';
    public $Post_Comment_Id   = '';
    public $Chat_Comment_Id   = '';
    public $Message_Status    = '';
    public $Message           = '';
    public $Picture           = '';
    public $Line_Sticker_Id   = '';
    public $Line_Package_Id   = '';
    public $P_Who_comment     = '';
    public $P_Page_CreateDate = '';
    public $Subject           = '';
    public $Ticket_Email_CC   = '';
    public $Ticket_Email_To   = '';
    public $Line_Reply_Token  = '';
    public $Line_Reply_Date   = NULL;
    public $UIDL              = '';
    public $Set_Who_Comment   = '';
    public $html_entities     = true;

    /** ## นำเข้าข้อความ
     * @param string P_Action        มีค่าดังนี้  WebHook, Insert, Update, Delete  
     * @param int P_Ticket_Id       
     * @param string Parent_Comment_Id 
     * @param int CustUser_Id       
     * @param int Agent_Id          
     * @param string Post_Comment_Id   
     * @param string Chat_Comment_Id   
     * @param string Message_Status    มีค่า N=New , R=Read , D=Delete 
     * @param string Message           
     * @param string Picture           
     * @param string Line_Sticker_Id   
     * @param int Line_Package_Id   
     * @param int P_Who_comment     Program จะหาค่าให้ : มีค่า A=Agent , C-Customer, P-AdminPage
     * @param datetime P_Page_CreateDate 
     * @param string Subject           
     * @param string Ticket_Email_CC   
     * @param string Ticket_Email_To   
     * @param string Line_Reply_Token  
     * @param string Line_Reply_Date   
     * @param string UIDL 
     * @param string Set_Who_Comment 
     */
    public function insert_mes() {
        $this->db->transOff();
        $this->db->transBegin();
		$storedProc = "EXEC Ticket_Detail_Manage @P_Action= ?,@P_Ticket_Id= ?,@Parent_Comment_Id= ?,@CustUser_Id= ?,@Agent_Id= ?,@Post_Comment_Id= ?,@Chat_Comment_Id= ?,@Message_Status= ?,@Message= N?,@Picture= ?,@Line_Sticker_Id= ?,@Line_Package_Id= ?,@P_Who_comment= ?,@P_Page_CreateDate= ?,@Subject= ?,@Ticket_Email_CC= ?,@Ticket_Email_To= ?,@Line_Reply_Token= ?,@Line_Reply_Date= ?,@UIDL= ?,@Set_Who_Comment=?";
		$params     = [  $this->P_Action
                        ,$this->P_Ticket_Id
                        ,$this->Parent_Comment_Id 
                        ,$this->CustUser_Id
                        ,$this->Agent_Id
                        ,$this->Post_Comment_Id
                        ,$this->Chat_Comment_Id
                        ,$this->Message_Status
                        ,$this->html_entities === true ? htmlentities($this->Message) : $this->Message
                        ,$this->Picture
                        ,$this->Line_Sticker_Id
                        ,$this->Line_Package_Id
                        ,$this->P_Who_comment
                        ,$this->P_Page_CreateDate
                        ,$this->Subject
                        ,$this->Ticket_Email_CC
                        ,$this->Ticket_Email_To
                        ,$this->Line_Reply_Token
                        ,$this->Line_Reply_Date
                        ,$this->UIDL
                        ,$this->Set_Who_Comment];
		$query      = $this->db->query($storedProc, $params);

        if ($this->db->transStatus() === false) {
			//$this->db->transRollback();
			return false;
		} else {
			$results    = $query->getRowArray();  
			$this->db->transCommit();
			unset($query);	
			return $results;
		}
		
	}

}