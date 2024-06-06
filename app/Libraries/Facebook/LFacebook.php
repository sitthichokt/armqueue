<?php

namespace App\Libraries\facebook;

/** ## facebook ฟังชั่น
 *  - profile_get
 *  - messenger_send_message
 *  - messenger_send_attachment
 *  - messenger_send_template_button
 *  - messenger_send_template_generic
 */
class LFacebook
{
    public $fb;
    public $personid          = 'me';
    public $accesstoken       = 'EAAXH2V1Noa8BAH7RxD2uj0cPZCGJ2C1AwM3TF2a3Io8b9yLYqO5JB2bptxOZC5ARLcP7rd89XKGtUAd87hPtC0kbzgJ3ClxZCTRWDejKmy0lepj8RdMrdSfblRktotDf2bZCXJtUBzcSM5cYmP8FnW8CcJuMKEtRIswGEXQFsHCkbzCGDoSEpzp05gX3Glvd23jXtjhLcgZDZD';
    public $recipient_id      = 2351995898203217;
    public $message_text      = 'ทดสอบส่งข้อความ ข้อความเริ่มต้น';
    public $page_id           = 104823180910003;
    public $mid               = '';

    public $attachment_type   = 'image';
    public $attachment_url    = 'https://app101.tosgun.com/armshareUI/Fe-Framework/img/what-to-know-before-selling-stokphoto.jpg';

    public $payload_text      = 'ข้อความที่ต้องการแสดง ชื่อปุ่ม จำกัดอักขระ 20 ตัว';
    public $payload_buttom    = [[["type" => "postback", "title" => "Postback Button", "payload" => "ข้อความทีส่งไป webhook"], ["type" => "web_url", "url" => "https://www.messenger.com", "title" => "URL Button"]]];

    public $elements          = '';
    public $elements_title    = 'กำหนดหัวข้อที่ต้องการ';
    public $elements_subtitle = 'อธิบายรายละเอียด';

    /** ข้อกำหนดข้อความที่ส่ง */
    public $messaging_type    = "MESSAGE_TAG"; //"RESPONSE";
    public $tag               ="HUMAN_AGENT";  //"";
    public $post_id;
    public $part_file;

    public $reply_to;
    public $post_ig_id;
    public $commentid;
    public $is_hidden;
    public $metadata = '';
    public $social_type = '';
    public $comm_main = '';

    public function __construct()
    {
        $this->fb = new \Facebook\Facebook([
            'app_id' => $_ENV['FB_APPID'],
            'app_secret' => $_ENV['FB_APPSECRET'],
            'default_graph_version' => $_ENV['FB_APPVERTION'],
            'default_access_token' => $_ENV['FB_APPTOKEN'],
        ]);
    }

    /** ## ฟังชั่น ตรวจสอบข้อมูลบัญชีของ สมาชิกของเพจ
     *  @param  int personid          รหัสอ้างอิงของสมาชิกเพจ
     *  @param  string accesstoken    โทเคนเของเพจ
     *  @return array [ชื่อโปรไฟล, ที่อยู่ภาพ]
     */

    public function profile_get(): array
    {
        set_time_limit(600);
        try {
            // Example API request to get user profile picture
            $data['status']  = true;
            $this->fb->setDefaultAccessToken($this->accesstoken);
            $response = $this->fb->get('/' . $this->personid . '?fields=name,picture{url}');
            $getdata = $response->getDecodedBody();
            $data['picture']  = $getdata['picture']['data']['url'];
            $data['name']     = $getdata['name'];
            $data['id']       = $getdata['id'];
            unset($response, $getdata);
        } catch (\Facebook\Exceptions\FacebookResponseException $e) {
            // Handle API response error
            unset($response);
            $errer = new FBError_get();
            $data = $errer->get($e);
            throw new \Exception($data['message']);
        } catch (\Facebook\Exceptions\FacebookSDKException $e) {
            // Handle SDK specific errors
            unset($response);
            $data['status']     = false;
            $data['message']    = 'Facebook SDK returned an error: ' . $e->getMessage();
            throw new \Exception($data['message']);
        }

        return $data;
    }

    /** หาข้อความตอบกลับ 
     * @param string accesstoken
     * @param string reply_to
     */
    public function messenger_replyto(): array
    {
        try {
            // Example API request to get user profile picture
            $data['status']  = true;
            $this->fb->setDefaultAccessToken($this->accesstoken);
            $response = $this->fb->get('/' . $this->reply_to . '?fields=message,attachments{mime_type,video_data,image_data,file_url}');
            $getdata = $response->getDecodedBody();
            $data['message']    = $getdata['message'];
            $data['status']     = true;
            unset($response, $getdata);
        } catch (\Facebook\Exceptions\FacebookResponseException $e) {
            // Handle API response error
            unset($response);
            $errer = new FBError_get();
            $data = $errer->get($e);
            throw new \Exception($data['message']);

        } catch (\Facebook\Exceptions\FacebookSDKException $e) {
            // Handle SDK specific errors
            unset($response);
            $data['status']     = false;
            $data['message']    = 'Facebook SDK returned an error: ' . $e->getMessage();
            throw new \Exception($data['message']);
        }

        return $data;
    }

