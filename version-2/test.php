<?php
include("RemotePost.php");

$remotePost=new RemotePost("demo","demo1");
//ارسال پیامک حاوی کد تصادفی
// echo ($remotePost->SendCode("09116665601","تست"));

//بررسی صحت کد وارد شده
 //echo ($remotePost->IsCodeValid("09116665601","110626"));

 //ارسال پیامک حاوی کد اختصاصی
//  echo ($remotePost->SendCustomMessage("09116665601","سلام. کد شما: 123456"));
?>