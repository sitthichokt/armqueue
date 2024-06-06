<?php

namespace App\Controllers\webhookworking\facebook;

use App\Libraries\facebook\LFacebook;
use App\Models\TGDB\ARCustomer_Social;
use App\Models\TGDB\ARM_IVR;
use App\Models\TGDB\proc\Webhook_message_get;
use App\Models\TGDB\proc\Webhook_message_upd;
use App\Models\TGDB\Ticket_Header;
use CodeIgniter\I18n\Time;

class C_facebook 
{
    /**
     * 1 อัพเดท Webhook_tmp เมื่ออ่านข้อมูล
     * 2 เมื่ออัพเดท Webhook_tmp สำเร็จ
     * 3 จัดการ inbox
     * 4 จัดการ post
     */
    public $hookData ='';
    public function index()
    { 
        helper(['writable','filesystem']);

        if(!empty($this->hookData)){
                $hookdata_decode = $this->hookData;
                unset($this->hookData);
                //! ตรวจสอบเงื่อนไขที่ไม่ต้องการ           
                $this->TypeException($hookdata_decode);

                //! จัดการ inbox 
                if (!empty($hookdata_decode['entry'][0]['messaging'][0])) {
                                
                    //? sender     รหัสคนส่งข้อความ
                    //? recipient  รหัสคนรับข้อความ
                    //? $mid       รหัสข้อความ
                        
                    // Extracting required data from the hook data
                    $messaging    = $hookdata_decode['entry'][0]['messaging'][0];
                    $page_id      = $hookdata_decode['entry'][0]['id'];
                    $sender       = $messaging['sender']['id'];
                    $recipient    = $messaging['recipient']['id'];
                    $timestamp    = $messaging['timestamp'] / 1000;
                    // Checking for message and reply data
                    $message_data = $messaging['message'] ?? [];
                    $mid          = $message_data['mid'] ?? '';
                    $reply_to     = $message_data['reply_to']['mid'] ?? '';
                    $message_text = $message_data['text'] ?? '';
                    $IVR_Action_Assign = '';
                    $msg_ad = '';

                    // Handling cases where mid is empty
                    if (empty($mid)) {
                        // ตรวจสอบว่ามี referral ad_id ในการจัดส่งหรือไม่
                        if (!empty($messaging['referral']) && isset($messaging['referral']['ad_id'])) {
                            $mid = $messaging['referral']['ad_id'];
                        }
                        // ตรวจสอบว่ามี delivery mids ในการจัดส่งหรือไม่
                        if (isset($messaging['delivery']['mids'][0]) && !empty($messaging['delivery']['mids'][0])) {
                            $mid    = $messaging['delivery']['mids'][0];
                            $msg_ad = 'msg_ad';
                        }
                    }


                    $Model_ARCustomer_Social  = new ARCustomer_Social();
                    $Result_ARCustomer_Social = $Model_ARCustomer_Social->select('CustSocial_Id,ARCust_Id,CustSocial_Token')
                        ->where('CustSocial_Group', 'Facebook')
                        ->where('CustSocial_PageId', $page_id)
                        ->first();
                    if(empty($Result_ARCustomer_Social)){
                        //? ไม่มีข้อมูล ARCustomer_Social                                
                        $q = $Model_ARCustomer_Social->getLastQuery()->getQuery();
                        throw new \Exception('ไม่มีข้อมูล ARCustomer_Social : '.$q);                       
                    }

                    if(empty($Result_ARCustomer_Social['CustSocial_Id']) || empty($Result_ARCustomer_Social['ARCust_Id']) || empty($Result_ARCustomer_Social['CustSocial_Token'])){
                        //? ไม่มีข้อมูล ARCustomer_Social 
                        $q = $Model_ARCustomer_Social->getLastQuery()->getQuery();
                        throw new \Exception('collumn ไม่มีข้อมูล ARCustomer_Social : '.$q); 
                    }
                    
                    $CustSocial_Id      = $Result_ARCustomer_Social['CustSocial_Id'];
                    $arcut_id           = $Result_ARCustomer_Social['ARCust_Id'];
                    $token              = $Result_ARCustomer_Social['CustSocial_Token'];
                    unset($Model_ARCustomer_Social, $Result_ARCustomer_Social);

                    //! จัดการข้อมูล
                    $result = $this->processMessaging($messaging, $token, $reply_to, $sender, $recipient, $page_id, $CustSocial_Id, $arcut_id,$mid,$msg_ad);
                    $type = $result['type'];
                    $data = $result['data'];

                    //! ส่งข้อความ
                    $facebook_messager = new C_facebook_messager();
                    $respons_messager = $facebook_messager->messager($type, $data, $page_id, $sender, $recipient, $mid, $timestamp, $IVR_Action_Assign);

                    if (!empty($respons_messager) && isset($respons_messager['ticket_id']) && $respons_messager['ticket_id'] != '') {
                        $ticket_id = $respons_messager['ticket_id'];
                        $Query     = $respons_messager['Query'];

                        //! PDPA
                        $status = 'NO';
                        if (!empty($Query) && $Query === 'insert') {
                            $pdpa = new C_facebook_pdpa();
                            $status = $pdpa->pdpa($CustSocial_Id, $ticket_id);
                        }

                        if ($status === 'YES') {
                            $pdpa->pdpasent($message_text, $CustSocial_Id, $page_id, $ticket_id, $sender, $token);
                        }

                        unset($pdpa, $status);

                        //! BOT
                        $Model_ARCustomer_Social = new ARCustomer_Social();
                        $Data_ARCustomer_Social = $Model_ARCustomer_Social->select('Chatbot_First')
                            ->where('CustSocial_Id', $CustSocial_Id)
                            ->first();
                        unset($Model_ARCustomer_Social);

                        if (!empty($Data_ARCustomer_Social) && isset($Data_ARCustomer_Social['Chatbot_First']) && $Data_ARCustomer_Social['Chatbot_First'] === 1) {
                            $this->processBot($ticket_id, $sender, $page_id, $token, $message_text,$CustSocial_Id,$mid);
                            return true;
                        }

                        //! IVR
                        $ivr = new C_facebook_ivr();
                        $status = $ivr->ivr($CustSocial_Id);
                        if ($status === 1) {
                            $ivr->ivrsent($message_text, $CustSocial_Id, $page_id, $ticket_id, $sender, $token);
                        }
                        unset($ivr);
                    }
                    
                    return true;
                }

            return true;

                       
        }else{
            throw new \Exception('json ไม่มีข้อมูล'); 
        }

    }

   
    // /**  */
    private function TypeException($json){
        if (isset($json['entry'][0]['changes'][0]['value']['reaction_type'])) {
            throw new \Exception('กรณีเป็น like reaction_type บลาๆๆ ไม่ต้องทำ'); 
        }
        if(isset($json['entry'][0]['messaging'][0]['read']['watermark'])){
            throw new \Exception('เข้าเงื่อนไข read->watermark  ไม่ต้องทำ'); 
        }
    }

