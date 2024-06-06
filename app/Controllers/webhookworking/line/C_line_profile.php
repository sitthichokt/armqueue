<?php

namespace App\Controllers\webhook\line;


use App\Libraries\Line\LLine;
use App\Models\TGDB\ARCust_SocialProfile_Picture;
use App\Models\TGDB\ARCustomer_Social;
use App\Models\TGDB\CustSocial_User;
use App\Models\TGDB\proc\CustSocial_User_Manage;

class C_line_profile 
{
    /** ตรวจสอบโปรไฟล */
    public function check_profile($CustSocial_Id, $user_id, $CustSocial_Token, $page_id)
    {
        helper('setpart');
        $Model_CustSocial_User   = new CustSocial_User();
        $Numrow_CustSocial_User = $Model_CustSocial_User
            ->where('User_Id', $user_id)
            ->where('CustSocial_Id', $CustSocial_Id)
            ->countAllResults();
        unset($Model_CustSocial_User);
        if ($Numrow_CustSocial_User === 0) {

            $line = new LLine();
            $line->accesstoken = $CustSocial_Token;
            $line->userId      = $user_id;
            $data = $line->get_profile();

            if (!empty($data) && $data['status'] === true) {
                $Model_ARCustomer_Social = new ARCustomer_Social();
                $Result_ARCustomer_Social = $Model_ARCustomer_Social->select('ARCust_Id')
                    ->where('CustSocial_Group', 'Line')
                    ->where('CustSocial_PageId', $page_id)
                    ->first();
                $arcut_id = $Result_ARCustomer_Social['ARCust_Id'];

                // สร้างภาพ
                $pictureUrl = !empty($data['pictureUrl']) ? $data['pictureUrl'] : FCPATH . 'assets\img\na.jpg';
                $imageData = file_get_contents($pictureUrl,true);
                // ตรวจสอบว่าสามารถดึงข้อมูลได้หรือไม่
                if ($imageData === false) {
                    // ไม่สามารถดึงข้อมูลได้
                    $imageData = FCPATH . 'assets\img\na.jpg';
                } 

                // อัพโหลดภาพ
                $upload = new C_line_upload();
                $imageUser = $upload->uploadProfile($imageData,$arcut_id,$CustSocial_Id,'user');
                unset($upload);
                
                //insert โปรไฟล์
                $PROC_CustSocial_User_Manage = new CustSocial_User_Manage();
                $PROC_CustSocial_User_Manage->P_CustUser_Id     = $CustSocial_Id;
                $PROC_CustSocial_User_Manage->P_User_Id         = $user_id;
                $PROC_CustSocial_User_Manage->P_User_Name       = $data['displayName'];
                $PROC_CustSocial_User_Manage->P_User_ScreenName = $data['displayName'];
                $PROC_CustSocial_User_Manage->P_User_Picture    = $imageUser['url'];
                $Data_CustUser_Manage = $PROC_CustSocial_User_Manage->edit();
                unset($data, $imageData, $dmy , $PROC_CustSocial_User_Manage, $Picture_url, $pictureUrl);

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

            }
        }

        $Model_CustSocial_User   = new CustSocial_User();
        $Numrow_CustSocial_User = $Model_CustSocial_User->select('CustUser_Id')
            ->where('User_Id', $user_id)
            ->where('CustSocial_Id', $CustSocial_Id)
            ->first();
        unset($Model_CustSocial_User);
        return $Numrow_CustSocial_User['CustUser_Id'];
    }

    public function check_profile_group($CustSocial_Id, $user_id, $group_id, $CustSocial_Token, $page_id)
    {
        helper('setpart');
        $Model_CustSocial_User   = new CustSocial_User();
        $Numrow_CustSocial_User = $Model_CustSocial_User
            ->where('User_Id', $user_id)
            ->where('CustSocial_Id', $CustSocial_Id)
            ->countAllResults();
        unset($Model_CustSocial_User);
        if ($Numrow_CustSocial_User === 0) {

            $line = new LLine();
            $line->accesstoken = $CustSocial_Token;
            $line->groupId      = $group_id;
            $line->userId      = $user_id;
            $data = $line->get_profile_group();

            if (!empty($data) && $data['status'] === true) {
                $Model_ARCustomer_Social = new ARCustomer_Social();
                $Result_ARCustomer_Social = $Model_ARCustomer_Social->select('ARCust_Id')
                    ->where('CustSocial_Group', 'Line')
                    ->where('CustSocial_PageId', $page_id)
                    ->first();
                $arcut_id = $Result_ARCustomer_Social['ARCust_Id'];

                // สร้างภาพ
                $pictureUrl = !empty($data['pictureUrl']) ? $data['pictureUrl'] : FCPATH . 'assets\img\na.jpg';
                $imageData = file_get_contents($pictureUrl);

                // อัพโหลดภาพ
                $upload = new C_line_upload();
                $imageUser = $upload->uploadProfile($imageData,$arcut_id,$CustSocial_Id,'user');
                unset($upload);


                $PROC_CustSocial_User_Manage = new CustSocial_User_Manage();
                $PROC_CustSocial_User_Manage->P_CustUser_Id     = $CustSocial_Id;
                $PROC_CustSocial_User_Manage->P_User_Id         = $user_id;
                $PROC_CustSocial_User_Manage->P_User_Name       = $data['groupName'];
                $PROC_CustSocial_User_Manage->P_User_ScreenName = $data['groupName'];
                $PROC_CustSocial_User_Manage->P_User_Picture    = $imageUser['url'];
                $Data_CustUser_Manage = $PROC_CustSocial_User_Manage->edit();
                unset($data, $imageData, $dmy, $PROC_CustSocial_User_Manage, $Picture_url, $pictureUrl);

                // insert เก็บ part เข้าตาราง ARCust_SocialProfile_Picture
                if(!empty($Data_CustUser_Manage) && isset($Data_CustUser_Manage['CustUser_Id'],$Data_CustUser_Manage['Query']) && $Data_CustUser_Manage['Query'] === 'insert'){
                    $ARCust_SocialProfile_Picture = new ARCust_SocialProfile_Picture();           
                    $data = [
                        "Picture_CustType"    => 'page',
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

            }
        }

        $Model_CustSocial_User   = new CustSocial_User();
        $Numrow_CustSocial_User = $Model_CustSocial_User->select('CustUser_Id')
            ->where('User_Id', $user_id)
            ->where('CustSocial_Id', $CustSocial_Id)
            ->first();
        unset($Model_CustSocial_User);
        return $Numrow_CustSocial_User['CustUser_Id'];
    }
}
