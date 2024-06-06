<?php

namespace App\Controllers\webhook\line;


class C_line_upload 
{

    private function attachments_setpart_in($arcut_id,$CustSocial_Id){
        $datePath           = date("dmY");
        $part = 'uploads/CustomerProject/' . $arcut_id . '/Line' . $CustSocial_Id . '/attachments/in/' . $datePath . '/';
        return $part;
    }

    private function profile_setpart($arcut_id,$CustSocial_Id){
        $datePath           = date("dmY");
        $part = 'uploads/CustomerProject/' . $arcut_id . '/Line' . $CustSocial_Id . '/attachments/in/' . $datePath . '/';
        return $part;
    }

    public function upload_img($content, $arcut_id, $CustSocial_Id)
    {
        $outputFolder   = $this->attachments_setpart_in($arcut_id,$CustSocial_Id) . 'picture/' . uniqid('image_') . '/';
        $filename       = 'default.jpg';
        if (!is_dir(WRITEPATH . $outputFolder)) {
            mkdir(WRITEPATH . $outputFolder, 0777, true);
        }
        $tt = file_put_contents(WRITEPATH . $outputFolder . $filename, $content);

        if($tt){
            try {
                $image1 = \Config\Services::image()
                ->withFile(WRITEPATH . $outputFolder . $filename)
                ->resize(100, 100, true, 'height')
                ->save(WRITEPATH . $outputFolder . 's.jpg');
            } catch (\Throwable $th) {
                return false;
            }
                
            $file_url = writable_setpart2($outputFolder . $filename);
    
            $data[] =     [
                'url'        => $file_url
                ,'part'      => $outputFolder
                ,'part_del'  => $outputFolder
                ,'type'      => 'image'
                ,'extension' => 'jpg'
                ,'oldname'   => ''
                ,'newname'   => $filename
            ];
        }else{
            return false;
        }
       
        return $data;
    }

    public function upload_vdo($content, $arcut_id, $CustSocial_Id)
    {
        $outputFolder =  $this->attachments_setpart_in($arcut_id,$CustSocial_Id) .'vdo/';
        $filename     =  uniqid('vdo_').'.mp4';
        if (!is_dir(WRITEPATH . $outputFolder)) {
            mkdir(WRITEPATH . $outputFolder, 0777, true);
        }
        file_put_contents(WRITEPATH . $outputFolder . $filename, $content);
        $file_url = writable_setpart2($outputFolder . $filename);
        $data[] =     [
            'url'        => $file_url
            ,'part'      => $outputFolder
            ,'part_del'  => $outputFolder
            ,'type'      => 'vdo'
            ,'extension' => 'mp4'
            ,'oldname'   => ''
            ,'newname'   => $filename
        ];
        return $data;
    }

    public function upload_audio($content, $arcut_id, $CustSocial_Id)
    {
        $datePath     =  date("dmY");
        $outputFolder =  $this->attachments_setpart_in($arcut_id,$CustSocial_Id) .'audio/';
        $filename     =  uniqid('audio_').'.mp3';
        if (!is_dir(WRITEPATH . $outputFolder)) {
            mkdir(WRITEPATH . $outputFolder, 0777, true);
        }
        file_put_contents(WRITEPATH . $outputFolder . $filename, $content);
        $file_url = writable_setpart2($outputFolder . $filename);
        $data[] =     [
            'url'        => $file_url
            ,'part'      => $outputFolder
            ,'part_del'  => $outputFolder
            ,'type'      => 'audio'
            ,'extension' => 'mp3'
            ,'oldname'   => ''
            ,'newname'   => $filename
        ];
        return $data;
    }

    public function upload_file($content, $arcut_id, $CustSocial_Id,$filenames)
    {
        $datePath     =  date("dmY");
        $outputFolder =  $this->attachments_setpart_in($arcut_id,$CustSocial_Id) .'file/';
        $filename     =  $filenames;
        if (!is_dir(WRITEPATH . $outputFolder)) {
            mkdir(WRITEPATH . $outputFolder, 0777, true);
        }
        file_put_contents(WRITEPATH . $outputFolder . $filename, $content);
        $file_url = writable_setpart2($outputFolder . $filename);
        $data[] =     [
            'url'        => $file_url
            ,'part'      => $outputFolder
            ,'part_del'  => $outputFolder
            ,'type'      => 'file'
            ,'extension' => ''
            ,'oldname'   => $filename
            ,'newname'   => $filename
        ];
        return $data;
    }

    /**
     * @return url
     * @return filename
     * @return part
     */
    public function uploadProfile($imageData, $arcut_id, $CustSocial_Id, $page)
    {
        $part = $arcut_id . '/Line' . $CustSocial_Id;
        // กำหนดที่อยู่และชื่อไฟล์
        $outputFolder =  Part_SocialProfile($part,$page);
        $filename     = uniqid('profile_') . '.jpg'; // เปลี่ยนชื่อไฟล์
        // ตรวจสอบว่าโฟลเดอร์ปลายทางมีอยู่หรือไม่ และสร้างโฟลเดอร์หากไม่มี
        if (!is_dir(WRITEPATH . $outputFolder)) {
            mkdir(WRITEPATH . $outputFolder, 0777, true);
        }
        file_put_contents(WRITEPATH . $outputFolder . $filename, $imageData);
        $Picture_url = writable_setpart2($outputFolder . $filename);
        return  ['url' => $Picture_url, 'filename' => $filename, 'part' => $outputFolder];
    }
}
