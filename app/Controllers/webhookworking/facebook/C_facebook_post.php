<?php

namespace App\Controllers\webhookworking\facebook;


use App\Libraries\facebook\LFacebook;
use App\Models\TGDB\functions\AutoHideBadWord;
use App\Models\TGDB\Ticket_FB;
use App\Models\TGDB\Ticket_FB_Attachment;
use CodeIgniter\I18n\Time;

class C_facebook_post 
{

    public function post_add($item, $comment, $post_id, $messaging, $photos, $link, $CustSocial_Id, $CustSocial_Token, $page_id, $arcut_id, $from_id, $timestamp,$na,$published)
    {
        Time::now('Asia/Bangkok', 'th');
        $date_now           = Time::createFromTimestamp(intval($timestamp), 'Asia/Bangkok', 'th');
        $check_profile      = new C_facebook_profile();
        $custuser_id        = $check_profile->check_profile($CustSocial_Id, $from_id, $CustSocial_Token, $page_id,$na);
        $page_create        = ($page_id === $from_id) ? 1 : 0;
        $who_comment        = ($page_id === $from_id) ? 'A' : 'C';
        $date_now_tostring  = $date_now->toDateTimeString();

        unset($check_profile, $date_now, $timestamp, $from_id, $page_id);

        switch ($item) {
            case 'photo':
                $facebook_upload  = new C_facebook_upload();
                $picture          = $facebook_upload->upload_post('image', $link, $CustSocial_Id, $arcut_id);
                $parent_id        = $post_id;
                $comment_id       = $post_id;
                unset($facebook_upload, $link, $arcut_id);
                break;
            case 'video':
                $facebook_upload  = new C_facebook_upload();
                $picture          = $facebook_upload->upload_post('video', $link, $CustSocial_Id, $arcut_id);
                $parent_id        = $post_id;
                $comment_id       = $post_id;
                unset($facebook_upload, $link, $arcut_id);

                break;

            case 'comment':   # ตอบโพส
                if(empty($comment['parent_id']) || empty($comment['comment_id'])){
                    return false;
                }
                $parent_id     = $comment['parent_id'];
                $comment_id    = $comment['comment_id'];
                $picture       = '';
                if (!empty($photos)) {
                    // อัพโหลดไฟล์
                    $facebook_upload  = new C_facebook_upload();
                    $picture              = $facebook_upload->upload_post('image', $photos, $CustSocial_Id, $arcut_id);
                    // $picture          = implode(",", $url);
                    unset($facebook_upload, $url, $photos);
                }
            break;

            case 'share':
            case 'status':   # เพจสร้างโพส
                $parent_id  = $post_id;
                $comment_id = $post_id;
                $url        = [];
                $picture    = '';

                if (!empty($photos)) {
                    $facebook_upload  = new C_facebook_upload();
                    $picture              = $facebook_upload->upload_post('image', $photos, $CustSocial_Id, $arcut_id);
                    // $picture          = implode(",", $url);
                }

                // กรณี เป็น live และ share
                if ($messaging === '' && $picture === '') {
                    $facebook = new \App\Libraries\facebook\LFacebook;
                    $facebook->accesstoken = $CustSocial_Token;
                    $facebook->post_id = $post_id;
                    $get = $facebook->status_get();
                    if ($get['status'] === true) {
                        $picture = [];
                        if ($get['status_type'] === 'added_video') {
                            $messaging       = "วีดีโอ";
                            $permalink_url   = $get['permalink_url'];

                            $picture[] =     [
                                'url'=> $permalink_url
                                ,'part'=> ''
                                ,'part_del'=> ''
                                ,'type'=> 'link'
                                ,'extension'=> 'url'
                                ,'oldname'=> ''
                                ,'newname'=> ''
                            ];

                        }
                        if ($get['status_type'] === 'added_photos') {
                            $messaging       = $get['story'];
                            $permalink_url   = $get['permalink_url'];
                            $picture[] =     [
                                'url'=> $permalink_url
                                ,'part'=> ''
                                ,'part_del'=> ''
                                ,'type'=> 'link'
                                ,'extension'=> 'url'
                                ,'oldname'=> ''
                                ,'newname'=> ''
                            ];

                        }
                        if ($get['status_type'] === 'mobile_status_update') {
                            $messaging       = $get['story'];
                            $permalink_url   = $get['permalink_url'];
                            $picture[] =     [
                                'url'=> $permalink_url
                                ,'part'=> ''
                                ,'part_del'=> ''
                                ,'type'=> 'link'
                                ,'extension'=> 'url'
                                ,'oldname'=> ''
                                ,'newname'=> ''
                            ];
                        }
                    }
                    unset($facebook, $get);
                }
                unset($facebook_upload, $photos, $arcut_id);
            break;
        }

        $P_Comment_Id = (!empty($comment_id))?$comment_id:$post_id;
        $PROC_Ticket_Header_Manage = new  \App\Models\TGDB\proc\Ticket_Header_Manage;
        $PROC_Ticket_Header_Manage->P_Action          = 'WebHook';
        $PROC_Ticket_Header_Manage->P_CustSocial_Id   = $CustSocial_Id;
        $PROC_Ticket_Header_Manage->P_CustUser_Id     = $custuser_id;
        // $PROC_Ticket_Header_Manage->P_CustUser_Id     = $custuser_id1;
        $PROC_Ticket_Header_Manage->P_Post_Id         = $post_id;
        $PROC_Ticket_Header_Manage->P_Comment_Id      =  $P_Comment_Id;
        $PROC_Ticket_Header_Manage->P_Page_Create     = $page_create;
        $PROC_Ticket_Header_Manage->P_Page_CreateDate = $date_now_tostring;
        if(isset($published) && $published===false){
        $PROC_Ticket_Header_Manage->P_Ticket_Ad=1;
        }
        $respons_insert_herder = $PROC_Ticket_Header_Manage->insert_herder();

        $PROC_Ticket_Detail_Manage = new  \App\Models\TGDB\proc\Ticket_Detail_Manage;
        $PROC_Ticket_Detail_Manage->P_Action          = 'WebHook';
        $PROC_Ticket_Detail_Manage->P_Ticket_Id       = $respons_insert_herder['Ticket_Id'];
        $PROC_Ticket_Detail_Manage->CustUser_Id       = $custuser_id;
        $PROC_Ticket_Detail_Manage->Parent_Comment_Id = $parent_id;
        $PROC_Ticket_Detail_Manage->Post_Comment_Id   = $comment_id;
        $PROC_Ticket_Detail_Manage->Message_Status    = 'N';
        $PROC_Ticket_Detail_Manage->Message           = $messaging;
        $PROC_Ticket_Detail_Manage->Picture           = (!empty($picture)?'true':'');
        $PROC_Ticket_Detail_Manage->P_Who_comment     = $who_comment;
        $PROC_Ticket_Detail_Manage->P_Page_CreateDate = $date_now_tostring;
        $respons_insert_mes = $PROC_Ticket_Detail_Manage->insert_mes();

        if(isset($messaging,$respons_insert_mes['Query']) && !empty($messaging)){
            $FN_AutoHideBadWord = new AutoHideBadWord();
            $FN_AutoHideBadWord->message = $messaging;
            $BadWord = $FN_AutoHideBadWord->check_BadWord();
            if($BadWord==='YES'){           
                $LFacebook = new LFacebook();
                $LFacebook->is_hidden = true;
                $LFacebook->commentid = $comment_id;
                $LFacebook->accesstoken = $CustSocial_Token;
                $LFacebook->post_comment_ishidden();      
            }
            unset($LFacebook,$CustSocial_Token,$FN_AutoHideBadWord,$BadWord);
        }


        if (!empty($respons_insert_mes) && !empty($picture) && isset($respons_insert_mes['Query'], $respons_insert_mes['Ticket_FB_Id']) && $respons_insert_mes['Query'] === 'insert') {
            $Model_Ticket_FB_Attachment = new Ticket_FB_Attachment();
            if (is_array($picture)) {
                foreach ($picture as $value) {
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

        unset($PROC_Ticket_Header_Manage, $CustSocial_Id, $custuser_id, $post_id, $page_create,$CustSocial_Token);
        unset($PROC_Ticket_Detail_Manage, $respons_insert_herder, $respons_insert_mes, $parent_id, $comment_id, $messaging, $picture, $who_comment, $date_now_tostring);

        return true;
    }

    public function post_edit($post_id,$messaging,$photos,$CustSocial_Id, $arcut_id){

        if(!empty($post_id) && ($messaging!=''||$photos!=='')){

            $Model_Ticket_FB = new Ticket_FB();  
            $datas = $Model_Ticket_FB->select('Ticket_FB_Id')
            ->where('Post_Comment_Id', $post_id)
            ->first();

            if(!empty($datas)){
                $picture    = '';
                if (!empty($photos)) {
                    $facebook_upload  = new C_facebook_upload();
                    $url              = $facebook_upload->upload('image', $photos, $CustSocial_Id, $arcut_id);
                    $picture          = implode(",", $url);
                }
                if($messaging!=''||$picture!=''){
                    $date_now               = new Time('now', 'Asia/Bangkok', 'th');
                    $date_now_tostring      = $date_now->toDateString();  
                    $Model_Ticket_FB = new Ticket_FB();  
                    $Model_Ticket_FB->set('FB_Message', $messaging);
                    $Model_Ticket_FB->set('FB_Picture', $picture);
                    $Model_Ticket_FB->set('Update_Date', $date_now_tostring);
                    $Model_Ticket_FB->where('Ticket_FB_Id', $datas['Ticket_FB_Id']);
                    $ipdate = $Model_Ticket_FB->update();
                    if($ipdate){
                        return true;
                    }  
                }
               
            }
            
        }    
    }

    public function comment_hide($Comment_Id){

        if(!empty($Comment_Id)){

            $Model_Ticket_FB = new Ticket_FB();  
            $datas = $Model_Ticket_FB->select('Ticket_FB_Id')
            ->where('Post_Comment_Id', $Comment_Id)
            ->first();

            if(!empty($datas)){

                $date_now               = new Time('now', 'Asia/Bangkok', 'th');
                $date_now_tostring      = $date_now->toDateString();  
                $Model_Ticket_FB = new Ticket_FB();  
                $Model_Ticket_FB->set('Message_Status', 'H' );
                $Model_Ticket_FB->set('Hidden_Date', $date_now_tostring);
                $Model_Ticket_FB->where('Ticket_FB_Id', $datas['Ticket_FB_Id']);
                $ipdate = $Model_Ticket_FB->update();
                if($ipdate){
                    return true;
                }
            }
        }


             
    }
    public function comment_unhide($post_id){

        if(!empty($Comment_Id)){

            $Model_Ticket_FB = new Ticket_FB();  
            $datas = $Model_Ticket_FB->select('Ticket_FB_Id')
            ->where('Post_Comment_Id', $Comment_Id)
            ->first();

            if(!empty($datas)){
                $date_now               = new Time('now', 'Asia/Bangkok', 'th');
                $date_now_tostring      = $date_now->toDateString();  
                $Model_Ticket_FB = new Ticket_FB();  
                $Model_Ticket_FB->set('Message_Status', 'R' );
                $Model_Ticket_FB->set('Hidden_Date', $date_now_tostring);
                $Model_Ticket_FB->where('Ticket_FB_Id', $datas['Ticket_FB_Id']);
                $ipdate = $Model_Ticket_FB->update();
                if($ipdate){
                    return true;
                }   

            }
        }
           
    }
    public function comment_remove($post_id){

        if(!empty($Comment_Id)){

            $Model_Ticket_FB = new Ticket_FB();  
            $datas = $Model_Ticket_FB->select('Ticket_FB_Id')
            ->where('Post_Comment_Id', $Comment_Id)
            ->first();

            if(!empty($datas)){
                $date_now               = new Time('now', 'Asia/Bangkok', 'th');
                $date_now_tostring      = $date_now->toDateString();  
                $Model_Ticket_FB = new Ticket_FB();  
                $Model_Ticket_FB->set('Message_Status', 'D' );
                $Model_Ticket_FB->set('Delete_Date', $date_now_tostring);
                $Model_Ticket_FB->where('Ticket_FB_Id', $datas['Ticket_FB_Id']);
                $ipdate = $Model_Ticket_FB->update();
                if($ipdate){
                    return true;
                }      
            }
        }
        
    }
}
