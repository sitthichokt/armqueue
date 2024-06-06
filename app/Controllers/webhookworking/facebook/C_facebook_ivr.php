<?php

namespace App\Controllers\webhookworking\facebook;


use App\Libraries\facebook\LFacebook;
use App\Models\TGDB\ARCustomer_Social;
use App\Models\TGDB\ARM_IVR;
use App\Models\TGDB\ARM_IVR_LOG;
use App\Models\TGDB\CustSocial_User;
use App\Models\TGDB\proc\ADM_Ticket_insert_IVR;
use App\Models\TGDB\proc\ARM_IVR_Check;
use App\Models\TGDB\proc\SupervisorAssignAgent;
use App\Models\TGDB\Ticket_Header;
use CodeIgniter\I18n\Time;

class C_facebook_ivr 
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

    public function ivrsent($message, $CustSocial_Id, $page_id, $ticket_id, $sender, $Token)
    {

        $Model_ARM_IVR_LOG = new ARM_IVR_LOG();
        $data =  ['Ticket_Id' => $ticket_id];
        $Model_ARM_IVR_LOG->insert($data);
        unset($Model_ARM_IVR_LOG);

        $PROC_ARM_IVR_Check = new ARM_IVR_Check();
        $PROC_ARM_IVR_Check->Ticket_Id = $ticket_id;
        $ivrcheck = $PROC_ARM_IVR_Check->check();
        unset($PROC_ARM_IVR_Check);

        if (!empty($ivrcheck) && $ivrcheck['IVR'] === 'YES') {


            $msg                        = !empty($message) ? $message : 'NO';
            $Model_ARCustomer_Social    = new ARCustomer_Social();
            $Result_ARCustomer_Social   = $Model_ARCustomer_Social->select('ARCust_Id')
                ->where('CustSocial_Id', $CustSocial_Id)
                ->first();
            $arcut_id   =   $Result_ARCustomer_Social['ARCust_Id'];
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
                                                                ,ARM_IVR.IVR_Message")
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

                    if (!empty($Result_ARM_IVR)) {
                        $arr = [];
                        $PDPA_Header = isset($Result_ARM_IVR[0]['CustSocial_IVR_Header']) ? $Result_ARM_IVR[0]['CustSocial_IVR_Header'] : '';
                        foreach ($Result_ARM_IVR as $value) {
                            // $startDate  =  is_null($value['start_date']) ? date('Y-m-d') : $value['start_date'];
                            // $endDate    =  is_null($value['end_date']) ? date('Y-m-d') : $value['end_date'];
                            // $dateNow    =  date('Y-m-d');
                            $Type_ivr   = $value['IVR_Action_Remark'];
                            // if ($dateNow >= $startDate && $dateNow <= $endDate) {
                                if ($Type_ivr === 'web_url') {
                                    $arr[] = ['type' => 'web_url', 'url' => $value['IVR_Message'], 'title' => $value['IVR_Label']];
                                } else if ($Type_ivr == 'postback') {
                                    $arr[] = ['type' => 'postback', 'title' => $value['IVR_Label'], 'payload' => 'ivr_id='.$value['IVR_Id']];
                                }
                            // }
                            unset($value);
                        }
                       
                        if (!empty($arr)) {
                            $PDPA_Headers = !empty($PDPA_Header) ? $PDPA_Header : 'เลือกรายการที่ต้องการ';
                            $elements[] = ['title' => $PDPA_Headers, 'buttons' => $arr];
                            $LFacebook = new LFacebook();
                            $LFacebook->accesstoken = $Token;
                            $LFacebook->recipient_id = $sender;
                            $LFacebook->page_id = $page_id;
                            $LFacebook->elements = $elements;
                            $sent = $LFacebook->messenger_send_template_generic();
                            unset($LFacebook, $elements, $PDPA_Header, $Token, $sender, $arr);

                            if (!empty($sent) && isset($sent['status']) && $sent['status'] === true) {
                                $cerate             = new Time('now', 'Asia/Bangkok', 'th');
                                $cerate_now         = $cerate->toDateTimeString();
                                unset($date_now, $cerate);

                                $Model_CustSocial_User   = new CustSocial_User();
                                $Result_CustSocial_User  = $Model_CustSocial_User->select('CustUser_Id')
                                    ->where('User_Id', $page_id)
                                    ->first();
                                $CustUser_Id = !empty($Result_CustSocial_User['CustUser_Id']) ? $Result_CustSocial_User['CustUser_Id'] : '';

                                $PROC_ADM_Ticket_insert_IVR = new ADM_Ticket_insert_IVR();
                                $PROC_ADM_Ticket_insert_IVR->ScreenType        = 'Facebook';
                                $PROC_ADM_Ticket_insert_IVR->Ticket_Id         = $ticket_id;
                                $PROC_ADM_Ticket_insert_IVR->CustUser_Id       = $CustUser_Id;
                                $PROC_ADM_Ticket_insert_IVR->Who_Comment       = 'A';
                                $PROC_ADM_Ticket_insert_IVR->Message_Status    = 'R';
                                $PROC_ADM_Ticket_insert_IVR->Line_Message      = 'IVR Message';
                                $PROC_ADM_Ticket_insert_IVR->Line_CreateDate   = $cerate_now;
                                $PROC_ADM_Ticket_insert_IVR->Line_Reply_Token  = '';
                                $PROC_ADM_Ticket_insert_IVR->Line_Reply_Date   = '';
                                $insert = $PROC_ADM_Ticket_insert_IVR->inserts();
                            }
                        }
                    }
                }
            // }
        }
    }
}
