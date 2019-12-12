<?php
header("Access-Control-Allow-Origin: *");
header("charset=utf-8"); 
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-cache");
header("Pragma: no-cache");
header('content-type:text/html charset:utf-8');
header('Content-Type:application/json; charset=utf-8');
 $id = md5(uniqid());
 echo "获取32位的ID:\n";
 echo $id;
 echo "\n获取当前日期的:\n";
 $time_str = time();
 echo $time_str;
 echo "\n"
?>