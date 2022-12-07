<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);
//Report1
include_once("vendor/autoload.php");
use Yvesniyo\IntouchSms\SmsSimple;
/** @var \Yvesniyo\IntouchSms\SmsSimple */
$messi="Thank you for using our parking";
$phone="0788750979";
$sms = new SmsSimple();
$sms->recipients([$phone])
    ->message($messi)
    ->sender("+250780771319")
    ->username("kwizeraar")
    ->password("kwizera@123")
    ->apiUrl("www.intouchsms.co.rw/api/sendsms/.json")
    ->callBackUrl("");
print_r($sms->send());
//Report2
//Send card
?>