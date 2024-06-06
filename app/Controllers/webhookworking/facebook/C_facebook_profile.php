<?php

namespace App\Controllers\webhookworking\facebook;

use App\Models\TGDB\ARCust_SocialProfile_Picture;
use App\Models\TGDB\ARCustomer_Social;
use App\Models\TGDB\CustSocial_User;
use App\Models\TGDB\proc\CustSocial_User_Manage;

class C_facebook_profile 
{

/** ตรวจสอบโปรไฟล */
    public function check_profile($CustSocial_Id, $sender, $CustSocial_Token, $page_id,$NA)
    {
        helper('setpart');
        $Model_CustSocial_User   = new CustSocial_User();
        $Numrow_CustSocial_User  = $Model_CustSocial_User
            ->where('User_Id', $sender)
            ->where('CustSocial_Id', $CustSocial_Id)
            ->countAllResults();
        unset($Model_CustSocial_User);

        if ($Numrow_CustSocial_User === 0) {

            $facebook = new \App\Libraries\facebook\LFacebook;
            $facebook->personid = $sender;
            $facebook->accesstoken  = $CustSocial_Token;
            $data = $facebook->profile_get();
            unset($Numrow_CustSocial_User, $facebook);

            if (!empty($data) && $data['status'] === true) {
                $Model_ARCustomer_Social = new ARCustomer_Social();
                $Result_ARCustomer_Social = $Model_ARCustomer_Social->select('ARCust_Id')
                    ->where('CustSocial_Group', 'Facebook')
                    ->where('CustSocial_PageId', $page_id)
                    ->first();
                $arcut_id = $Result_ARCustomer_Social['ARCust_Id'];

                // สร้างภาพ
                $picture = !empty($data['picture'])?$data['picture']:FCPATH.'assets\img\na.jpg';
                $imageData = file_get_contents($picture);

                // อัพโหลดภาพ
                $upload = new C_facebook_upload();
                $imageUser = $upload->uploadProfile($imageData,$arcut_id,$CustSocial_Id,'user');
                unset($upload);

                //insert โปรไฟล์
                $PROC_CustSocial_User_Manage = new CustSocial_User_Manage();
                $PROC_CustSocial_User_Manage->P_CustUser_Id     = $CustSocial_Id;
                $PROC_CustSocial_User_Manage->P_User_Id         = $sender;
                $PROC_CustSocial_User_Manage->P_User_Name       = $data['name'];
                $PROC_CustSocial_User_Manage->P_User_ScreenName = $data['name'];
                $PROC_CustSocial_User_Manage->P_User_Picture    = $imageUser['url'];
                $Data_CustUser_Manage = $PROC_CustSocial_User_Manage->edit();
                unset($data, $imageData, $dmy, $PROC_CustSocial_User_Manage, $Picture_url,$picture);

                // insert เก็บ part เข้าตาราง ARCust_SocialProfile_Picture
                if(!empty($Data_CustUser_Manage) && isset($Data_CustUser_Manage['CustUser_Id'],$Data_CustUser_Manage['Query']) && $Data_CustUser_Manage['Query'] === 'insert'){
                    $ARCust_SocialProfile_Picture = new ARCust_SocialProfile_Picture();           
                    $data = [
                        "Picture_CustType"    => 'user',
                        "CustUser_Id"         => $Data_CustUser_Manage['CustUser_Id'],
                        "CustSocial_Id"       => intval($CustSocial_Id),
                        "Picture_OldName"     => '',
                        "Picture_NewName"     => $imageUser['filename'],
                        "Picture_Part"        => $imageUser['part'],
                        "Picture_Type"        => 'jpg',
                        "Picture_Status"      => 1
                    ];
                    $ARCust_SocialProfile_Picture->insert($data);
                    unset($ARCust_SocialProfile_Picture,$Data_CustUser_Manage);
                }

  
            } else {
                if(($data['code']===100 || $data['code']===10) && ($data['subcode']=== 33 || $data['subcode']=== -1) && !empty($NA)){            
                    $PROC_CustSocial_User_Manage = new CustSocial_User_Manage();
                    $PROC_CustSocial_User_Manage->P_CustUser_Id     = $CustSocial_Id;
                    $PROC_CustSocial_User_Manage->P_User_Id         = $sender;
                    $PROC_CustSocial_User_Manage->P_User_Name       = $NA['name'];
                    $PROC_CustSocial_User_Manage->P_User_ScreenName = $NA['name'];
                    $PROC_CustSocial_User_Manage->P_User_Picture    = "";
                    $PROC_CustSocial_User_Manage->updates();
                    unset($data,$NA); 
                }else{
                // api erroe
                // $data['message']
                }
               
            }
        }

        $Model_CustSocial_User   = new CustSocial_User();
        $Numrow_CustSocial_User = $Model_CustSocial_User->select('CustUser_Id')
            ->where('User_Id', $sender)
            ->where('CustSocial_Id', $CustSocial_Id)
            ->first();
        unset($Model_CustSocial_User);
        return $Numrow_CustSocial_User['CustUser_Id'];
    }

   
}