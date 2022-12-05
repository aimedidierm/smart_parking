<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);
//Report1

include_once("vendor/autoload.php");
use Yvesniyo\IntouchSms\SmsSimple;
/** @var \Yvesniyo\IntouchSms\SmsSimple */
$messi="There is dity in urinary";
$sms = new SmsSimple();
$sms->recipients(["0788750979"])
    ->message($messi)
    ->sender("+250785773017")
    ->username("ishimwee")
    ->password("ishimwe@123")
    ->apiUrl("www.intouchsms.co.rw/api/sendsms/.json")
    ->callBackUrl("");
print_r($sms->send());
//Report2
//Send card
?>