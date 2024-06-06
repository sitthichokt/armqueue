<?php

namespace App\Jobs;

use CodeIgniter\Queue\BaseJob;
use CodeIgniter\Queue\Interfaces\JobInterface;
use Exception;

class Email extends BaseJob implements JobInterface
{
    // protected int $retryAfter = 60;
    // protected int $tries      = 1;
    public function process()
    {
        $email  = service('email', null, false);
        // $result = $email
        //     ->setTo('[email protected]')
        //     ->setSubject('My test email')
        //     ->setMessage($this->data['message'])
        //     ->send(false);

        // if (! $result) {
        //     throw new Exception($email->printDebugger('headers'));
        // }

        return $this->data['message'];
    }
}