    private function processMessaging($messaging, $token, $reply_to, $sender, $recipient, $page_id, $CustSocial_Id, $arcut_id,$mid,$msg_ad) {
        $data = '';
        $type = '';
    
        if (isset($messaging['message']['text'])) {
            $type = 'text';
            $data = $this->processTextMessage($messaging['message'], $reply_to, $token);
        } elseif (isset($messaging['postback'])) {
            $type = 'text';
            $data = $this->processPostback($messaging['postback'], $token, $sender, $page_id);
        } elseif (isset($messaging['message']['attachments'][0]['payload']['url'])) {
            $type = $messaging['message']['attachments'][0]['type'];
            $data = $this->processAttachments($type, $messaging['message']['attachments'], $CustSocial_Id, $arcut_id);
        } elseif (isset($messaging['referral'])) {
            $type = 'text';
            $data = $this->processReferral($messaging['referral']);
        } elseif (isset($msg_ad) && $msg_ad=='msg_ad') {
            $type = 'text';
            $data = '<button class="btn btn-success m-0" id="fb_broadcast_get" data-mid="'.$mid.'">ดูข้อความ broadcast</button>';
        }

        if (empty($type)) {
            //! ไม่มีข้อมูล type
            throw new \Exception('ไม่สามารถกำหนดประเภทของข้อมูลได้ เช่นไม่ทราบว่าเป็นข้อความหรือไฟล์ หรืออยู่นอกเงื่อนไข');
        }
        if (empty($mid)) {
            //! ไม่มีข้อมูล mid 
            throw new \Exception('ไม่มี mid รหัสอ้างอิงชุดข้อความ');
        }
    
        return compact('type', 'data');
    }
    
    private function processTextMessage($message, $reply_to, $token) {
        $data = '';
    
        if ($reply_to != '') {
            $facebook = new LFacebook();
            $facebook->accesstoken = $token;
            $facebook->reply_to    = $reply_to;
            $reply_to_msg = $facebook->messenger_replyto();
    
            if ($reply_to_msg['status'] === true && $reply_to_msg['message'] != '') {
                $data .= '<div class="reply_to">ตอบกลับ : ' . htmlentities($reply_to_msg['message']) . '</div><br>';
            }
        }
    
        if (isset($message['metadata'])) {
            parse_str($message['metadata'], $metadatakParams);
    
            if (isset($metadatakParams['ivr_click']) && $metadatakParams['ivr_click'] == 'true') {
                $type = 'bot';
            }
        }
    
        $data .= htmlentities($message['text']);
        return $data;
    }
    
