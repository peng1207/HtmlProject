<?php 
require_once('conn.php');
$raw = file_get_contents('php://input');//获取非表单数据
$requestData = json_decode($raw,TRUE); 
 
$info = @$requestData['info'] ? $requestData['info'] : ''; 
$phone = @$requestData['phone'] ? $requestData['phone'] : ''; 
$name = @$requestData['name'] ? $requestData['name'] : ''; 
if (empty($phone)){
    Response::failure("1","联系方法不能为空");
}
if (empty($name)){
    Response::failure("2","称呼不能为空");
}

$sqla = "INSERT INTO feedback(info,phone,name) VALUES ('$info','$phone','$name')";
$result = mysql_query($sqla,$conn); 
if ($result) {
    Response::json("0","提交成功"); 
}else{
    Response::failure("101","提交失败"); 
}






?>
