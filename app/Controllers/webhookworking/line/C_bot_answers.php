<?php

namespace App\Controllers\webhook\line;

use App\Controllers\resources\C_linebot_api;
use App\Libraries\Line\LLine;
use App\Models\TGDB\ARCustomer_Social;
use App\Models\TGDB\proc\Ticket_CallChatBot_V2;
use App\Models\TGDB\Ticket_Line;


class C_bot_answers 
{
    public function bot($ticket_id, $replytoken,$message,$no=false,$user_id='')
    {

        $botstatus = false;
        $Model_Ticket_Line  = new Ticket_Line();
        $Result_Ticket_Line = $Model_Ticket_Line->select('Ticket_Line_Id')
            ->where('Ticket_Id', $ticket_id)
            ->first();

        $Model_Ticket_CallChatBot_V2 = new Ticket_CallChatBot_V2();
        $Model_Ticket_CallChatBot_V2->Ticket_Id = $ticket_id;
        $Model_Ticket_CallChatBot_V2->Ticket_Detail_Id =  $Result_Ticket_Line['Ticket_Line_Id'];
        $chatbot        = $Model_Ticket_CallChatBot_V2->get();

        if (!empty($chatbot)) {
            $CustSocial_Id  = !empty($chatbot['CustSocial_Id']) ? $chatbot['CustSocial_Id'] : '';
            $status         = !empty($chatbot['Chatbot']) ? $chatbot['Chatbot'] : '';
            $Line_UserId    = !empty($chatbot['Line_UserId']) ? $chatbot['Line_UserId'] : '';
            $pattern_ids    = !empty($chatbot['pattern_ids']) ? $chatbot['pattern_ids'] : '';

            if ($status === 'YES') {
                $data['pattern_ids']    = '(' . $pattern_ids . ')';
                $data['replyToken']     = $replytoken;
                $array['CustSocial_Id'] = $CustSocial_Id;
                $array['userId']        = $Line_UserId;
                $array['events']        = [$data];
                $json_message = json_encode($array);

                $linebot_api = new C_linebot_api();
                $linebot_api->body = $json_message;
                $sent = $linebot_api->bot_answers();
                $botstatus = true;
            }else{
                if($no === true){
                    if(!empty($message) && isset($message->q)){

                        $Model_ARCustomer_Social    =  new ARCustomer_Social();
                        $Result_ARCustomer_Social   =  $Model_ARCustomer_Social->select('CustSocial_Token')
                            ->where('CustSocial_Id', $CustSocial_Id)
                            ->first();
                        $token_page =   $Result_ARCustomer_Social['CustSocial_Token'];
                        unset($Model_ARCustomer_Social, $Result_ARCustomer_Social);

                        $line = new LLine();
                        $line->accesstoken  = $token_page;
                        $line->reply_token  = $replytoken;
                        $line->message_text = $message->q;
                        $Sent_replyText = $line->replyText();
                        
                        if(!empty($Sent_replyText) && isset($Sent_replyText['status'],$Sent_replyText['message']) && $Sent_replyText['status']===false && $Sent_replyText['message']==='{"message":"Invalid reply token"}'){

                            if(!empty($token_page)){
                                $line->accesstoken  = $token_page;
                                $line->recipient_id = $user_id;
                                $line->push_message();
                            }
                            
                        }
                    }
                }
               
     
            }
        }

        return $botstatus;
    }
}
