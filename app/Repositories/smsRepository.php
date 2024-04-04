<?php

namespace App\Repositories;

use App\Interfaces\smsRepositoryInterface;

class smsRepository implements smsRepositoryInterface{
    public function __construct()
    {
        $this->api_key = '725257747472582F6C386261775A30355157514334435941574967324C7041456D55564550744F337339453D';
    }
    public function sendOtpSms($mobile , $code)
    {
        // TODO: Implement sendOtpSms() method.
        return file_get_contents('https://api.kavenegar.com/v1/725257747472582F6C386261775A30355157514334435941574967324C7041456D55564550744F337339453D/verify/lookup.json?receptor='.$mobile.'&token='.$code.'&template=otp1');
    }
}
