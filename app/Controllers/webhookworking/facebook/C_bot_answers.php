<?php

namespace App\Controllers\webhookworking\facebook;

use App\Controllers\resources\C_facebookbot_api;
use App\Libraries\facebook\LFacebook;
use App\Models\TGDB\proc\Ticket_CallChatBot_V2;
use App\Models\TGDB\Ticket_FB;


class C_bot_answers 
{
    public function bot($ticket_id,$sender,$page_id,$token,$message ,$no=false)
    {

        $botstatus = false;
        $Model_Ticket_FB  = new Ticket_FB();
        $Result_Ticket_FB = $Model_Ticket_FB->select('Ticket_FB_Id')
            ->where('Ticket_Id', $ticket_id)
            ->first();

        $Model_Ticket_CallChatBot_V2 = new Ticket_CallChatBot_V2();
        $Model_Ticket_CallChatBot_V2->Ticket_Id = $ticket_id;
        $Model_Ticket_CallChatBot_V2->Ticket_Detail_Id =  $Result_Ticket_FB['Ticket_FB_Id'];
        $chatbot        = $Model_Ticket_CallChatBot_V2->get();

        if (!empty($chatbot)) {
            $CustSocial_Id  = !empty($chatbot['CustSocial_Id']) ? $chatbot['CustSocial_Id'] : '';
            $status         = !empty($chatbot['Chatbot']) ? $chatbot['Chatbot'] : '';
            $Line_UserId    = !empty($chatbot['Line_UserId']) ? $chatbot['Line_UserId'] : '';
            $pattern_ids    = !empty($chatbot['pattern_ids']) ? $chatbot['pattern_ids'] : '';

            if ($status === 'YES') {

                $data['CustSocial_Id'] = $CustSocial_Id;
                $date['events'][] = ['pattern_ids'=>'(' . $pattern_ids . ')','recipient'=>$sender];
                $json_message = json_encode($date);

                $facebookbot_api       = new C_facebookbot_api();
                $facebookbot_api->body = $json_message;
                $sent = $facebookbot_api->bot_answers();
                $botstatus = true;
            }
            else{
                if($no === true){
                    if(!empty($message) && isset($message->q)){
                        $LFacebook = new LFacebook();
                        $LFacebook->accesstoken  = $token;
                        $LFacebook->recipient_id = $sender;
                        $LFacebook->message_text = $message->q;
                        $LFacebook->page_id      = $page_id;
                        $LFacebook->messenger_send_message();
                    }

                   
                }
            }
        }

        return $botstatus;
    }
}
