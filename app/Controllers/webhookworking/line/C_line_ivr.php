<?php

namespace App\Controllers\webhook\line;


use App\Libraries\Line\LLine;
use App\Models\TGDB\ARCustomer_Social;
use App\Models\TGDB\ARM_IVR;
use App\Models\TGDB\ARM_IVR_LOG;
use App\Models\TGDB\CustSocial_User;
use App\Models\TGDB\proc\ADM_Ticket_insert_IVR;
use App\Models\TGDB\proc\ARM_IVR_Check;
use App\Models\TGDB\proc\ARM_IVR_Check_test;
use App\Models\TGDB\proc\SupervisorAssignAgent;
use App\Models\TGDB\Ticket_Header;
use CodeIgniter\Controller;
use CodeIgniter\I18n\Time;

class C_line_ivr 
{
    public function ivr($CustSocial_Id)
    {
        $Model_ARCustomer_Social  = new ARCustomer_Social();
        $Result_ARCustomer_Social = $Model_ARCustomer_Social->select('CustSocial_IVR')
            ->where('CustSocial_Id', $CustSocial_Id)
            ->first();
        $CustSocial_IVR =  !empty($Result_ARCustomer_Social['CustSocial_IVR']) ? $Result_ARCustomer_Social['CustSocial_IVR'] : '';
        return $CustSocial_IVR;
    }

