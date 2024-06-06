<?php
namespace App\Controllers\webhook\line;
use App\Controllers\resources\C_python_chatbot;
use App\Models\TGDB\CustSocial_User;
use App\Models\TGDB\Ticket_Line;

class C_bot_ardibot 
{
    public function bot($line_message_text,$CustSocial_Id,$page_id,$ticket_id,$replytoken,$line_message_id){

        $data['user_q']         =  $line_message_text;
        $data['CustSocial_Id']  =  $CustSocial_Id;
        $json_message = json_encode($data);

        $python_chatbot = new C_python_chatbot();
        $python_chatbot->body = $json_message;
        $sent =  $python_chatbot->ardibot();

        if(!empty($sent) && !empty($line_message_id) && isset($sent->id,$line_message_id)){

          
            $Model_CustSocial_User   = new CustSocial_User();
            $Result_CustSocial_User = $Model_CustSocial_User->select('CustUser_Id')
                ->where('User_Id', $page_id)
                ->first();
            $CustUser_Id = $Result_CustSocial_User['CustUser_Id'];

                                        
                $data = [
                        'Ticket_Id' 	    => $ticket_id	 
                        ,'CustUser_Id' 		=>  $CustUser_Id
                        ,'Who_Comment' 		=> 'B'
                        ,'Message_Status'   =>'N'
                        ,'Line_Message'     => $sent->q
                        ,'Line_Reply_Token' => $replytoken
                        ,'Line_Reply_Date' 	=> ''
                        ,'Chat_Comment_Id' 	=> $line_message_id
                        ,'Parent_Id'=>0
                ];

                $Model_Ticket_Line = new Ticket_Line();
                $insert =  $Model_Ticket_Line->insert($data);


        }

        return $sent;
        
    }
}
