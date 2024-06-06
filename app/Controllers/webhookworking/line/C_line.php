<?php

namespace App\Controllers\webhook\line;

use App\Libraries\Line\LLine;
use App\Models\TGDB\ARCustomer_Social;
use App\Models\TGDB\proc\Webhook_message_get;
use App\Models\TGDB\proc\Webhook_message_upd;

class C_line 
{
    /** 
     *todo อัพเดท Webhook_tmp เมื่ออ่านข้อมูล 
     *todo เมื่ออัพเดท Webhook_tmp สำเร็จ
     *todo decode jason to array จาก Webhook_tmp 
     *todo บันทึกข้อความ
     *todo PDPA
     *todo BOT
     *todo IVR
     *todo อัพเดท Status Webhook_tmp 
     */
    public function index()
    {
        helper('writable');

        $PROC_Webhook_message_get = new Webhook_message_get();
        $PROC_Webhook_message_get->ScreenType = 'Line';
        $Result = $PROC_Webhook_message_get->get();
        unset($PROC_Webhook_message_get);

        if(!empty($Result)){
            foreach ($Result as $Result_Webhook_tmp) {      
                if (!empty($Result_Webhook_tmp) && isset($Result_Webhook_tmp['hookMessage'], $Result_Webhook_tmp['hookId'])) {

                    //! อัพเดท Webhook_tmp เมื่ออ่านข้อมูล 
                    $hookId = $Result_Webhook_tmp['hookId'];
                    $input  = $Result_Webhook_tmp['hookMessage'];
                    $data = $this->Webhook_tmp_get_upd($hookId);
                    unset($Result_Webhook_tmp);

                    //! เมื่ออัพเดท Webhook_tmp สำเร็จ
                    if ($data === true) {

                        //! decode jason to array จาก Webhook_tmp 
                        $hookdata_decode     = json_decode($input, true);
                        unset($input, $data);

                        /**
                         * ? line_type บอกถึง แชทส่วนตัว หรือ กลุ่ม
                         * ? line_message_type บอกถึง ประเภทข้อความเช่น text,img...
                         * ? line_message_id   บอกถึง รหัสของข้อความ (อ้างอิงข้อความ)
                         * ? line_userid รหัสของสมาชิก
                         *  */
                        $line_type               = !empty($hookdata_decode['events'][0]['source']['type']) ? $hookdata_decode['events'][0]['source']['type'] : '';
                        $line_case_type          = !empty($hookdata_decode['events'][0]['type']) ? $hookdata_decode['events'][0]['type'] : '';
                        $line_message_type       = !empty($hookdata_decode['events'][0]['message']['type']) ? $hookdata_decode['events'][0]['message']['type'] : '';
                        $line_message_timestamp  = !empty($hookdata_decode['events'][0]['timestamp']) ? ($hookdata_decode['events'][0]['timestamp'] / 1000) : '';
                        $line_message_id         = !empty($hookdata_decode['events'][0]['message']['id']) ? $hookdata_decode['events'][0]['message']['id'] : '';
                        $user_id                 = !empty($hookdata_decode['events'][0]['source']['userId']) ? $hookdata_decode['events'][0]['source']['userId'] : '';
                        $page_id                 = !empty($hookdata_decode['destination']) ? $hookdata_decode['destination'] : '';
                        $group_id                = !empty($hookdata_decode['events'][0]['source']['groupId']) ? $hookdata_decode['events'][0]['source']['groupId'] : '';
                        $replytoken              = !empty($hookdata_decode['events'][0]['replyToken']) ? $hookdata_decode['events'][0]['replyToken'] : '';

                        $line_message_fileName       = !empty($hookdata_decode['events'][0]['message']['fileName']) ? $hookdata_decode['events'][0]['message']['fileName'] : '';
                        $line_message_text       = !empty($hookdata_decode['events'][0]['message']['text']) ? $hookdata_decode['events'][0]['message']['text'] : '';
                        $line_message_emojis     = !empty($hookdata_decode['events'][0]['message']['emojis']) ? $hookdata_decode['events'][0]['message']['emojis'] : '';
                        $line_message_stickerId  = !empty($hookdata_decode['events'][0]['message']['stickerId']) ? $hookdata_decode['events'][0]['message']['stickerId'] : '';
                        $line_message_text       = !empty($hookdata_decode['events'][0]['message']['address']) ? $hookdata_decode['events'][0]['message']['address'] : $line_message_text;
                        $isRedelivery            = isset($hookdata_decode['events'][0]['deliveryContext']['isRedelivery']) ? $hookdata_decode['events'][0]['deliveryContext']['isRedelivery'] : true;
                        
                        $postback_data           = !empty($hookdata_decode['events'][0]['postback']['data'])  ? $hookdata_decode['events'][0]['postback']['data'] : '';

                        $line_message_timestamp  = time();

                        if($line_type === 'group' && $line_case_type === 'message'){
                            $page_id = $group_id != '' ? $group_id : $page_id;
                        }
                       

                        $Model_ARCustomer_Social  = new ARCustomer_Social();
                        $Result_ARCustomer_Social = $Model_ARCustomer_Social->select('CustSocial_Id,ARCust_Id,CustSocial_Token')
                            ->where('CustSocial_Group', 'Line')
                            ->where('CustSocial_PageId', $page_id)
                            ->first();

                        unset($hookdata_decode, $Model_ARCustomer_Social);

                        if (!empty($Result_ARCustomer_Social)) {

                            $CustSocial_Id      = $Result_ARCustomer_Social['CustSocial_Id'];
                            $arcut_id           = $Result_ARCustomer_Social['ARCust_Id'];
                            $token              = $Result_ARCustomer_Social['CustSocial_Token'];

                            if ($line_case_type === 'message' || $line_case_type === 'postback') {
                                if(isset($line_case_type) && $line_case_type !='' && $line_case_type === 'postback'){
                                    $line_message_type = $line_case_type;
                                }
                            

                                //! บันทึกข้อความ
                                switch ($line_type) {
                                    case 'user':
                                        $line_profile = new C_line_profile();
                                        $custuser_id  = $line_profile->check_profile($CustSocial_Id, $user_id, $token, $page_id);

                                        $line_messager_user = new C_line_messager();
                                        $respons = $line_messager_user->messager(
                                            $line_message_type,
                                            $line_message_fileName,
                                            $line_message_text,
                                            $line_message_emojis,
                                            $line_message_id,
                                            $line_message_stickerId,
                                            $line_message_id,
                                            $custuser_id,
                                            $user_id,
                                            $page_id,
                                            $line_message_timestamp,
                                            '',
                                            $postback_data,
                                            $replytoken 
                                        );
                                        unset($line_profile, $line_messager_user);

                                        break;
                                    case 'group':
                                        $line_profile = new C_line_profile();
                                        $custuser_id  = $line_profile->check_profile($CustSocial_Id, $user_id, $token, $page_id);
                                        $custuser_id2  = $line_profile->check_profile_group($CustSocial_Id, $page_id,$page_id, $token, $page_id);

                                        $line_messager_user = new C_line_messager();
                                        $respons = $line_messager_user->messager(
                                            $line_message_type,
                                            $line_message_fileName,
                                            $line_message_text,
                                            $line_message_emojis,
                                            $line_message_id,
                                            $line_message_stickerId,
                                            $line_message_id,
                                            $custuser_id,
                                            $page_id,
                                            $page_id,
                                            $line_message_timestamp,
                                            $custuser_id2
                                        );
                                        unset($line_profile, $line_messager_user);
                                        break;
                                }


                                if (!empty($respons) && isset($respons['ticket_id']) && $respons['ticket_id'] != '') {
                                    $ticket_id = $respons['ticket_id'];
                                    unset($respons);

                                    //! PDPA
                                    $pdpa   = new C_line_pdpa();
                                    $status = $pdpa->pdpa($CustSocial_Id, $ticket_id);
                                    if ($status === 'YES') {
                                        $pdpa->pdpasent($line_message_text, $CustSocial_Id, $page_id, $ticket_id, $replytoken, $line_message_timestamp,$user_id);
                                    }
                                    unset($pdpa);

                                    //! BOT
                                    if ($isRedelivery === false) {
                                        $Model_ARCustomer_Social = new ARCustomer_Social();
                                        $Data_ARCustomer_Social = $Model_ARCustomer_Social->select('Chatbot_First')
                                            ->where('CustSocial_Id', $CustSocial_Id)
                                            ->first();
                                        unset($Model_ARCustomer_Social);

                                        if (!empty($Data_ARCustomer_Social) && isset($Data_ARCustomer_Social['Chatbot_First']) && $Data_ARCustomer_Social['Chatbot_First'] === 1) {
                                            //! bot_answers
                                            $bot_answers  = new C_bot_answers();
                                            $sentbot = $bot_answers->bot($ticket_id, $replytoken,'',$user_id);
                                            if ($sentbot === true) {
                                                unset($bot_answers);
                                                //! อัพเดท Status Webhook_tmp 
                                                $this->Webhook_tmp_status_upd($hookId);
                                                unset($hookId);

                                                // if($return===true){
                                                //     return;
                                                // }else{
                                                //     exit;
                                                // }

                                                continue;
                                                
                                            }

                                            //! ardibot
                                            $bot_ardibot = new C_bot_ardibot();
                                            $bot_ardibot_sent = $bot_ardibot->bot($line_message_text, $CustSocial_Id, $page_id, $ticket_id, $replytoken, $line_message_id);
                                            $bot_answers->bot($ticket_id, $replytoken,$bot_ardibot_sent,true);
                                            unset($bot_ardibot, $bot_answers);

                                            //! อัพเดท Status Webhook_tmp 
                                            $this->Webhook_tmp_status_upd($hookId);
                                            unset($hookId);
                                            // if($return===true){
                                            //         return;
                                            //     }else{
                                            //         exit;
                                            //     }
                                                continue;
                                        }
                                        unset($Data_ARCustomer_Social);
                                    }

                                    //! IVR
                                    $ivr = new C_line_ivr();
                                    $status =  $ivr->ivr($CustSocial_Id);
                                    if ($status === 1) {
                                        $ivr->ivrsent($line_message_text, $CustSocial_Id, $page_id, $ticket_id, $replytoken, $line_message_timestamp,$user_id);
                                    }
                                    unset($ivr);
                                } else {
                                    //เกิดข้อผิดพลาดไม่สามารถบันทึกข้อมูล
                                }

                                //! อัพเดท Status Webhook_tmp 
                                $this->Webhook_tmp_status_upd($hookId);
                                unset($hookId);

                                // if($return===true){
                                //     return;
                                // }else{
                                //     exit;
                                // }
                                continue;
                            }

                            if ($line_type === 'group' && $line_case_type === 'join') {

                                $Model_ARCustomer_Social  = new ARCustomer_Social();
                                $Result_ARCustomer_Social = $Model_ARCustomer_Social->select('CustSocial_Id,ARCust_Id,CustSocial_Token')
                                    ->where('CustSocial_Group', 'Line')
                                    ->where('CustSocial_PageId', $page_id)
                                    ->first();
                                unset($hookdata_decode, $Model_ARCustomer_Social);
                                $token              = $Result_ARCustomer_Social['CustSocial_Token'];
                                $ARCust_Id          = $Result_ARCustomer_Social['ARCust_Id'];

                                $line = new LLine();
                                $line->accesstoken = $token;
                                $line->groupId     = $group_id;
                                $group = $line->get_profile_group();

                                if (!empty($group) && $group['status'] === true) {
                                    $groupId    = $group['groupId'];
                                    $groupName  = $group['groupName'];
                                    $pictureUrl = $group['pictureUrl'];

                                    $Model_ARCustomer_Social = new ARCustomer_Social();
                                    $data =  [
                                        'ARCust_Id'             => $ARCust_Id
                                        , 'CustSocial_Group'     => 'Line'
                                        , 'CustSocial_Name'      => $groupName
                                        , 'CustSocial_Picture'   => $pictureUrl
                                        , 'CustSocial_PageId'    => $groupId
                                        , 'CustSocial_Token'     => $token
                                        , 'CustSocial_Status'    => 1
                                        , 'CustSocial_LineGroup' => 1
                                    ];
                                    $insert = $Model_ARCustomer_Social->insert($data);

                                    if ($insert) {                              
                                        $line->reply_token  = $replytoken;
                                        $line->message_text = 'การเชื่อมโยงกลุ่ม ' . $groupName . ' กับ ARMShare สำเร็จ ขั้นตอนถัดไป Assign Agent Project';
                                        $line->replyText();
                                    }
                                }

                            }
                        } else {

                            if(isset($line_message_type,$replytoken,$line_message_text,$page_id) && !empty($page_id) && !empty($line_message_text) && !empty($line_message_type) && $line_message_type==='text'){
                                // helper("filesystem");
                                $message 		= $line_message_text;
                                $replacetxt 	= explode(" ",$message);
                                switch ($replacetxt[0]) {
                                    case 'getchannelid':
                                        $line = new LLine();
                                        $line->accesstoken    = $replacetxt[2];
                                        $line->reply_token    = $replytoken;
                                        $line->channel_secret = $replacetxt[1];
                                        $line->message_text   = $page_id;
                                        $ff = $line->replyText(); 
                                        // write_file(WRITEPATH. "logs/data-1.txt", json_encode($ff,true));                              
                                    break;
                                }
                            }
                            //ไม่มีเพจ
                        }

                        //! อัพเดท Status Webhook_tmp 
                        $this->Webhook_tmp_status_upd($hookId);
                        unset($hookId);
                    }
                }
            }
        }
        unset($Result);

    }

    private function Webhook_tmp_get_upd($hookId)
    {
        // อัพเดท Webhook_tmp เมื่ออ่านข้อมูล
        if (!empty($hookId)) {
            $PRCO_Webhook_message_upd = new Webhook_message_upd();
            $PRCO_Webhook_message_upd->ScreenType  = 'Date';
            $PRCO_Webhook_message_upd->hookId      = $hookId;
            $status = $PRCO_Webhook_message_upd->upd();
            unset($PRCO_Webhook_message_upd);
            if ($status === true) {
                return true;
            } else {
                return false;
            }
        }
    }

    private function Webhook_tmp_status_upd($hookId)
    {
        // อัพเดท Webhook_tmp เมื่อทำงานเสร็จ
        if (!empty($hookId)) {
            $PRCO_Webhook_message_upd = new Webhook_message_upd();
            $PRCO_Webhook_message_upd->ScreenType  = 'Status';
            $PRCO_Webhook_message_upd->hookId      = $hookId;
            $status = $PRCO_Webhook_message_upd->upd();
            unset($PRCO_Webhook_message_upd);
            return $status;
        }
    }
}
