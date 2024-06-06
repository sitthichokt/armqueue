## Installation & updates

`composer create-project codeigniter4/appstarter` then `composer update` whenever
there is a new release of the framework.

When updating, check the release notes to see if there are any changes you might need to apply
to your `app` folder. The affected files can be copied or merged from
`vendor/codeigniter4/framework/app`.

กรณอัพเดทเวอร์ชั่นมากกว่า 4.5<br>
`cp vendor/codeigniter4/framework/public/index.php public/index.php`<br>
`cp vendor/codeigniter4/framework/spark spark`

เมื่อปรับใช้กับเซิร์ฟเวอร์ที่ใช้งานจริง<br>
`composer install --no-dev`

optimize composer <br>
`composer dump-autoload --optimize`<br>
`composer dump-autoload --classmap-authoritative`


## Setup

Copy `env` to `.env` and tailor for your app, specifically the baseURL
and any database settings.
```env
#--------------------------------------------------------------------
# ENVIRONMENT
#--------------------------------------------------------------------

#CI_ENVIRONMENT = production
CI_ENVIRONMENT = development

#--------------------------------------------------------------------
# APP
#--------------------------------------------------------------------

app.baseURL = 'https://localhost/testq/'
 app.appTimezone = 'Asia/Bangkok'
# If you have trouble with `.`, you could also use `_`.
# app_baseURL = ''
app.forceGlobalSecureRequests = true
app.CSPEnabled = false

#--------------------------------------------------------------------
# API
#--------------------------------------------------------------------

 armapi_secret_key             = ''

 # API BOT
 LINEBOT_BASE_ENDPOINT_URL     = ''
 LINEBOT_USER                  = ''
 LINEBOT_PASS                  = ''
 FACEBOOKBOT_BASE_ENDPOINT_URL = ''
 FACEBOOKBOT_USER              = ''
 FACEBOOKBOT_PASS              = ''
 CHATBOT_BASE_ENDPOINT_URL     = ''
 CHATBOT_USER                  = ''
 CHATBOT_PASS                  = ''

 # ARMLINK
 ARMLINK_HOST                  = ''
 ARMLINK_APPID		       = ''
 ARMLINK_ACCESSTOKEN	       = ''
 # ARMLINK FB_review
 FBRW_AGENTID 		       = ''
 FBRW_ARMLINK_APPID 	       = ''
 FBRW_ARMLINK_ACCESSTOKEN      = ''

 # facebook
 FB_APPID      = ''
 FB_APPSECRET  = ''
 FB_APPVERTION = 'v18.0'
 FB_APPTOKEN   = '|'

 # twittwr
 TW_CONSUMER_KEY         = ''
 TW_CONSUMER_SECRET      = ''
 # twitter v2
 TW_BASE_ENDPOINT_URL    = 'https://api.twitter.com/2/'
 TW_CLIENT_ID            = ''
 TW_CLIENT_SECRET        = ''
 TW_REDIRECT_URL         = ''

# shoppee
 SHOPEE_HOST          = 'https://partner.shopeemobile.com'
 SHOPEE_PARTNER_KEY   = ''
 SHOPEE_PARTNER_ID    = '' 
 SHOPEE_WH_URL        = ''

# lazada 
 LAZADA_URL           = 'https://api.lazada.co.th/rest'
 LAZADA_KEY           = ''
 LAZADA_SECRET        = ''



#--------------------------------------------------------------------
# DATABASE
#--------------------------------------------------------------------

queue.defaultHandler = 'database'
queue.database.dbGroup = 'armlog'

 database.defaultGroup    = 'armlog'

 database.armlog.hostname = 
 database.armlog.database = 
 database.armlog.username = 
 database.armlog.password = 
 database.armlog.DBDriver = SQLSRV
 database.armlog.encrypt  = false
 database.armlog.compress = true
 database.armlog.DBDebug  = true
 database.armlog.port     = ''
 database.armlog.strictOn = true
 database.armlog.pConnect = false


 database.tgdb.hostname   = 
 database.tgdb.database   = 
 database.tgdb.username   = 
 database.tgdb.password   = 
 database.tgdb.DBDriver   = SQLSRV
 database.tgdb.encrypt    = false
 database.tgdb.compress   = true
 database.tgdb.DBDebug    = true
 database.tgdb.port       = ''
 database.tgdb.strictOn   = true 
 database.tgdb.pConnect   = false
```
## Commands

``` 
* facebook_api คือชื่อคิวใช้อ้างอิงเมื่อเข้าถึง
* throw new \Exception('Simulated error for testing'); 

สร้างไฟล์งาน ไฟล์ Facebook จะถูกสร้างที่ App\Jobs
php spark queue:job Facebook

สำหรับรันคิวงานโดยอ้างอิงชื่อคิว
php spark queue:work facebook_api

อัพเดทสถานะ กรณีที่ status คงค้างอยู่ที 1 จะอัพเดทกลับเป็น 0
php spark queue:reset-status 

กรณีที่มีงานที่ล้มเหลว ส่งกลับไปยังคิวอีกคั้ง
php spark queue:retry all -queue facebook_api

ตรวจสอบงานที่ล้มเหลว ('งานที่ล้มเหลวจะถูกเก็บในตาราง queue_jobs_failed')
php spark queue:failed -queue facebook_api
```