    private function processPostback($postback, $token, $sender, $page_id) {
        $data = '';
    
        if (isset($postback['payload']) && $postback['payload'] != '') {
            $data = $postback['title'];
            $postback_data = $postback['payload'];
    
            parse_str($postback_data, $postbackParams);
    
            if (isset($postbackParams['ivr_id'])) {
                $Model_ARM_IVR = new ARM_IVR();
                $data_ivr = $Model_ARM_IVR->select('ARM_IVR_Action.IVR_Action_Assign,ARM_IVR.IVR_Message,ARM_IVR.IVR_EndDate_Message,ARM_IVR.IVR_EndDate_Message_Text')
                    ->join('ARM_IVR_Action', 'ARM_IVR.IVR_Action_Id = ARM_IVR_Action.IVR_Action_Id', 'left')
                    ->where('ARM_IVR.IVR_Id', $postbackParams['ivr_id'])
                    ->first();
    
                if (!empty($data_ivr) && isset($data_ivr['IVR_Action_Assign'], $data_ivr['IVR_Message'])) {
                    $IVR_EndDate_Message = date("Y-m-d", strtotime($data_ivr['IVR_EndDate_Message']));
                    $date_now = date("Y-m-d");
    
                    $LFacebook = new LFacebook();
                    $LFacebook->accesstoken = $token;
    
                    if (isset($data_ivr['IVR_EndDate_Message']) && $data_ivr['IVR_EndDate_Message'] != '' && $IVR_EndDate_Message < $date_now) {
                        $IVR_EndDate_Message_Text = $data_ivr['IVR_EndDate_Message_Text'] != '' ? $data_ivr['IVR_EndDate_Message_Text'] : 'รายการนี้หมดอายุ';
                        $LFacebook->recipient_id = $sender;
                        $LFacebook->message_text = $IVR_EndDate_Message_Text;
                        $LFacebook->page_id = $page_id;
                        $LFacebook->metadata = 'ivr_click=true';
                        $datass = $LFacebook->messenger_send_message();
                        $mid = $datass['message_id'];
                    } else {
                        $LFacebook->recipient_id = $sender;
                        $LFacebook->message_text = $data_ivr['IVR_Message'];
                        $LFacebook->page_id = $page_id;
                        $LFacebook->metadata = 'ivr_click=true';
                        $datass = $LFacebook->messenger_send_message();
                        $mid = $datass['message_id'];
                        $IVR_Action_Assign = $data_ivr['IVR_Action_Assign'];
                    }
    
                    $type = 'text_ivr';
                }
            }
    
            if ($mid === "") {
                if (!empty($postback['mid']) && isset($postback['mid'])) {
                    $mid = $postback['mid'];
                }
            }
        }
    
        return $data;
    }
    
    private function processAttachments($type, $attachments, $CustSocial_Id, $arcut_id) {
        // type ที่เจอ video,audio,image,file,fallback
        $types = array("video","audio","image","file");
        if (!in_array($type, $types)){
            throw new \Exception('ประเภทที่ไม่กำหนดเงื่อนไขการทำงาน :'.$type);
        }
        $facebook_upload = new C_facebook_upload();
        return $facebook_upload->upload($type, $attachments, $CustSocial_Id, $arcut_id);
    }
    
    private function processReferral($referral) {
        $data = '';
    
        if (isset($referral['type'], $referral['ads_context_data']) && $referral['type'] === "OPEN_THREAD") {
            $data .= $referral['ads_context_data']['ad_title'];
        }
    
        if (isset($referral['ads_context_data']['post_id'])) {
            $data .= '<br><a target="_blank" href="https://www.facebook.com/'.$referral['ads_context_data']['post_id'].'">ที่มาข้อความ</a>';
        }
    
        return $data;
    }

    private function processBot($ticket_id, $sender, $page_id, $token,$message_text,$CustSocial_Id,$mid ) {

        //! bot_answers
        $bot_answers = new C_bot_answers();
        $sentbot = $bot_answers->bot($ticket_id, $sender, $page_id, $token, '');
    
        if ($sentbot === true) {
            unset($bot_answers);
            return true;
        }
    
        //! ardibot
        $bot_ardibot = new C_bot_ardibot();
        $bot_ardibot_sent = $bot_ardibot->bot($message_text, $CustSocial_Id, $page_id, $ticket_id, $mid);
        $bot_answers->bot($ticket_id, $sender, $token, $page_id, $bot_ardibot_sent, true);
        unset($bot_ardibot, $bot_answers);
       
        return true;
    }
}