        /** หาข้อความ ads 
     * @param string accesstoken
     * @param string mid
     */
    public function messenger_ads(): array
    {
        try {
            // Example API request to get user profile picture
            $data['status']  = true;
            $this->fb->setDefaultAccessToken($this->accesstoken);
            $response = $this->fb->get('/' . $this->mid . '?fields=message,attachments{mime_type,video_data,image_data,file_url}');
            $getdata = $response->getDecodedBody();
            $data['message']    = $getdata['message'];
            $data['mime_type']    = isset($getdata['attachments']['data'][0]['mime_type'])?$getdata['attachments']['data'][0]['mime_type']:'';
            $data['image_data']   = isset($getdata['attachments']['data'][0]['image_data']['url'])?$getdata['attachments']['data'][0]['image_data']['url']:'';
            $data['video_data']   = isset($getdata['attachments']['data'][0]['video_data']['url'])?$getdata['attachments']['data'][0]['video_data']['url']:'';
            $data['status']     = true;
            unset($response, $getdata);
        } catch (\Facebook\Exceptions\FacebookResponseException $e) {
            // Handle API response error
            unset($response);
            $errer = new FBError_get();
            $data = $errer->get($e);
            throw new \Exception($data['message']);
        } catch (\Facebook\Exceptions\FacebookSDKException $e) {
            // Handle SDK specific errors
            unset($response);
            $data['status']     = false;
            $data['message']    = 'Facebook SDK returned an error: ' . $e->getMessage();
            throw new \Exception($data['message']);
        }

        return $data;
    }

    /** ## ฟังชั่นส่งข้อความ ไปยังสมาชิก ของเพจ 
     * - กรณีไม่กำหนด param จะส่งข้อความทดสอบไปยังบัญชีตั้งต้น
     * - จะต้องส่งภายใน 24 ชั่วโมงหลังจากที่เพจของคุณได้รับข้อความของลูกค้า
     * @param string accesstoken โทเคนเของเพจ
     * @param int recipient_id รหัสอ้างอิงของสมาชิกเพจ ที่ต้องการส่ง
     * @param string message_text ข้อความที่ต้องการส่ง
     * @param int page_id รหัสของเพจ
     * @param string messaging_type
     * @param string tag
     * @return array 
     * - [recipient_id=รหัสอ้างอิงของสมาชิกเพจ ที่รับข้อความ]
     * - [message_id=รหัสอ้างอิงข้อความ]
     * - สิทที่ต้องการ pages_show_list,pages_messaging
     * ### ข้อกำหนดข้อความที่ส่ง
     * messaging_type ประเภทของข้อความที่ส่ง
     * - RESPONSE    – ข้อความใช้สำหรับตอบกลับข้อความที่ได้รับ (ส่งภายใน 24 ชม)
     * - UPDATE      – ข้อความใช้ส่งในเชิงรุก ไม่ใช่ตอบกลับข้อความที่ได้รับ (ส่งภายใน 24 ชม)
     * - MESSAGE_TAG – ข้อความไม่ใช่การส่งเสริมการขายและ ได้รับการส่งนอกกรอบเวลาการ (โดยมีแท็กข้อความ)
     * 
     * tag แท็กที่ทำให้เพจของคุณสามารถส่งข้อความถึงบุคคลนอกกรอบเวลา
     * - ACCOUNT_UPDATE
     * - CONFIRMED_EVENT_UPDATE
     * - CUSTOMER_FEEDBACK
     * - HUMAN_AGENT
     * - POST_PURCHASE_UPDATE
     * */

