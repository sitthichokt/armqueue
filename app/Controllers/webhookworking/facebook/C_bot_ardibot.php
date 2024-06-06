<?php
namespace App\Controllers\webhookworking\facebook;
use App\Controllers\resources\C_python_chatbot;
use App\Models\TGDB\CustSocial_User;
use App\Models\TGDB\Ticket_FB;


class C_bot_ardibot 
{
    public function bot($message_text,$CustSocial_Id,$page_id,$ticket_id,$mid){

        $data['user_q']         =  $message_text;
        $data['CustSocial_Id']  =  $CustSocial_Id;
        $json_message = json_encode($data);

        $python_chatbot = new C_python_chatbot();
        $python_chatbot->body = $json_message;
        $sent =  $python_chatbot->ardibot();

        if(!empty($sent) && isset($sent->id)){
   
            $Model_CustSocial_User  = new CustSocial_User();
            $Result_CustSocial_User = $Model_CustSocial_User->select('CustUser_Id')
                ->where('User_Id', $page_id)
                ->first();
            $CustUser_Id = $Result_CustSocial_User['CustUser_Id'];
                     
                $data = [
                        'Ticket_Id' 	    => $ticket_id	 
                        ,'CustUser_Id' 		=>  $CustUser_Id
                        ,'Who_Comment' 		=> 'B'
                        ,'Message_Status'   => 'N'
                        ,'FB_Message'       => $sent->q
                        ,'Chat_Comment_Id' 	=> $mid
                        ,'Parent_Id'=>0
                ];

                $Model_Ticket_FB = new Ticket_FB();
                $insert =  $Model_Ticket_FB->insert($data);

        }

        return $sent;
        
    }
}