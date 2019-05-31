<?php

require_once('response.php');
$serverName="huangshupeng.cn"; 
$username="root"; 
$password="hsp13824404512hsp"; 
$dbname="ZKDataBase"; 
$conn = mysql_connect($serverName,$username,$password); 
if (!$conn){
    echo "数据库连接失败"; 
}
mysql_select_db($dbname);
 
?>