    public function messenger_send_message(): array
    {
        $this->fb->setDefaultAccessToken($this->accesstoken);
        $data['status'] = true;
        $send = [
            "recipient" => [
                "id" => $this->recipient_id
            ],
            "message" => [
                "text" => $this->message_text
                ,"metadata" => $this->metadata
            ],
            "metadata" => "from_armshare",
            "messaging_type" => $this->messaging_type,
            "notification_type" => "REGULAR",
        ];
		if(!empty($this->tag)){
			$send["tag"] = $this->tag;
		}
		
        try {
            $response = $this->fb->post('/' . $this->page_id . '/messages', $send);
            $getdata  = $response->getDecodedBody();

            $data['recipient_id']   = $getdata['recipient_id'];
            $data['message_id']     = $getdata['message_id'];
            unset($send, $getdata, $response);
        } catch (\Facebook\Exceptions\FacebookResponseException $e) {
            // Handle API response error
            unset($response);
            $errer = new FBError_get();
            $data = $errer->get($e);
            throw new \Exception($data['message']);
        } catch (\Facebook\Exceptions\FacebookSDKException $e) {
            // Handle SDK specific errors
            unset($response);
            $data['status']     = false;
            $data['message']    = 'Facebook SDK returned an error: ' . $e->getMessage();
            throw new \Exception($data['message']);
        } catch( \Exception $e ){
            $data['status']     = false;
            $data['message']    = ' ไม่สามารถส่งข้อความอีกครั้งได้ขณะนี้ เมื่อผู้ติดต่อตอบกลับจึงสามารถสนทนาได้อย่างต่อเนื่อง '.$e->getMessage();
            throw new \Exception($data['message']);
        }

        return $data;
    }

    /** ## ฟังชั่นส่งข้อความ ไปยังสมาชิก ของเพจ 
     * - กรณีไม่กำหนด param จะส่งข้อความทดสอบไปยังบัญชีตั้งต้น
     * - จะต้องส่งภายใน 24 ชั่วโมงหลังจากที่เพจของคุณได้รับข้อความของลูกค้า
     * @param string accesstoken โทเคนเของเพจ
     * @param int recipient_id รหัสอ้างอิงของสมาชิกเพจ ที่ต้องการส่ง
     * @param string message_text ข้อความที่ต้องการส่ง
     * @param int page_id รหัสของเพจ
     * @param string messaging_type
     * @param string tag
     * @return array 
     * - [recipient_id=รหัสอ้างอิงของสมาชิกเพจ ที่รับข้อความ]
     * - [message_id=รหัสอ้างอิงข้อความ]
     * - สิทที่ต้องการ pages_show_list,pages_messaging
     * ### ข้อกำหนดข้อความที่ส่ง
     * messaging_type ประเภทของข้อความที่ส่ง
     * - RESPONSE    – ข้อความใช้สำหรับตอบกลับข้อความที่ได้รับ (ส่งภายใน 24 ชม)
     * - UPDATE      – ข้อความใช้ส่งในเชิงรุก ไม่ใช่ตอบกลับข้อความที่ได้รับ (ส่งภายใน 24 ชม)
     * - MESSAGE_TAG – ข้อความไม่ใช่การส่งเสริมการขายและ ได้รับการส่งนอกกรอบเวลาการ (โดยมีแท็กข้อความ)
     * 
     * tag แท็กที่ทำให้เพจของคุณสามารถส่งข้อความถึงบุคคลนอกกรอบเวลา
     * - ACCOUNT_UPDATE
     * - CONFIRMED_EVENT_UPDATE
     * - CUSTOMER_FEEDBACK
     * - HUMAN_AGENT
     * - POST_PURCHASE_UPDATE
     * */

    public function messenger_send_message_replies(): array
    {
        $this->fb->setDefaultAccessToken($this->accesstoken);
        $data['status'] = true;
        $send = [
            "recipient" => [
                "comment_id" => $this->recipient_id
            ],
            "message" => [
                "text" => $this->message_text
                ,"metadata" => $this->metadata
            ],
            "metadata" => "from_armshare",
            "messaging_type" => $this->messaging_type,
            "tag" => $this->tag,
            "notification_type" => "REGULAR",
        ];
        try {
            $response = $this->fb->post('/' . $this->page_id . '/messages', $send);
            $getdata  = $response->getDecodedBody();

            $data['recipient_id']   = $getdata['recipient_id'];
            $data['message_id']     = $getdata['message_id'];
            unset($send, $getdata, $response);
        } catch (\Facebook\Exceptions\FacebookResponseException $e) {
            // Handle API response error
            unset($response);
            $errer = new FBError_get();
            $data = $errer->get($e);
            throw new \Exception($data['message']);
        } catch (\Facebook\Exceptions\FacebookSDKException $e) {
            // Handle SDK specific errors
            unset($response);
            $data['status']     = false;
            $data['message']    = 'Facebook SDK returned an error: ' . $e->getMessage();
            throw new \Exception($data['message']);
        } catch( \Exception $e ){
            $data['status']     = false;
            $data['message']    = ' ไม่สามารถส่งข้อความอีกครั้งได้ขณะนี้ เมื่อผู้ติดต่อตอบกลับจึงสามารถสนทนาได้อย่างต่อเนื่อง '.$e->getMessage();
            throw new \Exception($data['message']);
        
        }

        return $data;
    }

