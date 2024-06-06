<?php
namespace App\Models\TGDB\proc;
use CodeIgniter\Model;

/** แสดงจำนวนข้อความใหม่ของ FollowUp_Menu */
class Ticket_Show_ContactProfile extends Model
{
	protected $DBGroup = 'tgdb';
    public $ticket_id;
    public $custsocial_id;

    public function get() {
        $ticket_id = $this->ticket_id;
		$storedProc = "EXEC Ticket_Show_ContactProfile @Ticket_Id = ?";
		$params     = [$ticket_id];
		$query      = $this->db->query($storedProc, $params);
		$results    = $query->getResultArray();  
		return $results;		
	}

    public function getcontact() {
        $ticket_id      = $this->ticket_id;
        $custsocial_id  = $this->custsocial_id;
        $arcut_id       = session()->get('agent')['arcut_id'];
		$storedProc = "EXEC Ticket_Show_ContactProfile @Ticket_Id = ?";
		$params     = [$ticket_id];
		$query      = $this->db->query($storedProc, $params);
		$results    = $query->getResultArray(); 
        unset($query,$params,$storedProc,$ticket_id);
        $contact =[];
        foreach ($results as  $value) {
            if(is_null($value['CustUser_Id'])){
                continue;
            }

            if($value['chanel'] === 'PhoneCall'){
                $sql2 = "SELECT CustSocial_Name as Us_Name, CustSocial_Picture as User_Picture, CustSocial_Id as User_Id FROM ARCustomer_Social WHERE CustSocial_Id = {$value['CustUser_Id']}";
            }else{
                $sql2 = "SELECT *,case when len(ISNULL(User_ScreenName,User_Name))=0 then User_Name else User_ScreenName end  AS Us_Name FROM CustSocial_User  where CustUser_Id ={$value['CustUser_Id']} AND CustSocial_Id={$custsocial_id}";
            }

            $query2     = $this->db->query($sql2);
            $results2   = $query2->getRowArray();   
            
            if($results2){
                $Names  = '-';
                $Mobile = '-';
                if($value['chanel'] !== 'PhoneCall'){
                    $sql3        = "SELECT 'คุณ : '+isnull(SocialUser_Name,'-')+' '+isnull(SocialUser_LastName,'') Names,'เบอร์ติดต่อ : '+isnull(SocialUser_Mobile,'-') Mobile
                    from ARCust_SocialUser_Profile
                    where SocialUser_Id= '{$results2['User_Id']}' and ARCust_Id = {$arcut_id}";                      
                    $query3      = $this->db->query($sql3);
                    $results3    = $query3->getRowArray(); 

                    if(!empty($results3)){
                        $Names = $results3['Names']!=''?$results3['Names']:'-';
                        $Mobile = $results3['Mobile']!=''?$results3['Mobile']:'-';
                    }
                }
                
                $contact[]=[
                    'who'       =>$value['Who_Comment']
                    ,'chanel'   =>$value['chanel']
                    ,'userid'   =>$results2['User_Id']
                    ,'userimg'   =>$results2['User_Picture']
                    ,'username'   =>$results2['Us_Name']
                    ,'Contact_detail' => [
                        'name'    => $Names
                        ,'mobile' => $Mobile
                    ]         
                ];
            }
           
            unset($sql2, $query2, $results2, $sql3, $query3, $results3,$results, $value);
        }
          
		return $contact;		
	}


}