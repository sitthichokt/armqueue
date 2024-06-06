<?php

namespace App\Controllers\webhookworking\facebook;

use App\Libraries\facebook\LFacebook;
use App\Models\TGDB\ARCustomer_Social;
use App\Models\TGDB\ARM_PDPA;
use App\Models\TGDB\CustSocial_User;
use App\Models\TGDB\proc\ADM_Ticket_insert;
use App\Models\TGDB\proc\ARM_PDPA_Check;
use App\Models\TGDB\proc\SupervisorAssignAgent;
use CodeIgniter\I18n\Time;

class C_facebook_pdpa 
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

    public function pdpasent($message, $CustSocial_Id, $page_id, $Ticket_Id, $sender,$Token)
    {
        helper('encode');

        $msg                        = !empty($message) ? $message : 'NO';
        $Model_ARCustomer_Social    =  new ARCustomer_Social();
        $Result_ARCustomer_Social   =  $Model_ARCustomer_Social->select('ARCust_Id')
            ->where('CustSocial_Id', $CustSocial_Id)
            ->first();
        $arcut_id   =   $Result_ARCustomer_Social['ARCust_Id'];
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
                unset($PROC_SupervisorAssignAgent);
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
                unset($Model_arm_pdpa);

                $arr=[];
                if(!empty($Result_arm_pdpa)){
                    $PDPA_Header = $Result_arm_pdpa[0]['CustSocial_PDPA_Header'];
                    foreach ($Result_arm_pdpa as $key => $value) {
                        $Remark_PDPA = $value['PDPA_Action_Remark'];
                        $Type_PDPA   = $value['PDPA_Action_type'];
                        $Assign_PDPA   = $value['PDPA_Action_Assign'];
                        $CustSocial_Id_PDPA   = $value['CustSocial_Id'];
                        $Label_PDPA   = $value['PDPA_Label'];
                        $PDPA_Color   = $value['PDPA_Color'];

                        if($Remark_PDPA == 'web_url'){
                            $Message = $value['PDPA_Message'];
                            if($Assign_PDPA == '888'){
                                $Message = (!empty($Assign_PDPA) && $Assign_PDPA == '888') ? $value['PDPA_Message'] . '?PDPA=' . encode_url($CustSocial_Id_PDPA) : $value['PDPA_Message'];
                            }else{
                              $Message = $value['PDPA_Message'];
                            }
                          }else{
                            $Message = 'DEVELOPER_DEFINED_PAYLOAD';
                          }
                          
                          $arr[$key]['type'] = $Remark_PDPA;
                          $arr[$key]['title'] = $Label_PDPA;                                            
                          $arr[$key][$Type_PDPA] = $Message;

                    }
                    unset($Result_arm_pdpa,$key,$value);

                    if(!empty($arr)){

                        
                      
                        $PDPA_Headers = !empty($PDPA_Header)?$PDPA_Header:'นโยบายความเป็นส่วนตัว';
                        $elements[] = ['title' => $PDPA_Headers ,'buttons' => $arr]; 
                        $LFacebook = new LFacebook();
                        $LFacebook->accesstoken = $Token;
                        $LFacebook->recipient_id = $sender;
                        $LFacebook->page_id = $page_id;
                        $LFacebook->elements = $elements;
                        $sent = $LFacebook->messenger_send_template_generic();
                        unset($LFacebook,$elements,$PDPA_Header,$Token,$sender,$arr);

                        if(!empty($sent) && isset($sent['status']) && $sent['status']===true){
                            $Model_CustSocial_User   = new CustSocial_User();
                            $Result_CustSocial_User  = $Model_CustSocial_User->select('CustUser_Id')
                                ->where('User_Id', $page_id)
                                ->first();
                            $CustUser_Id = !empty($Result_CustSocial_User['CustUser_Id']) ? $Result_CustSocial_User['CustUser_Id'] : '';
                            unset($Model_CustSocial_User, $Result_CustSocial_User, $page_id);
    
    
                            $cerate             = new Time('now', 'Asia/Bangkok', 'th');
                            $cerate_now         = $cerate->toDateTimeString();

                            $PROC_ADM_Ticket_insert = new ADM_Ticket_insert();
                            $PROC_ADM_Ticket_insert->ScreenType       = 'Facebook';
                            $PROC_ADM_Ticket_insert->Ticket_Id        = $Ticket_Id;
                            $PROC_ADM_Ticket_insert->CustUser_Id      = $CustUser_Id;
                            $PROC_ADM_Ticket_insert->Who_Comment      = 'A';
                            $PROC_ADM_Ticket_insert->Message_Status   = 'R';
                            $PROC_ADM_Ticket_insert->Line_Message     = 'PDPA Message';
                            $PROC_ADM_Ticket_insert->Line_CreateDate  = $cerate_now;
                            $PROC_ADM_Ticket_insert->Line_Reply_Token = '';
                            $PROC_ADM_Ticket_insert->Line_Reply_Date  = '';
                            $PROC_ADM_Ticket_insert->inserts();
                            unset($PROC_ADM_Ticket_insert,$cerate,$cerate_now,$Ticket_Id,$CustUser_Id);
                        }

                    }


                }

          
        }
    }
}