    /** ## ฟังชั่นส่งไฟล์ ไปยังสมาชิก ของเพจ
     * - กรณีไม่กำหนด param จะส่งข้อความทดสอบไปยังบัญชีตั้งต้น
     * @param string accesstoken โทเคนเของเพจ
     * @param int recipient_id รหัสอ้างอิงของสมาชิกเพจ ที่ต้องการส่ง
     * @param string attachment_url ที่อยู่ไฟล์
     * @param string attachment_type ประเภทไฟล์
     * @param int page_id รหัสของเพจ
     * @param string messaging_type
     * @param string tag 
     * 
     * ### attachment_type ประเภทไฟล์ที่ต้องการส่ง
     * video,audio, file, image, template,
     * ### ข้อกำหนดข้อความที่ส่ง
     * messaging_type ประเภทของข้อความที่ส่ง
     * - RESPONSE    – ข้อความใช้สำหรับตอบกลับข้อความที่ได้รับ (ส่งภายใน 24 ชม)
     * - UPDATE      – ข้อความใช้ส่งในเชิงรุก ไม่ใช่ตอบกลับข้อความที่ได้รับ (ส่งภายใน 24 ชม)
     * - MESSAGE_TAG – ข้อความไม่ใช่การส่งเสริมการขายและ ได้รับการส่งนอกกรอบเวลาการ (โดยมีแท็กข้อความ)
     * 
     * tag แท็กที่ทำให้เพจของคุณสามารถส่งข้อความถึงบุคคลนอกกรอบเวลา
     * - ACCOUNT_UPDATE
     * - CONFIRMED_EVENT_UPDATE
     * - CUSTOMER_FEEDBACK
     * - HUMAN_AGENT
     * - POST_PURCHASE_UPDATE
     * */

    public function messenger_send_attachment(): array
    {
        $this->fb->setDefaultAccessToken($this->accesstoken);
        $data['status'] = true;
        $send = [
            "recipient" => [
                "id" => $this->recipient_id
            ],
            "metadata" => "from_armshare",
            "message" => [
                "attachment" => [
                    "type" => $this->attachment_type,
                    "payload" => [
                        "url" => $this->attachment_url,
                        "is_reusable" => true
                    ]
                ]
            ],
            "messaging_type" => $this->messaging_type,
            "tag" => $this->tag,
            "notification_type" => "REGULAR",
        ];
        try {

            $response = $this->fb->post('/' . $this->page_id . '/messages', $send);
            $getdata  = $response->getDecodedBody();
            $data['recipient_id']   = $getdata['recipient_id'];
            $data['message_id']     = $getdata['message_id'];
            $data['attachment_id']  = $getdata['attachment_id'];
            unset($send, $getdata, $response);
        } catch (\Facebook\Exceptions\FacebookResponseException $e) {
            // Handle API response error
            unset($response);
            $errer = new FBError_get();
            $data  = $errer->get($e);
            throw new \Exception($data['message']);
        } catch (\Facebook\Exceptions\FacebookSDKException $e) {
            // Handle SDK specific errors
            unset($response);
            $data['status']     = false;
            $data['message']    = 'Facebook SDK returned an error: ' . $e->getMessage();
            throw new \Exception($data['message']);
        }
        return $data;
    }


    /** ## ฟังชั่นส่งแทมเพท รูปแบบ button  ไปยังสมาชิก ของเพจ
     * - กรณีไม่กำหนด param จะส่งข้อความทดสอบไปยังบัญชีตั้งต้น
     * @param string accesstoken โทเคนเของเพจ
     * @param int recipient_id  รหัสอ้างอิงของสมาชิกเพจ ที่ต้องการส่ง
     * @param string payload_text ข้อความที่ต้องการแสดง
     * @param array payload_buttom 
     */
    public function messenger_send_template_button()
    {
        $this->fb->setDefaultAccessToken($this->accesstoken);
        $data['status'] = true;
        $send = [
            "recipient" => [
                "id" => $this->recipient_id
            ],
            "metadata" => "from_armshare",
            "message" => [
                "attachment" => [
                    "type" => "template",
                    "payload" => [
                        "template_type" => "button",
                        "text" => $this->payload_text,
                        "buttons" => $this->payload_buttom,
                    ]
                ]
            ],
            "messaging_type" => $this->messaging_type,
            "tag" => $this->tag,
            "notification_type" => "REGULAR",
        ];
        try {

            $response = $this->fb->post('/' . $this->page_id . '/messages', $send);
            $getdata  = $response->getDecodedBody();
            $data['recipient_id']   = $getdata['recipient_id'];
            $data['message_id']     = $getdata['message_id'];
            unset($send, $getdata, $response);
        } catch (\Facebook\Exceptions\FacebookResponseException $e) {
            // Handle API response error
            unset($response);
            $errer = new FBError_get();
            $data = $errer->get($e);
            throw new \Exception($data['message']);
        } catch (\Facebook\Exceptions\FacebookSDKException $e) {
            // Handle SDK specific errors
            unset($response);
            $data['status']     = false;
            $data['message']    = 'Facebook SDK returned an error: ' . $e->getMessage();
            throw new \Exception($data['message']);
        }
        return $data;
    }

