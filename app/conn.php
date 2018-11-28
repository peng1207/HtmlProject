<?php
header("charset=utf-8"); 
$serverName="localhost"; 
$username="root"; 
$password="hsp13824404512hsp"; 
$dbname="ZKDabase"; 
$conn = mysql_connect($serverName,$username,$password); 
if (!$conn){
    echo "数据库连接失败"; 
}
mysql_select_db($dbname);
class Response{
    public static function json($code,$message="",$data=array()){
        $result=array(
         'code'=>$code,
         'message'=>$message,
         'data'=>$data
        ); 
        echo json_encode($result); 
        exit; 
    }
}


?>


