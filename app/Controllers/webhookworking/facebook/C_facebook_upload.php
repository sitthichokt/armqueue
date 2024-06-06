<?php

namespace App\Controllers\webhookworking\facebook;


class C_facebook_upload 
{
    private function attachments_setpart_in($arcut_id,$CustSocial_Id){
        $datePath           = date("dmY");
        $part = 'uploads/CustomerProject/' . $arcut_id . '/Facebook' . $CustSocial_Id . '/attachments/in/' . $datePath . '/';
        return $part;
    }

    public function upload($type, $attachments, $CustSocial_Id, $arcut_id)
    {
   
        if ($type === 'video') {
            $outputFolder = $this->attachments_setpart_in($arcut_id,$CustSocial_Id). '/vdo/';
        } else if ($type === 'audio') {
            $outputFolder = $this->attachments_setpart_in($arcut_id,$CustSocial_Id). '/audio/';
        } else if ($type === 'image') {
            $outputFolder = $this->attachments_setpart_in($arcut_id,$CustSocial_Id). '/picture/' . uniqid('image_') . '/';
        } else if ($type === 'file') {
            $outputFolder = $this->attachments_setpart_in($arcut_id,$CustSocial_Id). '/document/';
        }
    

        if (!empty($attachments) && isset($attachments, $type)) {

            $data = []; // ภาพจะมาเป็น array
            if (is_array($attachments)) {

                foreach ($attachments as $key => $value) {

                  
                    if (isset($value['payload']['url'])) {
                        $filedata = file_get_contents($value['payload']['url']);
                        $urlInfo  = parse_url($value['payload']['url']);
                    } else {
                        $filedata = file_get_contents($value);
                        $urlInfo  = parse_url($value);
                    }

                    $path      = $urlInfo['path'];
                    $fileInfo  = pathinfo($path);

                    $oldname   = isset($fileInfo['basename']) ? $fileInfo['basename'] : '';
                    $extension = isset($fileInfo['extension']) ? $fileInfo['extension'] : '';

                    if ($type === 'image') {
                        $part = $outputFolder . $key . '/';
                        $part_del = $outputFolder;
                        $filename     = 'default.jpg'; // เปลี่ยนชื่อไฟล์
                        if (!is_dir(WRITEPATH . $part)) {
                            mkdir(WRITEPATH . $part, 0777, true);
                        }
                        file_put_contents(WRITEPATH . $part . $filename, $filedata);

                        $image1 = \Config\Services::image()
                            ->withFile(WRITEPATH . $part . $filename)
                            ->resize(100, 100, true, 'height')
                            ->save(WRITEPATH . $part . 's.jpg');
                    } else {
                        $part = $outputFolder;
                        $part_del = $outputFolder;
                        $filename     = uniqid('att_') . '.' . $extension; // เปลี่ยนชื่อไฟล์
                        if (!is_dir(WRITEPATH . $part .  '/')) {
                            mkdir(WRITEPATH . $part .  '/', 0777, true);
                        }
                        file_put_contents(WRITEPATH . $part .  '/' . $filename, $filedata);

                    }

                    $file_url = writable_setpart2($part . $filename);
                    $data[] =     [
                        'url'=> $file_url
                        ,'part'=> $part
                        ,'part_del'=> $part_del
                        ,'type'=> $type
                        ,'extension'=> $extension
                        ,'oldname'=> $oldname
                        ,'newname'=> $filename
                    ];
                }
            }

            return $data;
        }
 
    }