    /** ## ฟังชั่นส่งแทมเพท รูปแบบ generic  ไปยังสมาชิก ของเพจ
     *  - สามารถส่งแบหลายอันได้ สูงสุด 10 อัน
     * @param string accesstoken โทเคนเของเพจ
     * @param int recipient_id  รหัสอ้างอิงของสมาชิกเพจ ที่ต้องการส่ง
     * @param array elements 
     * @param string page_id 
     */
    public function messenger_send_template_generic()
    {
        $this->elements_set();
        $this->fb->setDefaultAccessToken($this->accesstoken);
        $data['status'] = true;
        $send = [
            "recipient" => [
                "id" => $this->recipient_id
            ],
            "metadata" => "from_armshare",
            "message" => [
                "attachment" => [
                    "type" => "template",
                    "payload" => [
                        "template_type" => "generic",
                        "elements" => $this->elements

                    ]
                ]
            ],
            "messaging_type" => $this->messaging_type,
            "tag" => $this->tag,
            "notification_type" => "REGULAR",
        ];
        try {

            $response = $this->fb->post('/' . $this->page_id . '/messages', $send);
            $getdata  = $response->getDecodedBody();
            $data['recipient_id']   = $getdata['recipient_id'];
            $data['message_id']     = $getdata['message_id'];
            unset($send, $getdata, $response);
        } catch (\Facebook\Exceptions\FacebookResponseException $e) {
            // Handle API response error
            unset($response);
            $errer = new FBError_get();
            $data = $errer->get($e);
            throw new \Exception($data['message']);
        } catch (\Facebook\Exceptions\FacebookSDKException $e) {
            // Handle SDK specific errors
            unset($response);
            $data['status']     = false;
            $data['message']    = 'Facebook SDK returned an error: ' . $e->getMessage();
            throw new \Exception($data['message']);
        }
        return $data;
    }

    public function elements_set()
    {
        if ($this->elements === '') {
            $this->elements =  [
                [
                    "title" => $this->elements_title,
                    "image_url" => $this->attachment_url,
                    "subtitle" => $this->elements_subtitle,
                    "buttons" => [
                        [
                            "type" => "web_url",
                            "url" => "https://www.messenger.com",
                            "title" => "ชื่อปุ่มที่ 1"
                        ],
                        [
                            "type" => "web_url",
                            "url" => "https://www.messenger.com",
                            "title" => "ชื่อปุ่มที่ 2"
                        ]
                    ],
                ],
                [
                    "title" => $this->elements_title,
                    "image_url" => $this->attachment_url,
                    "subtitle" => $this->elements_subtitle,
                    "buttons" => [
                        [
                            "type" => "web_url",
                            "url" => "https://www.messenger.com",
                            "title" => "ชื่อปุ่มที่ 1"
                        ],
                        [
                            "type" => "web_url",
                            "url" => "https://www.messenger.com",
                            "title" => "ชื่อปุ่มที่ 2"
                        ]
                    ],
                ],
                [
                    "image_url" => "https://app101.tosgun.com/armshareUI/Fe-Framework/img/what-to-know-before-selling-stokphoto.jpg",
                    "title" => "Image 1",
                    "subtitle" => "This is image 1"
                ],
            ];
        }
    }

    /** POST
     * สร้าง post
     * @param string accesstoken โทเคนเของเพจ
     * @param string message_text
     */
    public function post_create()
    {

        $data = [
            'message' => $this->message_text,
        ];

        try {
            $response = $this->fb->post('/me/feed', $data, $this->accesstoken);
            $getdata  = $response->getDecodedBody();

            unset($data, $this->fb, $response);

            $data['post_id']    = $getdata['id'];
            $data['status']             = true;
        } catch (\Facebook\Exceptions\FacebookSDKException $e) {
            // Handle API response error
            unset($response);
            $errer = new FBError_get();
            $data  = $errer->get($e);
            throw new \Exception($data['message']);
        } catch (\Facebook\Exceptions\FacebookSDKException $e) {
            // Handle SDK specific errors
            unset($response);
            $data['status']     = false;
            $data['message']    = 'Facebook SDK returned an error: ' . $e->getMessage();
            throw new \Exception($data['message']);
        }
        return $data;
    }


