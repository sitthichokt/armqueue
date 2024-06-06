<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('welcome_message');
    }
    public function index2()
    {
        service('queue')->push('emails', 'email', ['message' => 'Email message goes here']);
    }
    public function index3()
    {
        service('queue')->push('facebook_api', 'facebook', ['message' => 'Email message goes here']);
    }
}