    public function ivrsent($message, $CustSocial_Id, $page_id, $ticket_id, $reply_token, $timestamp,$user_id)
    {

        $Model_ARM_IVR_LOG = new ARM_IVR_LOG();
        $Model_ARM_IVR_LOG->transOff();
        $Model_ARM_IVR_LOG->transBegin();
        $data =  [
            'Ticket_Id' => $ticket_id
        ];
        $Model_ARM_IVR_LOG->insert($data);
        if ($Model_ARM_IVR_LOG->transStatus() === false) {
            // $Model_ARM_IVR_LOG->transRollback();
            // $Model_ARM_IVR_LOG->close();
            $data['message'] = 'เกิดข้อผิดพลาด ไม่สามารถนำเข้าข้อมูล Ticket_WrapUp_PDPA ได้';
            $data['status'] = false;
        } else {
            $Model_ARM_IVR_LOG->transCommit();
            // $Model_ARM_IVR_LOG->close();
        }
        unset($Model_ARM_IVR_LOG);

        $PROC_ARM_IVR_Check = new ARM_IVR_Check();
        $PROC_ARM_IVR_Check->Ticket_Id = $ticket_id;
        $ivrcheck = $PROC_ARM_IVR_Check->check();
        unset($PROC_ARM_IVR_Check);

        if (!empty($ivrcheck) && isset($ivrcheck['IVR']) && $ivrcheck['IVR'] === 'YES') {

            $msg                        = !empty($message) ? $message : 'NO';
            $Model_ARCustomer_Social    = new ARCustomer_Social();
            $Result_ARCustomer_Social   = $Model_ARCustomer_Social->select('ARCust_Id,CustSocial_Token')
                ->where('CustSocial_Id', $CustSocial_Id)
                ->first();
            $arcut_id    =   $Result_ARCustomer_Social['ARCust_Id'];
            $token_page  =   $Result_ARCustomer_Social['CustSocial_Token'];
            unset($Model_ARCustomer_Social, $Result_ARCustomer_Social);


            $Model_Ticket_Header = new Ticket_Header();
            $Result_Ticket_Header  = $Model_Ticket_Header->select('Ticket_AssignToAgent')
                ->where('Ticket_Id', $ticket_id)
                ->first();
            unset($Model_Ticket_Header);

            // if (!empty($Result_Ticket_Header['Ticket_AssignToAgent'])) {

                $Model_ARM_IVR  = new ARM_IVR();
                $count_ARM_IVR  = $Model_ARM_IVR->join('ARM_IVR_Action', 'ARM_IVR.IVR_Action_Id=ARM_IVR_Action.IVR_Action_Id', 'inner')
                    ->where('ARM_IVR.CustSocial_Id', $CustSocial_Id)
                    ->where('ARM_IVR.IVR_Message', $msg)
                    ->where('ARM_IVR.ARCust_Id', $arcut_id)
                    ->countAllResults();
                unset($Result_Ticket_Header, $Model_ARM_IVR);

                if ($count_ARM_IVR === 1) {

                    $Model_ARM_IVR  = new ARM_IVR();
                    $Result_ARM_IVR  = $Model_ARM_IVR->select('IVR_Action_Assign')
                        ->join('ARM_IVR_Action', 'ARM_IVR.IVR_Action_Id=ARM_IVR_Action.IVR_Action_Id', 'inner')
                        ->where('ARM_IVR.CustSocial_Id', $CustSocial_Id)
                        ->where('ARM_IVR.IVR_Message', $msg)
                        ->where('ARM_IVR.ARCust_Id', $arcut_id)
                        ->first();

                    if (!empty($Result_ARM_IVR['IVR_Action_Assign']) && $Result_ARM_IVR['IVR_Action_Assign'] !== 888 && $Result_ARM_IVR['IVR_Action_Assign'] != 999) {

                        $PROC_SupervisorAssignAgent = new SupervisorAssignAgent();
                        $PROC_SupervisorAssignAgent->AGroup_Id = $Result_ARM_IVR['IVR_Action_Assign'];
                        $PROC_SupervisorAssignAgent->Agent_Id  = 0;
                        $PROC_SupervisorAssignAgent->Ticket_Id = $ticket_id;
                        $PROC_SupervisorAssignAgent->Assign();
                        unset($PROC_SupervisorAssignAgent, $Ticket_Id);
                    } else {
                        //Line ivr ,ass ไม่ได้
                    }

                    unset($Result_ARM_IVR, $Model_ARM_IVR, $PROC_SupervisorAssignAgent, $CustSocial_Id, $msg, $arcut_id, $count_ARM_IVR);
                } else {

                    $Model_ARM_IVR  = new ARM_IVR();
                    $Result_ARM_IVR =   $Model_ARM_IVR->select("ARM_IVR_Action.IVR_Action_Remark
                                                                ,ARM_IVR_Action.IVR_Action_type
                                                                ,ARM_IVR_Action.IVR_Action_Assign
                                                                ,ARCustomer_Social.CustSocial_Name
                                                                ,ARCustomer_Social.CustSocial_IVR_Header
                                                                ,ARM_IVR.IVR_Id
                                                                ,ARM_IVR.IVR_Label
                                                                ,ARM_IVR.IVR_Message
                                                                ,ARM_IVR.IVR_Color")
                        ->join('ARM_IVR_Action', 'ARM_IVR.IVR_Action_Id = ARM_IVR_Action.IVR_Action_Id', 'left')
                        ->join('ARCustomer_Social', 'ARM_IVR.CustSocial_Id = ARCustomer_Social.CustSocial_Id', 'left')
                        ->where('ARM_IVR.CustSocial_Id', $CustSocial_Id)
                        ->where('ARM_IVR.IVR_Status', 1)
                        ->where("FORMAT(GETDATE(),'yyyy-MM-dd') >= FORMAT(ARM_IVR.IVR_start_date,'yyyy-MM-dd')")
                        ->where("FORMAT(GETDATE(),'yyyy-MM-dd') < FORMAT(ARM_IVR.IVR_end_date,'yyyy-MM-dd')")
                        ->where('ARM_IVR.ARCust_Id', $arcut_id)
                        ->orderBy('IVR_Order', 'ASC')
                        ->findAll();
                    unset($Model_ARM_IVR, $Result_Ticket_Header);
                    if(!empty($Result_ARM_IVR)){
                        $i = 0;
                        $ivr_header = $Result_ARM_IVR[0]['CustSocial_IVR_Header'];
                        foreach ($Result_ARM_IVR as $value) {                         
                                $Message = (!empty($value['IVR_Action_Assign']) && $value['IVR_Action_Assign'] == '888') ? $value['IVR_Message'] . '?PDPA=' . encode_url($value['CustSocial_Id']) : $value['IVR_Message'];
                                $arr0[$i]['type'] = 'button';
                                $arr0[$i]['style'] = $value['IVR_Color'];
                                $arr0[$i]['action']['type'] = $value['IVR_Action_Remark'];
                                $arr0[$i]['action']['label'] = $value['IVR_Label'];
                                $arr0[$i]['action'][$value['IVR_Action_type']] = $Message;
                                $arr0[$i]['action']['IVR_Id'] = 'ivr_id='.$value['IVR_Id'];
                                $i++;
                            unset($value);
                        }
                        unset($startDate, $endDate, $dateNow);

                        if (!empty($Result_ARM_IVR) && !empty($arr0)) {
                            unset($Result_ARM_IVR);
                            $line = new LLine();
                            $line->pdpa_header = $ivr_header;
                            $line->contents    = $arr0;
                            $line->reply_token = $reply_token;
                            $respons           = $line->replyPrivacyPolicy();

                            if(isset($respons['status'],$respons['message']) && $respons['message']==='{"message":"Invalid reply token"}'){
                                $line->re_accesstoken = true;
                                $line->accesstoken  = $token_page;
                                $line->recipient_id = $user_id;
                                $respons            = $line->replyPrivacyPolicy();
                            }

                            unset($line, $ivr_header, $arr0);

                            if ($respons['status']) {

                                Time::now('Asia/Bangkok', 'th');
                                $date_now           = Time::createFromTimestamp(intval($timestamp), 'Asia/Bangkok', 'th');
                                $date_now_tostring  = $date_now->toDateTimeString();


                                $subdate_now        = $date_now->addSeconds(5);
                                $cerate_now          = $subdate_now->toDateTimeString();

                                unset($date_now, $cerate);

                                $Model_CustSocial_User   = new CustSocial_User();
                                $Result_CustSocial_User  = $Model_CustSocial_User->select('CustUser_Id')
                                    ->where('User_Id', $page_id)
                                    ->first();
                                $CustUser_Id = !empty($Result_CustSocial_User['CustUser_Id']) ? $Result_CustSocial_User['CustUser_Id'] : '';

                                $PROC_ADM_Ticket_insert_IVR = new ADM_Ticket_insert_IVR();
                                $PROC_ADM_Ticket_insert_IVR->ScreenType        = 'Line';
                                $PROC_ADM_Ticket_insert_IVR->Ticket_Id         = $ticket_id;
                                $PROC_ADM_Ticket_insert_IVR->CustUser_Id       = $CustUser_Id;
                                $PROC_ADM_Ticket_insert_IVR->Who_Comment       = 'A';
                                $PROC_ADM_Ticket_insert_IVR->Message_Status    = 'R';
                                $PROC_ADM_Ticket_insert_IVR->Line_Message      = 'IVR';
                                $PROC_ADM_Ticket_insert_IVR->Line_CreateDate   = $cerate_now;
                                $PROC_ADM_Ticket_insert_IVR->Line_Reply_Token  = $reply_token;
                                $PROC_ADM_Ticket_insert_IVR->Line_Reply_Date   = $date_now_tostring;
                                $insert = $PROC_ADM_Ticket_insert_IVR->inserts();

                                unset($respons, $Model_CustSocial_User, $Result_CustSocial_User, $CustUser_Id, $ticket_id, $cerate_now, $reply_token, $date_now_tostring);

                                if ($insert) {
                                } else {
                                    // บันทึกไม่สำเร็จ
                                }
                            } else {
                                // ส่งข้อความไม่สำเร็จ
                            }
                        }
                    }
                }
            // }
        }
    }
}