    /** POST
     * ตอบกลับ post
     * @param string accesstoken โทเคนเของเพจ
     * @param string message_text
     * @param string part_file
     * @param string post_id
     */
    public function post_comment()
    {
        $this->fb->setDefaultAccessToken($this->accesstoken);
        if (!empty($this->message_text) && $this->message_text != '') {
            $data["message"] =  $this->message_text;
        }
        if (!empty($this->part_file) && $this->part_file != '') {
            $data["source"]  = $this->fb->fileToUpload($this->part_file);
        }
        unset($this->message_text, $this->part_file);

        try {

            $response = $this->fb->post('/' . $this->post_id . '/comments', $data);
            $getdata  = $response->getDecodedBody();

            unset($data, $this->post_id, $this->fb, $response);

            $data['post_comment_id']    = $getdata['id'];
            $data['status']             = true;
        } catch (\Facebook\Exceptions\FacebookSDKException $e) {
            // Handle API response error
            unset($response);
            $errer = new FBError_get();
            $data  = $errer->get($e);
            throw new \Exception($data['message']);
        } catch (\Facebook\Exceptions\FacebookSDKException $e) {
            // Handle SDK specific errors
            unset($response);
            $data['status']     = false;
            $data['message']    = 'Facebook SDK returned an error: ' . $e->getMessage();
            throw new \Exception($data['message']);
        }
        return $data;
    }

    /** แก้ไข comment 
     * กรณีที่ตอบผ่านแอพถึงจะแก้ไขได้
     * @param string accesstoken
     * @param string message_text
     * @param string part_file
     */
    public function post_comment_edit()
    {
        $this->fb->setDefaultAccessToken($this->accesstoken);
        if (!empty($this->message_text) && $this->message_text != '') {
            $data["message"] =  $this->message_text;
        }
        if (!empty($this->part_file) && $this->part_file != '') {
            $data["source"]  = $this->fb->fileToUpload($this->part_file);
        }
        unset($this->message_text, $this->part_file);

        try {
            $response = $this->fb->post('/' . $this->commentid, $data);
            $getdata  = $response->getDecodedBody();

            unset($data, $this->post_id, $this->fb, $response);

            $data['message']    = 'สำเร็จ';
            $data['status']     = $getdata['success'];
        } catch (\Facebook\Exceptions\FacebookSDKException $e) {
            // Handle API response error
            unset($response);
            $errer = new FBError_get();
            $data  = $errer->get($e);
            throw new \Exception($data['message']);
        } catch (\Facebook\Exceptions\FacebookSDKException $e) {
            // Handle SDK specific errors
            unset($response);
            $data['status']     = false;
            $data['message']    = 'Facebook SDK returned an error: ' . $e->getMessage();
            throw new \Exception($data['message']);
        }
        return $data;
    }

    /** ลบคอมเมน
     * @param string accesstoken
     * @param string commentid
     */
    public function post_comment_delete()
    {
        $this->fb->setDefaultAccessToken($this->accesstoken);
        try {
            $response = $this->fb->delete('/' . $this->commentid, []);
            $getdata  = $response->getDecodedBody();

            unset($data, $this->post_id, $this->fb, $response);

            $data['message']    = 'สำเร็จ';
            $data['status']     = isset($getdata['success'])?$getdata['success']:true;
        } catch (\Facebook\Exceptions\FacebookSDKException $e) {
            // Handle API response error
            unset($response);
            $errer = new FBError_get();
            $data  = $errer->get($e);
            throw new \Exception($data['message']);
        } catch (\Facebook\Exceptions\FacebookSDKException $e) {
            // Handle SDK specific errors
            unset($response);
            $data['status']     = false;
            $data['message']    = 'Facebook SDK returned an error: ' . $e->getMessage();
            throw new \Exception($data['message']);
        }
        return $data;
    }

    /** ซ่อนคอมเม่น
     *  บางกรณีไม่สามารถซ่อนได้เช่นของตัวเอง 
     * @param bool is_hidden ซ่อนเท่ากับ true เลิกซ่อน false
     * @param string commentid
     * @param string accesstoken
     */
    public function post_comment_ishidden()
    {
        $this->fb->setDefaultAccessToken($this->accesstoken);
        try {
            $data["is_hidden"] =  $this->is_hidden;
            $response = $this->fb->post('/' . $this->commentid,  $data);
            $getdata  = $response->getDecodedBody();
            unset($data, $this->commentid, $this->fb, $response);

            $data['message']    = 'สำเร็จ';
            $data['status']     = $getdata['success'];
        } catch (\Facebook\Exceptions\FacebookSDKException $e) {
            // Handle API response error
            unset($response);
            $errer = new FBError_get();
            $data  = $errer->get($e);
            throw new \Exception($data['message']);
        } catch (\Facebook\Exceptions\FacebookSDKException $e) {
            // Handle SDK specific errors
            unset($response);
            $data['status']     = false;
            $data['message']    = 'Facebook SDK returned an error: ' . $e->getMessage();
            throw new \Exception($data['message']);
        }
        return $data;
    }



