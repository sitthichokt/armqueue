<?php

namespace App\Controllers\webhook\line;


use App\Libraries\Line\LLine;
use App\Models\ARMLOG\Ticket_PopUp;
use App\Models\TGDB\ARCust_SocialProfile_Picture;
use App\Models\TGDB\ARCustomer_Social;
use App\Models\TGDB\ARM_IVR;
use App\Models\TGDB\CustSocial_User;
use App\Models\TGDB\proc\ARM_IVR_AssignGroup;
use App\Models\TGDB\Ticket_Line_Attachment;
use CodeIgniter\I18n\Time;

class C_line_messager 
{
    public function messager($type, $line_message_fileName,$message, $emojis, $messageId, $line_message_stickerId, $message_id, $custuser_id, $user_id, $page_id, $timestamp, $custuser_id_forgroup = '', $postback_data = '', $replytoken = '')
    {
        // helper('filesystem');
        $Model_ARCustomer_Social = new ARCustomer_Social();
        $Result_ARCustomer_Social = $Model_ARCustomer_Social->select('ARCust_Id,CustSocial_Id,CustSocial_PageId,CustSocial_Name,CustSocial_Name,CustSocial_Picture,CustSocial_Token')
            ->where('CustSocial_Group', 'Line')
            ->where('CustSocial_PageId', $page_id)
            ->first();
        if (!empty($Result_ARCustomer_Social)) {

            $CustSocial_Id      =   $Result_ARCustomer_Social['CustSocial_Id'];
            $CustSocial_PageId  =   $Result_ARCustomer_Social['CustSocial_PageId'];
            $CustSocial_Name    =   $Result_ARCustomer_Social['CustSocial_Name'];
            $base64             =   $Result_ARCustomer_Social['CustSocial_Picture'];
            $CustSocial_Token   =   $Result_ARCustomer_Social['CustSocial_Token'];
            $arcut_id           =   $Result_ARCustomer_Social['ARCust_Id'];
            unset($Model_ARCustomer_Social, $Result_ARCustomer_Social);
            // ตรวจสอบเพจ จากฐานข้อมูลสมาชิก
            $Model_CustSocial_User  = new CustSocial_User();
            $Numrow_CustSocial_User = $Model_CustSocial_User
                ->where('User_Id', $page_id)
                ->where('CustSocial_Id', $CustSocial_Id)
                ->countAllResults();

            if ($Numrow_CustSocial_User === 0) {

                // สร้างภาพ กรณีไม่มีบัญชีใน CustSocial_User
                $ln = new LLine();
                $ln->accesstoken    = $CustSocial_Token;
                $ln->channel_secret = $CustSocial_PageId;
                $profile = $ln->get_profile_page();
                $imageData    = isset($profile['pictureUrl'])?$profile['pictureUrl']:'';

                $upload = new C_line_upload();
                $imagePage = $upload->uploadProfile($imageData, $arcut_id, $CustSocial_Id, 'page');
                $imageUser = $upload->uploadProfile($imageData, $arcut_id, $CustSocial_Id, 'user');
                unset($upload);

                // บันทึกข้อมูล page เข้าตาราง CustSocial_User
                $Model_CustSocial_User   = new CustSocial_User();
                $data = [
                    "CustSocial_Id"    => $CustSocial_Id,
                    "User_Id"          => $CustSocial_PageId,
                    "User_Name"        => $CustSocial_Name,
                    "User_ScreenName"  => $CustSocial_Name,
                    "User_Picture"     => $imageUser['url']
                ];
                $id = $Model_CustSocial_User->insert($data);

                // อัพเดทภาพเข้าต้นทาง ARCustomer_Social
                $Model_ARCustomer_Social = new ARCustomer_Social();
                $Model_ARCustomer_Social->set('CustSocial_Picture', $imagePage['url'])
                    ->where('CustSocial_Group', 'Line')
                    ->where('CustSocial_PageId', $page_id)
                    ->update();
                unset($data, $Model_CustSocial_User, $Model_ARCustomer_Social);
                // insert เก็บ part เข้าตาราง ARCust_SocialProfile_Picture
                $ARCust_SocialProfile_Picture = new ARCust_SocialProfile_Picture();
                $data = [
                    [
                        "Picture_CustType"       => 'page',
                        "CustUser_Id"         => null,
                        "CustSocial_Id"       => $CustSocial_Id,
                        "Picture_OldName"     => '',
                        "Picture_NewName"     => $imagePage['filename'],
                        "Picture_Part"        => $imagePage['part'],
                        "Picture_Type"        => 'jpg',
                        "Picture_Status"      => 1
                    ],
                    [
                        "Picture_CustType"    => 'user',
                        "CustUser_Id"         => $id,
                        "CustSocial_Id"       => $CustSocial_Id,
                        "Picture_OldName"     => '',
                        "Picture_NewName"     => $imageUser['filename'],
                        "Picture_Part"        => $imageUser['part'],
                        "Picture_Type"        => 'jpg',
                        "Picture_Status"      => 1
                    ]
                ];
                $ARCust_SocialProfile_Picture->insertBatch($data);

                unset($ARCust_SocialProfile_Picture, $Numrow_CustSocial_User, $data,  $CustSocial_Name, $Picture_url, $imageData, $base64, $dmy);
            } else {

                unset($Model_CustSocial_User, $Numrow_CustSocial_User, $CustSocial_Name, $Picture_url, $imageData, $filename, $outputFolder, $base64, $dmy);
            }
        } else {
            // ไม่เจอเพจนี้ในฐานข้อมูล
            return false;
        }


        /** จัดการข้อความ */
        $url = [];
        $text = !empty($message) ? $message : '';

        switch ($type) {
            case 'location':
            case 'text':
                if (!empty($emojis) && isset($emojis)) {
                    $text_entities = htmlentities($message);
                    $emoji_all = [];
                    foreach($emojis as $v){
                        $emoji_all[$v['productId']][] = [
                            'emojiId'       => $v['emojiId'],
                            'text_emoji'    => mb_substr($text, $v['index'], $v['length'])
                        ];
                    }

                    $replace = new C_line_replaceemojis();
                    $text =  $replace->replaceEmojis_array($text_entities, $emoji_all);
                    // $message = $replace->replaceEmojis($text, $emojis);
                }else{
                    $text = htmlentities($message);
                }

             
                break;

            case 'postback':

                if (!empty($postback_data) && isset($postback_data)) {

                    parse_str($postback_data, $postbackParams);
                    // ตรวจสอบค่า action ว่าเท่ากับ "buy" หรือไม่
                    if (isset($postbackParams['ivr_id'])) {
                        $Model_ARM_IVR = new ARM_IVR();
                        $data_ivr = $Model_ARM_IVR->select('ARM_IVR_Action.IVR_Action_Assign,ARM_IVR.IVR_Message,ARM_IVR.IVR_Label,ARM_IVR.IVR_EndDate_Message,ARM_IVR.IVR_EndDate_Message_Text')
                            ->join('ARM_IVR_Action', 'ARM_IVR.IVR_Action_Id = ARM_IVR_Action.IVR_Action_Id', 'left')
                            ->where('ARM_IVR.IVR_Id', $postbackParams['ivr_id'])
                            ->first();
                        if (!empty($data_ivr) && isset($data_ivr['IVR_Action_Assign'], $data_ivr['IVR_Message'])) {

                            $Libary_LLine = new LLine();
                            $Libary_LLine->accesstoken = $CustSocial_Token;
                            $Libary_LLine->reply_token = $replytoken;
                            $IVR_EndDate_Message = date("Y-m-d", strtotime($data_ivr['IVR_EndDate_Message']));
                            $date_now = date("Y-m-d");

                            if (isset($data_ivr['IVR_EndDate_Message']) && $data_ivr['IVR_EndDate_Message'] != '' && $IVR_EndDate_Message < $date_now) {
                                $IVR_EndDate_Message_Text = $data_ivr['IVR_EndDate_Message_Text'] != '' ? $data_ivr['IVR_EndDate_Message_Text'] : 'รายการนี้หมดอายุ';
                                $Libary_LLine->message_text = $IVR_EndDate_Message_Text;
                                $Libary_LLine->replyText();
                                $ivr_postback_status = true;
                                $ivr_postback_bot = true;
                                $text = $IVR_EndDate_Message_Text;
                                $text_ivr_click = $data_ivr['IVR_Label'];
                            } else {
                                $Libary_LLine->message_text = $data_ivr['IVR_Message'];
                                $Libary_LLine->replyText();
                                $ivr_postback_status = true;
                                $ivr_postback_bot = true;
                                $IVR_Action_Assign = $data_ivr['IVR_Action_Assign'];
                                $text = $data_ivr['IVR_Message'];
                                $text_ivr_click = $data_ivr['IVR_Label'];
                            }
                        }
                    }
                } else {
                    $text =  'ผู้ใช้งานกดปิดการสนทนา';
                }

                break;

            case 'sticker':
                $file_url = "https://stickershop.line-scdn.net/stickershop/v1/sticker/" . $line_message_stickerId . "/android/sticker.png";

                $url[] =     [
                    'url'        => $file_url, 'part'      => '', 'part_del'  => '', 'type'      => 'sticker', 'extension' => '', 'oldname'   => '', 'newname'   => ''
                ];

                break;

            case 'image':
                $line = new LLine();
                $line->accesstoken   = $CustSocial_Token;
                $line->channel_secret =$CustSocial_PageId;
                $line->messageId = $messageId;
                $img = $line->getMessageContent();

                $upload = new C_line_upload();
                if(!empty($img['message'])){
                    $url = $upload->upload_img($img['message'], $arcut_id, $CustSocial_Id);
                    if($url===false){
                        $text = '<button class="btn btn-primary btn-sm" id="line_load_img" data-id="'.$message_id.'" data-page="'.$CustSocial_Id.'" data-user="'.$custuser_id.'"> ภาพเสียหาย โหลดใหม่ </button>';  
                    }
                }
                // else{
                //     continue;
                // }
               
                break;

            case 'video':
                $line = new LLine();
                $line->accesstoken = $CustSocial_Token;
                $line->channel_secret =$CustSocial_PageId;
                $line->messageId = $messageId;
                $vdo = $line->getMessageContent();

                $upload = new C_line_upload();
                $url = $upload->upload_vdo($vdo['message'], $arcut_id, $CustSocial_Id);
                break;

            case 'audio':
                $line = new LLine();
                $line->accesstoken = $CustSocial_Token;
                $line->channel_secret =$CustSocial_PageId;
                $line->messageId = $messageId;
                $audio = $line->getMessageContent();

                $upload = new C_line_upload();
                $url = $upload->upload_audio($audio['message'], $arcut_id, $CustSocial_Id);
                break;
            case 'file':
                $line = new LLine();
                $line->accesstoken = $CustSocial_Token;
                $line->channel_secret =$CustSocial_PageId;
                $line->messageId = $messageId;
                $img = $line->getMessageContent();

                $upload = new C_line_upload();
                if(!empty($img['message']) && isset($img['status'])){
                    if($img['status']===true){
                        $url = $upload->upload_file($img['message'], $arcut_id, $CustSocial_Id,$line_message_fileName);
                        if($url===false){
                            $text = '<button class="btn btn-primary btn-sm" id="line_load_file" data-id="'.$message_id.'" data-page="'.$CustSocial_Id.'" data-user="'.$custuser_id.'"> ไฟล์เสียหาย โหลดใหม่ </button>';  
                        }
                    }else{
                        $text = '<button class="btn btn-primary btn-sm" id="line_load_file" data-id="'.$message_id.'" data-page="'.$CustSocial_Id.'" data-user="'.$custuser_id.'"> ไฟล์เสียหาย โหลดใหม่ </button>';
                    }
                    
                }
                // else{
                //     continue;
                // }         
                break;

        }


        Time::now('Asia/Bangkok', 'th');
        $date_now = Time::createFromTimestamp(intval($timestamp), 'Asia/Bangkok', 'th');
        $date_now_tostring      = $date_now->toDateTimeString();
        $Chat_Id = 'gen_' . $page_id . '_' . $user_id;

        $PROC_Ticket_Header_Manage = new  \App\Models\TGDB\proc\Ticket_Header_Manage;
        $PROC_Ticket_Header_Manage->P_Action          = 'WebHook';
        $PROC_Ticket_Header_Manage->P_CustSocial_Id   = $CustSocial_Id;
        $PROC_Ticket_Header_Manage->P_CustUser_Id     = !empty($custuser_id_forgroup) ? $custuser_id_forgroup : $custuser_id;
        $PROC_Ticket_Header_Manage->P_Chat_Id         = $Chat_Id;
        $PROC_Ticket_Header_Manage->P_Page_Create     = 0;
        $PROC_Ticket_Header_Manage->P_Comment_Id      = $Chat_Id;
        $PROC_Ticket_Header_Manage->P_Page_CreateDate  = $date_now_tostring;
        $respons_insert_herder = $PROC_Ticket_Header_Manage->insert_herder();
        unset($PROC_Ticket_Header_Manage, $page_id, $recipient_id);

        $PROC_Ticket_Detail_Manage = new  \App\Models\TGDB\proc\Ticket_Detail_Manage;

        if (isset($ivr_postback_status, $text_ivr_click) &&  $ivr_postback_status === true) {
            $PROC_Ticket_Detail_Manage->P_Action          = 'WebHook';
            $PROC_Ticket_Detail_Manage->P_Ticket_Id       = $respons_insert_herder['Ticket_Id'];
            $PROC_Ticket_Detail_Manage->CustUser_Id       = $custuser_id;
            $PROC_Ticket_Detail_Manage->Chat_Comment_Id   = $message_id;
            $PROC_Ticket_Detail_Manage->Message_Status    = 'N';
            $PROC_Ticket_Detail_Manage->Message           = $text_ivr_click;
            $PROC_Ticket_Detail_Manage->Picture           = '';
            $PROC_Ticket_Detail_Manage->P_Who_comment     = 'C';
            $PROC_Ticket_Detail_Manage->P_Page_CreateDate = $date_now_tostring;
            $PROC_Ticket_Detail_Manage->insert_mes();
            $Model_CustSocial_User   = new CustSocial_User();
            $Numrow_CustSocial_User  = $Model_CustSocial_User->select('CustUser_Id')
                ->where('User_Id', $CustSocial_PageId)
                ->where('CustSocial_Id', $CustSocial_Id)
                ->first();
            $custuser_id = $Numrow_CustSocial_User['CustUser_Id'];
        }

        $PROC_Ticket_Detail_Manage->P_Action          = 'WebHook';
        $PROC_Ticket_Detail_Manage->P_Ticket_Id       = $respons_insert_herder['Ticket_Id'];
        $PROC_Ticket_Detail_Manage->CustUser_Id       = $custuser_id;
        $PROC_Ticket_Detail_Manage->Chat_Comment_Id   = $message_id;
        $PROC_Ticket_Detail_Manage->Message_Status    = 'N';
        $PROC_Ticket_Detail_Manage->Message           = $text;
        $PROC_Ticket_Detail_Manage->Picture           = ($type != 'text' && $type != 'location' && $type != 'postback') ? 'true' : '';
        $PROC_Ticket_Detail_Manage->P_Who_comment     = isset($ivr_postback_bot) && $ivr_postback_bot === true ? 'B' : 'C';
        $PROC_Ticket_Detail_Manage->P_Page_CreateDate = $date_now_tostring;
        $PROC_Ticket_Detail_Manage->html_entities     = false;
        $respons_insert_mes = $PROC_Ticket_Detail_Manage->insert_mes();


        if (isset($ivr_postback_status, $IVR_Action_Assign, $respons_insert_mes['Ticket_Id']) && $ivr_postback_status === true && $IVR_Action_Assign != '') {
            $PROC_ARM_IVR_AssignGroup = new ARM_IVR_AssignGroup();
            $PROC_ARM_IVR_AssignGroup->AGroup_Id = $IVR_Action_Assign;
            $PROC_ARM_IVR_AssignGroup->Ticket_Id = $respons_insert_mes['Ticket_Id'];
            $Assign = $PROC_ARM_IVR_AssignGroup->Assign();
            if(!empty($Assign) && isset($Assign['AssignAgent_Id']) && $Assign['AssignAgent_Id']!=0 && $Assign['AssignAgent_Id']!=''){
                $Model_Ticket_PopUp = new Ticket_PopUp();          
                $data = [
                    'Ticket_Id'     => $respons_insert_mes['Ticket_Id'], 
                    'Ticket_FB_Id'     => $respons_insert_mes['Ticket_FB_Id'], 
                    'FB_CreateDate'   => $date_now_tostring, 
                    'Ticket_Type'   => 'new_inbox', 
                    'PopUp'         => 0
                ];
                $Model_Ticket_PopUp->insert($data);
            }
        }


        if (!empty($respons_insert_mes) && !empty($url) && isset($respons_insert_mes['Query'], $respons_insert_mes['Ticket_FB_Id']) && $respons_insert_mes['Query'] === 'insert' && $type != 'text' && $type != 'location' && $type != 'postback') {
            $Model_Ticket_Line_Attachment = new Ticket_Line_Attachment();
            if (is_array($url)) {
                foreach ($url as $value) {
                    $data_ins[] = [
                        'Ticket_Id'           => $respons_insert_mes['Ticket_Id'], 'Ticket_Line_Id'     => $respons_insert_mes['Ticket_FB_Id'], 'Line_Att_Url'       => $value['url'], 'Line_Att_Part'      => $value['part'], 'Line_Att_OldName'   => $value['oldname'], 'Line_Att_NewName'   => $value['newname'], 'Line_Att_Type'      => $value['type'], 'Line_Att_extension' => $value['extension'], 'Line_Att_status'    => 1
                    ];
                }
                $Model_Ticket_Line_Attachment->insertBatch($data_ins);
            }
        }

        if (!empty($respons_insert_mes) && !empty($url) && isset($respons_insert_mes['Ticket_FB_Id']) && $type != 'text') {
            if (is_array($url) && $respons_insert_mes['Query'] === null) {

                foreach ($url as  $value) {
                    if (isset($value['part_del'])) {
                        $del_path = WRITEPATH . $value['part_del']; // เส้นทางที่ต้องการลบ
                        if (is_dir($del_path)) {
                            if ($type === 'image') {
                                delete_files($del_path, TRUE);
                                rmdir($del_path);
                            } else {
                                unlink($del_path . $value['newname']);
                            }
                        }
                    }
                }
            }
        }




        unset($respons_insert_herder, $PROC_Ticket_Detail_Manage, $date_now_tostring);

        $data['ticket_id'] = $respons_insert_mes['Ticket_Id'];
        $data['ticket_detail_id'] = $respons_insert_mes['Ticket_FB_Id'];
        $data['status']    = true;

        return $data;
    }
}
