<?php

namespace App\Libraries\facebook;

use App\Models\TGDB\FB_ErrCode;

/** ## facebook ฟังชั่น
 *  - profile_get
 *  - messenger_send_message
 *  - messenger_send_attachment
 *  - messenger_send_template_button
 *  - messenger_send_template_generic
 */
class FBError_get
{
    public function get($e){
         
            $FB_ECODE           = $e->getCode();
            $FB_SUBCODE          = $e->getSubErrorCode();
            $FB_ESMESS          = $e->getMessage();
            $ModelFB_ErrCode    = new FB_ErrCode();
            $results_FB_ErrCode = $ModelFB_ErrCode->select('FB_Err_Text')
                ->where('FB_Err_Code', $FB_ECODE)
                ->where('FB_Err_SubCode', $FB_SUBCODE)
                ->first();
            $msgerr = (!empty($results_FB_ErrCode) && $results_FB_ErrCode['FB_Err_Text'] == '') ? $results_FB_ErrCode['FB_Err_Text'] : $FB_ESMESS;

            $data['status']  = false;
            $data['code']  = $FB_ECODE; 
            $data['subcode']  = $FB_SUBCODE; 
            $data['message'] =  $FB_ECODE . '(' . $FB_SUBCODE . ') ' . trim($msgerr);
            return $data;
    }
}