    /** ## ฟังชั่น 
     *  @param  string accesstoken    โทเคนเของเพจ
     *  @param  string post_id  
     *  @return array 
     */
    public function status_get(): array
    {
        try {
            // Example API request to get user profile picture
            $data['status']  = true;
            $this->fb->setDefaultAccessToken($this->accesstoken);
            $response = $this->fb->get('/' . $this->post_id . '?fields=story,permalink_url,status_type');
            $getdata = $response->getDecodedBody();
            $data['story']  =  !empty($getdata['story']) ? $getdata['story'] : '';
            $data['permalink_url']  = $getdata['permalink_url'];
            $data['status_type']  = $getdata['status_type'];
            $data['status']     = true;
            unset($response, $getdata);
        } catch (\Facebook\Exceptions\FacebookResponseException $e) {
            // Handle API response error
            unset($response);
            $errer = new FBError_get();
            $data = $errer->get($e);
            throw new \Exception($data['message']);
        } catch (\Facebook\Exceptions\FacebookSDKException $e) {
            // Handle SDK specific errors
            unset($response);
            $data['status']     = false;
            $data['message']    = 'Facebook SDK returned an error: ' . $e->getMessage();
            throw new \Exception($data['message']);
        }

        return $data;
    }

    public function get_url_post(){
        try {
            // Example API request to get user profile picture
            $data['status']  = true;
            $this->fb->setDefaultAccessToken($this->accesstoken);
            $response = $this->fb->get('/' . $this->post_id . '?fields=permalink_url');
            $getdata = $response->getDecodedBody();
            $data['permalink_url']  = !empty($getdata['permalink_url']) ? $getdata['permalink_url'] : '';
            $data['status']         = true;
            unset($response, $getdata);
        } catch (\Facebook\Exceptions\FacebookResponseException $e) {
            // Handle API response error
            unset($response);
            $errer = new FBError_get();
            $data = $errer->get($e);
            throw new \Exception($data['message']);
        } catch (\Facebook\Exceptions\FacebookSDKException $e) {
            // Handle SDK specific errors
            unset($response);
            $data['status']     = false;
            $data['message']    = 'Facebook SDK returned an error: ' . $e->getMessage();
            throw new \Exception($data['message']);
        }

        return $data;
    }

    /** ดูข้อความด้วย mid 
     * @param string accesstoken
     * @param string mid
     * @param string social_type
     * @param string comm_main
     */
    public function get_messenger_by_mid(): array
    {
        try {
            // Example API request to get user profile picture
            $data['status']  = true;
            $this->fb->setDefaultAccessToken($this->accesstoken);

            if($this->social_type === 'Comment'){
                if($this->comm_main === 'Y'){ 
                    $response = $this->fb->get('/' . $this->mid . '?fields=permalink_url,message,attachments{media,type}');
                }else{
                    $response = $this->fb->get('/' . $this->mid . '?fields=message,attachment{media}');
                }
            }else{
                $response = $this->fb->get('/' . $this->mid . '?fields=message,attachments{mime_type,video_data,image_data,file_url}');
            }
            
            $getdata = $response->getDecodedBody();
            $data['message']     = isset($getdata['message'])? $getdata['message'] : '';
            if(isset($getdata['attachments'])){
                $data['attachments'] = $getdata['attachments'];
            }elseif(isset($getdata['attachment'])){
                $data['attachments'] = $getdata['attachment'];
            }elseif(isset($getdata['permalink_url'])){
                $data['attachments'] = $getdata['permalink_url'];
            }else{
                $data['attachments'] = array();
            }
            $data['status']      = true;
            unset($response, $getdata);
        } catch (\Facebook\Exceptions\FacebookResponseException $e) {
            // Handle API response error
            unset($response);
            $errer = new FBError_get();
            $data = $errer->get($e);
            throw new \Exception($data['message']);
        } catch (\Facebook\Exceptions\FacebookSDKException $e) {
            // Handle SDK specific errors
            unset($response);
            $data['status']     = false;
            $data['message']    = 'Facebook SDK returned an error: ' . $e->getMessage();
            throw new \Exception($data['message']);
        }

        return $data;
    }
    /** ดูข้อความด้วย mid 
     * @param string accesstoken
     * @param string mid
     * @param string social_type
     * @param string comm_main
     */
    public function get_post_by_mid(): array
    {
        try {
            // Example API request to get user profile picture
            $data['status']  = true;
            $this->fb->setDefaultAccessToken($this->accesstoken);
            $response = $this->fb->get('/' . $this->mid . '?fields=permalink_url,message,attachments{media,type}');       
            $getdata = $response->getDecodedBody();
            $data['message']     = isset($getdata['message'])? $getdata['message'] : '';

            if(isset($getdata['attachments'])){
                $data['attachments'] = $getdata['attachments'];
            }
            if(isset($getdata['permalink_url'])){
                $data['permalink_url'] = $getdata['permalink_url'];
            }
            $data['status']      = true;
            unset($response, $getdata);
        } catch (\Facebook\Exceptions\FacebookResponseException $e) {
            // Handle API response error
            unset($response);
            $errer = new FBError_get();
            $data = $errer->get($e);
            throw new \Exception($data['message']);
        } catch (\Facebook\Exceptions\FacebookSDKException $e) {
            // Handle SDK specific errors
            unset($response);
            $data['status']     = false;
            $data['message']    = 'Facebook SDK returned an error: ' . $e->getMessage();
            throw new \Exception($data['message']);
        }

        return $data;
    }


