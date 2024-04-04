<?php

namespace App\Interfaces;

interface smsRepositoryInterface
{
    public function __construct();
    public function sendOtpSms($mobile , $code);
}
