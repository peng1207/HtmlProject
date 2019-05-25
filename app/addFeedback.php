<?php 
require_once('conn.php');
 
$raw = file_get_contents('php://input');//获取非表单数据
$requestData = json_decode($raw,TRUE); 
 
$info = @$requestData['info'] ? $requestData['info'] : ''; 
$phone = @$requestData['phone'] ? $requestData['phone'] : ''; 
$name = @$requestData['name'] ? $requestData['name'] : ''; 
if (empty($name)){
    Response::failure("1","请输入您的称呼");
}
if (empty($phone)){
    Response::failure("2","请输入您的联系方式");
}
$time_str = time();
$id =  md5(uniqid());
$sqla = "INSERT INTO feedback(id,info,phone,name,create_time,update_time) VALUES ('$id','$info','$phone','$name','$time_str','$time_str')";
$result = mysql_query($sqla,$conn); 
mysql_close($con);
if ($result) {
    Response::json("0","提交成功"); 
}else{
    Response::failure("101","提交失败"); 
}
?>
