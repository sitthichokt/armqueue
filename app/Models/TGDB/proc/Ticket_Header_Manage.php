<?php
namespace App\Models\TGDB\proc;
use CodeIgniter\Model;

/** นำเข้าข้อความ การสนทนา
 * - insert_herder
*/
class Ticket_Header_Manage extends Model
{
	protected $DBGroup = 'tgdb';
    public string $P_Action='';
    public  $P_Agent_Id='';
    public int $P_CustSocial_Id;
    public  $P_CustUser_Id='';
    public string $P_Chat_Id='';
    public string $P_Post_Id='';
    public  $P_Page_Create='';
    public string $P_Comment_Id='';
    public  $P_Page_CreateDate='';
    public  $P_Ticket_Ad='';
    public string $P_Ticket_Email_CC='';
    public string $P_Ticket_Email_To='';

    /** ## นำเข้าข้อความ
     * @param string P_Action WebHook, Delete, Reject, Close, Pending
     * @param int P_Agent_Id มีค่าทุกครั้งยกเว้น @P_Action=WebHook
     * @param int P_CustSocial_Id มีค่าทุกครั้ง เป็น ID ของ Page ที่สร้างไว้ในระบบ มาจาก Table ARCustomer_Social
     * @param int P_CustUser_Id มีค่าตอน @P_Action=WebHook เพราะมันคือข้อมูลลูกค้าที่ส่ง Chat/Post มาคุยกับPage มาจาก Table CustSocial_User
     * @param string P_Chat_Id ให้ใส่ Chat_Id ที่เป็นตัว unique ของ Chat ค่าจะเหมือนกับ Chat_Id ใน table CustSocial_Chat & CustSocial_Chat_Det ตัวโครงสร้างเก่า
     * @param string P_Post_Id ให้ใส่ Post_Id ที่เป็นตัว unique ของ Post ค่าจะเหมือนกับ Post_Id ใน table CustSocial_Post
     * @param bit P_Page_Create
     * @param string P_Comment_Id เพิ่มเติม ID ของข้อความเช่นใน CustSocial_Post_Det หรือของ Twitter/IG เพื่อตรวจสอบว่าเป็นข้อความเก่าที่เคยสร้างรายการไปแล้วถูกยิงมาใหม่หรือไม่ 
     * @param datetime P_Page_CreateDate
     * @param bit P_Ticket_Ad
     * @param string P_Ticket_Email_CC
     * @param string P_Ticket_Email_To
     */
    public function insert_herder() {
        $this->db->transOff();
        $this->db->transBegin();
		$storedProc = "EXEC Ticket_Header_Manage @P_Action= ?, @P_Agent_Id= ?, @P_CustSocial_Id= ?, @P_CustUser_Id= ?, @P_Chat_Id= ?, @P_Post_Id= ?, @P_Page_Create= ?, @P_Comment_Id= ?, @P_Page_CreateDate= ?, @P_Ticket_Ad= ?, @P_Ticket_Email_CC= ?, @P_Ticket_Email_To= ?";
		$params     = [  $this->P_Action
        ,$this->P_Agent_Id
        ,$this->P_CustSocial_Id
        ,$this->P_CustUser_Id
        ,$this->P_Chat_Id
        ,$this->P_Post_Id
        ,$this->P_Page_Create
        ,$this->P_Comment_Id
        ,$this->P_Page_CreateDate
        ,$this->P_Ticket_Ad
        ,$this->P_Ticket_Email_CC
        ,$this->P_Ticket_Email_To];
		$query      = $this->db->query($storedProc, $params);

        if ($this->db->transStatus() === false) {
            $results  = $this->db->error();
			//$this->db->transRollback();
			// //$this->db->close();	
            $results['ststus'] = false;
			return $results;
		} else {
			$results  = $query->getRowArray();  
			// $this->db->transCommit();
			// //$this->db->close();
            $results['ststus'] = true;
			return $results;
		}
		
	}

}