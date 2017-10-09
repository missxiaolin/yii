<?php

namespace console\controllers;

use console\controllers\contract\JobInterface;

class Email implements JobInterface
{
    public $subject;

    public $body;

    public $target;

    public function __construct($subject, $body, $target)
    {
        $this->subject = $subject;
        $this->body = $body;
        $this->target = $target;
    }

    public function handle()
    {
        // TODO: Implement handle() method.
        $this->sendEmail();
    }

    /**
     *
     */
    public function sendEmail()
    {
        dump('发送邮件');
    }
}