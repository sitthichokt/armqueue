<?php

namespace App\Jobs;

use CodeIgniter\Queue\BaseJob;
use CodeIgniter\Queue\Interfaces\JobInterface;

class Line extends BaseJob implements JobInterface
{
    protected int $retryAfter = 60;
    protected int $tries      = 2;
    public function process()
    {
    }
}