    public function unsetFb()
    {
        unset($this->fb);
    }


    // // ig
    // public function ig_caption_get(): array
    // {
    //     try {
    //         // Example API request to get user profile picture
    //         $data['status']  = true;
    //         $this->fb->setDefaultAccessToken($this->accesstoken);

    //         $response = $this->fb->get('/' . $this->post_ig_id . '?fields=caption,media_url,like_count,ig_id,username,shortcode,is_comment_enabled,comments_count,id,media_type,owner,permalink,timestamp');
    //         $getdata = $response->getDecodedBody();

    //         $data['caption']    = !empty($getdata['caption']) ? $getdata['caption'] : '';
    //         $data['media_url']  = !empty($getdata['media_url']) ? $getdata['media_url'] : '';
    //         $data['media_type'] = !empty($getdata['media_type']) ? $getdata['media_type'] : '';
    //         $data['permalink']  = !empty($getdata['permalink']) ? $getdata['permalink'] : '';
    //         $data['username']   = !empty($getdata['username']) ? $getdata['username'] : '';

    //         unset($response, $getdata);
    //     } catch (\Facebook\Exceptions\FacebookResponseException $e) {
    //         // Handle API response error
    //         unset($response);
    //         $errer = new FBError_get();
    //         $data = $errer->get($e);
    //     } catch (\Facebook\Exceptions\FacebookSDKException $e) {
    //         // Handle SDK specific errors
    //         unset($response);
    //         $data['status']     = false;
    //         $data['message']    = 'Facebook SDK returned an error: ' . $e->getMessage();
    //     }

    //     return $data;
    // }

    // public function ig_profile_get(): array
    // {
    //     try {
    //         // Example API request to get user profile picture
    //         $data['status']  = true;
    //         $this->fb->setDefaultAccessToken($this->accesstoken);
    //         $response = $this->fb->get('/' . $this->personid . '?fields=username,profile_pic');
    //         $getdata = $response->getDecodedBody();
    //         $data['picture']  = !empty($getdata['profile_pic']) ? $getdata['profile_pic'] : '';
    //         $data['name']     = !empty($getdata['username']) ? $getdata['username'] : '';
    //         $data['id']       = $getdata['id'];
    //         unset($response, $getdata);
    //     } catch (\Facebook\Exceptions\FacebookResponseException $e) {
    //         // Handle API response error
    //         unset($response);
    //         $errer = new FBError_get();
    //         $data = $errer->get($e);
    //     } catch (\Facebook\Exceptions\FacebookSDKException $e) {
    //         // Handle SDK specific errors
    //         unset($response);
    //         $data['status']     = false;
    //         $data['message']    = 'Facebook SDK returned an error: ' . $e->getMessage();
    //     }

    //     return $data;
    // }

    // public function ig_profile_getadmin(): array
    // {
    //     try {
    //         // Example API request to get user profile picture
    //         $data['status']  = true;
    //         $this->fb->setDefaultAccessToken($this->accesstoken);
    //         $response = $this->fb->get('/' . $this->personid . '?fields=username,profile_picture_url');
    //         $getdata = $response->getDecodedBody();
    //         $data['picture']  = !empty($getdata['profile_picture_url']) ? $getdata['profile_picture_url'] : '';
    //         $data['name']     = !empty($getdata['username']) ? $getdata['username'] : '';
    //         $data['id']       = $getdata['id'];
    //         unset($response, $getdata);
    //     } catch (\Facebook\Exceptions\FacebookResponseException $e) {
    //         // Handle API response error
    //         unset($response);
    //         $errer = new FBError_get();
    //         $data = $errer->get($e);
    //     } catch (\Facebook\Exceptions\FacebookSDKException $e) {
    //         // Handle SDK specific errors
    //         unset($response);
    //         $data['status']     = false;
    //         $data['message']    = 'Facebook SDK returned an error: ' . $e->getMessage();
    //     }

    //     return $data;
    // }
}
// ข้อกำนหด https://developers.facebook.com/docs/messenger-platform/reference/send-api/