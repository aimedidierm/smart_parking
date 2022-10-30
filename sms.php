<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);


include_once("vendor/autoload.php");

use Yvesniyo\IntouchSms\SmsSimple;

/** @var \Yvesniyo\IntouchSms\SmsSimple */
$sms = new SmsSimple();
$sms->recipients(["0782168110"])
    ->message("Hello world")
    ->sender("+250788750979")
    ->username("aimedidierm")
    ->password("mugisha@123")
    ->apiUrl("www.intouchsms.co.rw/api/sendsms/.json")
    ->callBackUrl("");
print_r($sms->send());
?>