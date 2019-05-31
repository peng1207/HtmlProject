<?php
 
 require_once('conn.php');
 require_once('base.php');

 $raw = file_get_contents('php://input');//获取非表单数据
 $requestData = json_decode($raw,TRUE); 
 
$user_id =  @$requestData['user_id'] ? $requestData['user_id'] : '';
$company_id = @$requestData['company_id'] ? $requestData['company_id'] : '';
$company_name = @$requestData['company_name'] ? $requestData['company_name'] : '';
$phone = @$requestData['phone'] ? $requestData['phone'] : '';
$address = @$requestData['address'] ? $requestData['address'] : '';
$info = @$requestData['info'] ? $requestData['info'] : '';
$logo = @$requestData['logo'] ? $requestData['logo'] : '';
if (empty($company_id)){
    Response::failure("1","id不能为空"); 
}
if (empty($user_id)){
    Response::failure("2","无效用户"); 
}
$time_str = time();
$sqla = "update company set company_name = '$company_name',phone = '$phone',address = '$address',info = '$info',logo = '$logo',update_time = '$time_str',update_user_id='$user_id' where company_id = '$company_id'";
$result = mysql_query($sqla,$conn);
if ($result){
    Response::json("0","获取数据成功",null); 
}else{
    Response::failure("101","获取数据失败"); 
}
?>