    public function upload_post($type, $attachments, $CustSocial_Id, $arcut_id){

        if ($type === 'video') {
            $outputFolder = $this->attachments_setpart_in($arcut_id,$CustSocial_Id). '/vdo/';
        } else if ($type === 'audio') {
            $outputFolder = $this->attachments_setpart_in($arcut_id,$CustSocial_Id). '/audio/';
        } else if ($type === 'image') {
            $outputFolder = $this->attachments_setpart_in($arcut_id,$CustSocial_Id). '/picture/' . uniqid('image_') . '/';
        } else if ($type === 'file') {
            $outputFolder = $this->attachments_setpart_in($arcut_id,$CustSocial_Id). '/document/';
        }

        if (!empty($attachments) && isset($attachments, $type)) {

            $data = []; // ภาพจะมาเป็น array
      
            if (is_array($attachments)) {

                foreach ($attachments as $value) {
                    $filedata = file_get_contents($value);
                    $urlInfo  = parse_url($value);
                    
                    $path      = $urlInfo['path'];
                    $fileInfo  = pathinfo($path);

                    $oldname   = isset($fileInfo['basename']) ? $fileInfo['basename'] : '';
                    $extension = isset($fileInfo['extension']) ? $fileInfo['extension'] : '';

                    if ($type === 'image') {
                        $part = $outputFolder;
                        $part_del = $outputFolder;
                        $filename     = 'default.jpg'; // เปลี่ยนชื่อไฟล์
                        if (!is_dir(WRITEPATH . $part)) {
                            mkdir(WRITEPATH . $part, 0777, true);
                        }
                        file_put_contents(WRITEPATH . $part . $filename, $filedata);

                        $image1 = \Config\Services::image()
                            ->withFile(WRITEPATH . $part . $filename)
                            ->resize(100, 100, true, 'height')
                            ->save(WRITEPATH . $part . 's.jpg');
                    } else {
                        $part = $outputFolder;
                        $part_del = $outputFolder;
                        $filename     = uniqid('att_') . '.' . $extension; // เปลี่ยนชื่อไฟล์
                        if (!is_dir(WRITEPATH . $part .  '/')) {
                            mkdir(WRITEPATH . $part .  '/', 0777, true);
                        }
                        file_put_contents(WRITEPATH . $part .  '/' . $filename, $filedata);

                    }

                    $file_url = writable_setpart2($part . $filename);
                    $data[] =     [
                        'url'=> $file_url
                        ,'part'=> $part
                        ,'part_del'=> $part_del
                        ,'type'=> $type
                        ,'extension'=> $extension
                        ,'oldname'=> $oldname
                        ,'newname'=> $filename
                    ];
                }
                    
            }else{
                    $filedata = file_get_contents($attachments);
                    $urlInfo  = parse_url($attachments);
                    
                    $path      = $urlInfo['path'];
                    $fileInfo  = pathinfo($path);

                    $oldname   = isset($fileInfo['basename']) ? $fileInfo['basename'] : '';
                    $extension = isset($fileInfo['extension']) ? $fileInfo['extension'] : '';

                    if ($type === 'image') {
                        $part = $outputFolder;
                        $part_del = $outputFolder;
                        $filename     = 'default.jpg'; // เปลี่ยนชื่อไฟล์
                        if (!is_dir(WRITEPATH . $part)) {
                            mkdir(WRITEPATH . $part, 0777, true);
                        }
                        file_put_contents(WRITEPATH . $part . $filename, $filedata);

                        $image1 = \Config\Services::image()
                            ->withFile(WRITEPATH . $part . $filename)
                            ->resize(100, 100, true, 'height')
                            ->save(WRITEPATH . $part . 's.jpg');
                    } else {
                        $part = $outputFolder;
                        $part_del = $outputFolder;
                        $filename     = uniqid('att_') . '.' . $extension; // เปลี่ยนชื่อไฟล์
                        if (!is_dir(WRITEPATH . $part .  '/')) {
                            mkdir(WRITEPATH . $part .  '/', 0777, true);
                        }
                        file_put_contents(WRITEPATH . $part .  '/' . $filename, $filedata);

                    }

                    $file_url = writable_setpart2($part . $filename);
                    $data[] =     [
                        'url'=> $file_url
                        ,'part'=> $part
                        ,'part_del'=> $part_del
                        ,'type'=> $type
                        ,'extension'=> $extension
                        ,'oldname'=> $oldname
                        ,'newname'=> $filename
                    ];
            }
                
            
            return $data;


        }
    }
    /**
     * @return url
     * @return filename
     * @return part
     */
    public function uploadProfile($imageData, $arcut_id, $CustSocial_Id, $page)
    {
        helper('setpart');
        $part = $arcut_id . '/Facebook' . $CustSocial_Id;
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
