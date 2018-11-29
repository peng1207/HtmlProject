<?php
require_once('conn.php');
$raw = file_get_contents('php://input');//获取非表单数据
$requestData = json_decode($raw,TRUE); 
 

$accound = @$requestData['accound'] ? $requestData['accound'] : ''; 
$pwd = @$requestData['pwd'] ? $requestData['pwd'] : ''; 

if (empty($accound)){
    Response::failure("1","登录账号不能为空");
}
if (empty($pwd)){
    Response::failure("2","密码不能为空");
}

$sqla = "SELECT * from user where accound='$accound' and pwd='$pwd'";
 
$result = mysql_query($sqla,$conn);

if ($result){
    Response::json("0","登录成功"); 
}else{
    Response::failure("101","密码或账号错误");
}

 
?>