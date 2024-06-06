<?php

namespace App\Jobs;

use App\Controllers\webhookworking\facebook\C_facebook;
use CodeIgniter\Queue\BaseJob;
use CodeIgniter\Queue\Interfaces\JobInterface;
use Exception;

class Facebook extends BaseJob implements JobInterface
{
    protected int $retryAfter = 60;
    protected int $tries      = 2;
    public function process()
    {

        // insert into [ARM_Log].[dbo].[queue_jobs] ([queue]
        // ,[payload]
        // ,[status]
        // ,[attempts]
        // ,[available_at]
        // ,[created_at]
        // ,[priority])
        // values('facebooks','{"tom":"tt","data":{"message":"Email message goes here"}}',0,0, DATEDIFF(SECOND, '1970-01-01 00:00:00-07:00',GETDATE()),DATEDIFF(SECOND, '1970-01-01 00:00:00-07:00',GETDATE()),'high')
  
        
        // $email  = service('facebooks', null, false);
        // $result = $email
        //     ->setTo('[email protected]')
        //     ->setSubject('My test email')
        //     ->setMessage($this->data['message'])
        //     ->send(false);

        // if (! $result) {
        //     throw new Exception($email->printDebugger('headers'));
        // }

        if(!empty($this->data)){        
                $vv = new C_facebook();
                $vv->hookData = $this->data;
                $vv->index();
        }else{
            throw new Exception('data null'); 
        }
      
        return true;
    }
}
