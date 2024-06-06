<?php

namespace App\Controllers\webhook\line;


use App\Libraries\Line\LLine;
use App\Models\TGDB\ARCustomer_Social;
use App\Models\TGDB\ARM_PDPA;
use App\Models\TGDB\CustSocial_User;
use App\Models\TGDB\proc\ADM_Ticket_insert;
use App\Models\TGDB\proc\ARM_PDPA_Check;
use App\Models\TGDB\proc\SupervisorAssignAgent;
use CodeIgniter\I18n\Time;

class C_line_pdpa 
{

    public function pdpa($CustSocial_Id, $Ticket_Id)
    {
        $line_pdpa = new ARM_PDPA_Check();
        $line_pdpa->CustSocial_Id = $CustSocial_Id;
        $line_pdpa->Ticket_Id = $Ticket_Id;
        $data = $line_pdpa->check();
        $type = !empty($data['Type']) ? $data['Type'] : 'NO';
        return $type;
    }

    public function pdpasent($message, $CustSocial_Id, $page_id, $Ticket_Id, $reply_token, $timestamp,$user_id)
    {
        helper('encode');

        $msg                        = !empty($message) ? $message : 'NO';
        $Model_ARCustomer_Social    =  new ARCustomer_Social();
        $Result_ARCustomer_Social   =  $Model_ARCustomer_Social->select('ARCust_Id,CustSocial_Token')
            ->where('CustSocial_Id', $CustSocial_Id)
            ->first();
        $arcut_id   =   $Result_ARCustomer_Social['ARCust_Id'];
        $token_page =   $Result_ARCustomer_Social['CustSocial_Token'];
        unset($Model_ARCustomer_Social, $Result_ARCustomer_Social);

        $Model_arm_pdpa = new ARM_PDPA();
        $count_arm_pdpa = $Model_arm_pdpa->join('ARM_PDPA_Action', 'ARM_PDPA.PDPA_Action_Id=ARM_PDPA_Action.PDPA_Action_Id', 'inner')
            ->where('ARM_PDPA.CustSocial_Id', $CustSocial_Id)
            ->where('ARM_PDPA.PDPA_Message', $msg)
            ->where('ARM_PDPA.ARCust_Id', $arcut_id)
            ->countAllResults();
        unset($Model_arm_pdpa);

        if ($count_arm_pdpa === 1) {

            $Model_arm_pdpa = new ARM_PDPA();
            $Result_arm_pdpa = $Model_arm_pdpa->select('ARM_PDPA_Action.PDPA_Action_Assign')
                ->join('ARM_PDPA_Action', 'ARM_PDPA.PDPA_Action_Id=ARM_PDPA_Action.PDPA_Action_Id', 'inner')
                ->where('ARM_PDPA.CustSocial_Id', $CustSocial_Id)
                ->where('ARM_PDPA.PDPA_Message', $msg)
                ->where('ARM_PDPA.ARCust_Id', $arcut_id)
                ->first();
            if ($Result_arm_pdpa['PDPA_Action_Assign'] != 888  && $Result_arm_pdpa['PDPA_Action_Assign'] != 999) {
                $PROC_SupervisorAssignAgent = new SupervisorAssignAgent();
                $PROC_SupervisorAssignAgent->AGroup_Id = $Result_arm_pdpa['PDPA_Action_Assign'];
                $PROC_SupervisorAssignAgent->Agent_Id  = 0;
                $PROC_SupervisorAssignAgent->Ticket_Id = $Ticket_Id;
                $PROC_SupervisorAssignAgent->Assign();
                unset($PROC_SupervisorAssignAgent, $Ticket_Id);
            } else {
                //Line PDPA ,ass ไม่ได้
            }
            unset($Model_arm_pdpa, $count_arm_pdpa, $Result_arm_pdpa);
        } else {
            unset($Model_arm_pdpa, $count_arm_pdpa);

            $Model_arm_pdpa  =  new ARM_PDPA();
            $Result_arm_pdpa =  $Model_arm_pdpa->select('ARM_PDPA.CustSocial_Id
                                                        ,ARM_PDPA.PDPA_Message
                                                        ,ARM_PDPA.PDPA_Color
                                                        ,ARM_PDPA.PDPA_Label
                                                        ,ARM_PDPA_Action.PDPA_Action_type
                                                        ,ARM_PDPA_Action.PDPA_Action_Assign
                                                        ,ARM_PDPA_Action.PDPA_Action_Remark
                                                        ,ARCustomer_Social.CustSocial_PDPA_Header')
                ->join('ARM_PDPA_Action', 'ARM_PDPA.PDPA_Action_Id = ARM_PDPA_Action.PDPA_Action_Id')
                ->join('ARCustomer_Social', 'ARM_PDPA.CustSocial_Id = ARCustomer_Social.CustSocial_Id')
                ->where('ARM_PDPA.CustSocial_Id', $CustSocial_Id)
                ->where('ARM_PDPA.PDPA_Status', 1)
                ->where('ARM_PDPA.ARCust_Id', $arcut_id)
                ->orderBy('ARM_PDPA.PDPA_Order', 'ASC')
                ->findAll();

            $pdpa_header = $Result_arm_pdpa[0]['CustSocial_PDPA_Header'];
            foreach ($Result_arm_pdpa as $key => $value) {
                $Message = (!empty($value['PDPA_Action_Assign']) && $value['PDPA_Action_Assign'] == '888') ? $value['PDPA_Message'] . '?PDPA=' . encode_url($value['CustSocial_Id']) : $value['PDPA_Message'];
                $arr0[$key]['type'] = 'button';
                $arr0[$key]['style'] = $value['PDPA_Color'];
                $arr0[$key]['action']['type'] = $value['PDPA_Action_Remark'];
                $arr0[$key]['action']['label'] = $value['PDPA_Label'];
                $arr0[$key]['action'][$value['PDPA_Action_type']] = $Message;
                unset($key, $value, $Message);
            }
            unset($Model_arm_pdpa, $Result_arm_pdpa);

            if (!empty($pdpa_header) && !empty($arr0)) {

                $line = new LLine();
                $line->pdpa_header = $pdpa_header;
                $line->contents    = $arr0;
                $line->reply_token = $reply_token;
                $respons           = $line->replyPrivacyPolicy();

                if(isset($respons['status'],$respons['message']) && $respons['message']==='{"message":"Invalid reply token"}'){
                    $line->re_accesstoken = true;
                    $line->accesstoken  = $token_page;
                    $line->recipient_id = $user_id;
                    $respons            = $line->replyPrivacyPolicy();
                }
             
                unset($line, $pdpa_header, $arr0);

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
                    unset($Model_CustSocial_User, $Result_CustSocial_User, $page_id);

                    $PROC_ADM_Ticket_insert = new ADM_Ticket_insert();
                    $PROC_ADM_Ticket_insert->ScreenType       = 'Line';
                    $PROC_ADM_Ticket_insert->Ticket_Id        = $Ticket_Id;
                    $PROC_ADM_Ticket_insert->CustUser_Id      = $CustUser_Id;
                    $PROC_ADM_Ticket_insert->Who_Comment      = 'A';
                    $PROC_ADM_Ticket_insert->Message_Status   = 'R';
                    $PROC_ADM_Ticket_insert->Line_Message     = 'PDPA Message';
                    $PROC_ADM_Ticket_insert->Line_CreateDate  = $cerate_now;
                    $PROC_ADM_Ticket_insert->Line_Reply_Token = $reply_token;
                    $PROC_ADM_Ticket_insert->Line_Reply_Date  = $date_now_tostring;
                    $PROC_ADM_Ticket_insert->inserts();
                    unset($PROC_ADM_Ticket_insert, $Ticket_Id, $CustUser_Id, $cerate_now, $date_now_tostring, $reply_token);
                } else {
                    // ส่งข้อความไม่สำเร็จ
                }
            }
        }
    }
}
