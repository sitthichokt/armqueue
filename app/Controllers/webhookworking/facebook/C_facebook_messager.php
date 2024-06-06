<?php

namespace App\Controllers\webhookworking\facebook;

use App\Models\ARMLOG\Ticket_PopUp;
use App\Models\TGDB\ARCust_SocialProfile_Picture;
use App\Models\TGDB\ARCustomer_Social;
use App\Models\TGDB\CustSocial_User;
use App\Models\TGDB\proc\ARM_IVR_AssignGroup;
use App\Models\TGDB\Ticket_FB_Attachment;
use CodeIgniter\I18n\Time;

class C_facebook_messager 
{
    /**
     * จัดการข้อความจาก Messenger
     *
     * @param  string $type ประเภทข้อความ
     * @param  array $messaging ข้อความ
     * @param  int $page_id รหัสเพจ
     * @param  int $sender รหัสผู้ส่ง
     * @param  int $recipient รหัสผู้รับ
     * @param  string $mid รหัสข้อความ
     * @param  int $timestamp timestamp
     * @param  string $IVR_Action_Assign การกำหนด IVR Action
     * @return array ข้อมูลของ ticket
     */
    public function messager($type, $messaging, $page_id, $sender, $recipient, $mid, $timestamp,$IVR_Action_Assign='')
    {

        // helper('filesystem');

        $Model_ARCustomer_Social  = new ARCustomer_Social();
        $Result_ARCustomer_Social = $Model_ARCustomer_Social->select('ARCust_Id,CustSocial_Id,CustSocial_PageId,CustSocial_Name,CustSocial_Name,CustSocial_Picture,CustSocial_Token')
            ->where('CustSocial_Group', 'Facebook')
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
            $query    = $Model_CustSocial_User->selectCount('CustUser_Id')->where('User_Id', $page_id)->where('CustSocial_Id', $CustSocial_Id)->get();
            $rowcount = $query->getRowArray();
            unset($Model_CustSocial_User,$query);


            if ($rowcount['CustUser_Id'] === 0) {

                // สร้างภาพ กรณีไม่มีบัญชีใน CustSocial_User
                $facebook = new \App\Libraries\facebook\LFacebook;
                $facebook->personid = $CustSocial_PageId;
                $facebook->accesstoken  = $CustSocial_Token;
                $data = $facebook->profile_get();
                $picture   = !empty($data['picture']) ? $data['picture'] : FCPATH . 'assets\img\na.jpg';
                $imageData = file_get_contents($picture);
                unset($facebook, $data);

                $upload = new C_facebook_upload();
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
                    ->where('CustSocial_Group', 'Facebook')
                    ->where('CustSocial_PageId', $page_id)
                    ->update();
                unset($data, $Model_CustSocial_User, $Model_ARCustomer_Social);

                // insert เก็บ part เข้าตาราง ARCust_SocialProfile_Picture
                $ARCust_SocialProfile_Picture = new ARCust_SocialProfile_Picture();
                $data = [
                    [
                        "Picture_CustType"    => 'page',
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

                
            }
            
            unset($ARCust_SocialProfile_Picture, $Model_CustSocial_User, $data, $CustSocial_PageId, $CustSocial_Name, $Picture_url, $imageData, $filename, $outputFolder, $base64, $dmy);

        } else {
            // ไม่เจอเพจนี้ในฐานข้อมูล
        }

        // -----
        #2 ตรวจสอบสมาชิก จัดการโปรไฟ
        // $CustSocial_Id;
        // $CustSocial_Token;

        if ($page_id === $sender) {
            $Page_CreateDate = 1;
            $WHO_COMMENT = 'A';
            $Chat_Id  = 'gen_' . $page_id . '_' . $recipient;
        } else if ($page_id === $recipient) {
            $Page_CreateDate = 0;
            $WHO_COMMENT = 'C';
            $Chat_Id  = 'gen_' . $page_id . '_' . $sender;
        }

        $facebook_profile = new C_facebook_profile();
        if ($WHO_COMMENT === 'A') {
            $custuser_id_page  =     $facebook_profile->check_profile($CustSocial_Id, $sender, $CustSocial_Token, $page_id, '');
            $custuser_id_user  =     $facebook_profile->check_profile($CustSocial_Id, $recipient, $CustSocial_Token, $page_id, '');
        } else if ($WHO_COMMENT === 'C') {
            $custuser_id = $facebook_profile->check_profile($CustSocial_Id, $sender, $CustSocial_Token, $page_id, '');
            $custuser_id_page  =    $custuser_id;
            $custuser_id_user  =   $custuser_id;
        }


        Time::now('Asia/Bangkok', 'th');
        $date_now = Time::createFromTimestamp(intval($timestamp), 'Asia/Bangkok', 'th');
        $date_now_tostring      = $date_now->toDateTimeString();

        $PROC_Ticket_Header_Manage = new  \App\Models\TGDB\proc\Ticket_Header_Manage;
        $PROC_Ticket_Header_Manage->P_CustSocial_Id   = $CustSocial_Id;
        $PROC_Ticket_Header_Manage->P_CustUser_Id     = $custuser_id_user;
        $PROC_Ticket_Header_Manage->P_Chat_Id         = $Chat_Id;
        $PROC_Ticket_Header_Manage->P_Comment_Id      = $Chat_Id;
        $PROC_Ticket_Header_Manage->P_Page_Create     = $Page_CreateDate;
        $PROC_Ticket_Header_Manage->P_Page_CreateDate = $date_now_tostring;
        $respons_insert_herder = $PROC_Ticket_Header_Manage->insert_herder();
        unset($PROC_Ticket_Header_Manage, $page_id, $recipient_id);

        $PROC_Ticket_Detail_Manage = new  \App\Models\TGDB\proc\Ticket_Detail_Manage;
        $PROC_Ticket_Detail_Manage->P_Action          = 'WebHook';
        $PROC_Ticket_Detail_Manage->P_Ticket_Id       = $respons_insert_herder['Ticket_Id'];
        $PROC_Ticket_Detail_Manage->CustUser_Id       = $custuser_id_page;
        $PROC_Ticket_Detail_Manage->Chat_Comment_Id   = $mid;
        $PROC_Ticket_Detail_Manage->Message_Status    = 'N';
        $PROC_Ticket_Detail_Manage->Message           = ($type === 'text' || $type==='text_ivr' || $type==='bot') ? $messaging : '';
        $PROC_Ticket_Detail_Manage->Picture           = ($type != 'text' && $type !='text_ivr' && $type !='bot' ) ? 'true' : '';
        $PROC_Ticket_Detail_Manage->P_Who_comment     = ($type==='bot')?'B':$WHO_COMMENT;
        if($type==='bot'){
            $PROC_Ticket_Detail_Manage->Set_Who_Comment = 'B';
        }
        $PROC_Ticket_Detail_Manage->P_Page_CreateDate = $date_now_tostring;
        $PROC_Ticket_Detail_Manage->html_entities     = false;
        $respons_insert_mes = $PROC_Ticket_Detail_Manage->insert_mes();


        if(isset($type,$IVR_Action_Assign,$respons_insert_mes['Ticket_Id']) && $type==='text_ivr' && $IVR_Action_Assign !=''){
            $PROC_ARM_IVR_AssignGroup = new ARM_IVR_AssignGroup();
            $PROC_ARM_IVR_AssignGroup->AGroup_Id = $IVR_Action_Assign;
            $PROC_ARM_IVR_AssignGroup->Ticket_Id = $respons_insert_mes['Ticket_Id'];
            $Assign = $PROC_ARM_IVR_AssignGroup->Assign();
            if(!empty($Assign) && isset($Assign['AssignAgent_Id']) && $Assign['AssignAgent_Id']!=0 && $Assign['AssignAgent_Id']!=''){
                $Model_Ticket_PopUp = new Ticket_PopUp();          
                $data = [
                    'Ticket_Id'     => $respons_insert_mes['Ticket_Id'], 
                    'Ticket_FB_Id'     => $respons_insert_mes['Ticket_FB_Id'], 
                    'FB_CreateDate'   => $Page_CreateDate, 
                    'Ticket_Type'   => 'new_inbox', 
                    'PopUp'         => 0
                ];
                $Model_Ticket_PopUp->insert($data);
            }
        }

        if (!empty($respons_insert_mes) && !empty($messaging) && isset($respons_insert_mes['Query'], $respons_insert_mes['Ticket_FB_Id']) && $respons_insert_mes['Query'] === 'insert' && $type != 'text') {
            $Model_Ticket_FB_Attachment = new Ticket_FB_Attachment();
            if (is_array($messaging)) {
                foreach ($messaging as $value) {
                    $data_ins[] = [
                        'Ticket_Id'         => $respons_insert_mes['Ticket_Id']
                        ,'Ticket_FB_Id'     => $respons_insert_mes['Ticket_FB_Id']
                        ,'FB_Att_Url'       => $value['url']
                        ,'FB_Att_Part'      => $value['part']
                        ,'FB_Att_OldName'   => $value['oldname']
                        ,'FB_Att_NewName'   => $value['newname']
                        ,'FB_Att_Type'      => $value['type']
                        ,'FB_Att_extension' => $value['extension']
                        ,'FB_Att_status'    => 1
                    ];
                }
                $gg = $Model_Ticket_FB_Attachment->insertBatch($data_ins);
            }
        }

        if (!empty($respons_insert_mes) && !empty($messaging) && isset($respons_insert_mes['Ticket_FB_Id']) && $type != 'text') {
            if (is_array($messaging) && $respons_insert_mes['Query'] === null) {

                foreach ($messaging as  $value) {
                    if (isset($value['part_del'])) {
                        $del_path = WRITEPATH . $value['part_del']; // เส้นทางที่ต้องการลบ
                        if (is_dir($del_path)) {
                            if($type === 'image'){
                                delete_files($del_path, TRUE);
                                rmdir($del_path);
                            }else{
                                unlink($del_path.$value['newname']);
                            }
                        }

                    }
                }
            }
        }

        $Ticket_Id = $respons_insert_mes['Ticket_Id'];
        $Query     = $respons_insert_mes['Query'];

        unset($sender, $Page_CreateDate, $WHO_COMMENT, $Chat_Id, $custuser_id_page, $CustSocial_Token, $date_now, $date_now_tostring, $PROC_Ticket_Detail_Manage, $respons_insert_herder, $mid, $messaging, $respons_insert_mes);
        $data['ticket_id'] = $Ticket_Id;
        $data['Query']     = $Query;
        $data['status']    = true;

        return $data;
    }
}
