<?php

namespace App\Controllers\webhook\line;


use App\Models\ARMLOG\Webhook_tmp;
use App\Models\TGDB\Chatbot_Menu_Redirect;
use App\Models\TGDB\proc\Ticket_CallChatBot;
use App\Models\TGDB\proc\Webhook_message_get;
use App\Models\TGDB\proc\Webhook_message_upd;
use CodeIgniter\I18n\Time;

class C_line_menu 
{
    public function index()
    {
        helper('writable');

        $PROC_Webhook_message_get = new Webhook_message_get();
        $PROC_Webhook_message_get->ScreenType = 'Line menu';
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

                        if(isset($hookdata_decode['Action_Code']) && !empty($hookdata_decode['Action_Code'])){
                            
                            $time = Time::now('Asia/Bangkok', 'th');
                            $line_message_timestamp = $time->timestamp; 
                            $Taskstart_date         = $time->toDateTimeString();

                            $id_menu        = $hookdata_decode['Action_Code'];
                            $user_id        = $hookdata_decode['userId'];
                            $CustSocial_Id  = $hookdata_decode['CustSocial_Id'];

                            unset($hookdata_decode,$time);

                            $Model_Chatbot_Menu_Redirect = new Chatbot_Menu_Redirect();
                            $Menu_Data = $Model_Chatbot_Menu_Redirect->select('Chatbot_Menu_Redirect.CustSocial_Id,Chatbot_Menu_Redirect.Action_Name,ARCustomer_Social.CustSocial_PageId,ARCustomer_Social.CustSocial_Token,ARCustomer_Social.CustSocial_PageId')
                                        ->join('ARCustomer_Social','ARCustomer_Social.CustSocial_Id = Chatbot_Menu_Redirect.CustSocial_Id','left')
                                        ->where('Chatbot_Menu_Redirect.Action_Code',$id_menu)
                                        ->where('ARCustomer_Social.CustSocial_Id',$CustSocial_Id)
                                        ->first();

                            $CustSocial_Id       = $Menu_Data['CustSocial_Id'];
                            $token               = $Menu_Data['CustSocial_Token'];
                            $page_id             = $Menu_Data['CustSocial_PageId'];
                            $line_message_text   = $Menu_Data['Action_Name'];
                            $line_message_id     = 'gen'.$line_message_timestamp.'_'.$page_id.'_'.$user_id; 

                            $line_profile = new C_line_profile();
                            $custuser_id  = $line_profile->check_profile($CustSocial_Id, $user_id, $token, $page_id);
                            unset($Model_Chatbot_Menu_Redirect,$Menu_Data,$line_profile);
                        
                            $line_messager_user = new C_line_messager();
                            $respons = $line_messager_user->messager(
                                'text',
                                $line_message_text,
                                '',
                                $line_message_id,
                                '',
                                $line_message_id,
                                $custuser_id,
                                $user_id,
                                $page_id,
                                $line_message_timestamp,
                                '',
                                '',
                                '' 
                            );
                            unset($line_messager_user);

                            $PROC_Ticket_CallChatBot = new Ticket_CallChatBot();
                            $PROC_Ticket_CallChatBot->P_Ticket_Id           = $respons['ticket_id'];
                            $PROC_Ticket_CallChatBot->P_Ticket_Detail_Id    = $respons['ticket_detail_id'];
                            $Data_bot = $PROC_Ticket_CallChatBot->get();
                            $chatt = json_encode($Data_bot,true);
                            $hookMessage = $respons['ticket_id'].",".$respons['ticket_detail_id']." : ".$chatt;

                            unset($PROC_Ticket_CallChatBot,$Data_bot,$chatt);
                          

                            $Model_Webhook_tmp = new Webhook_tmp();                     
                            $dataTGDBWebhook_tmp =   [
                                "hookSocial"        => 'Line bot menu',
                                "hookMessage"       => $hookMessage,  
                                "Taskstart_date"    => $Taskstart_date                       
                            ];
                            $Model_Webhook_tmp->insert($dataTGDBWebhook_tmp);
                            unset($Model_Webhook_tmp,$dataTGDBWebhook_tmp);

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
