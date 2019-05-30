<?php

require_once('conn.php');
require_once('base.php');
$raw = file_get_contents('php://input');//获取非表单数据
$requestData = json_decode($raw,TRUE); 
$advert_id = @$requestData['advert_id'] ? $requestData['advert_id'] : ''; 
$user_id =  @$requestData['user_id'] ? $requestData['user_id'] : '';
$status =  $requestData['status'];

if (empty($advert_id)){
    Response::failure("1","广告ID不能为空");
}
if (empty($user_id)){
    Response::failure("10","无效用户");
}

$sqla = "update advert set status = '$status',update_user_id = '$user_id' where advert_id = '$advert_id'";
$result = mysql_query($sqla,$conn); 
if ($result){
    Response::json("0","关闭广告成功",null); 
}else{
    Response::failure("101","关闭失败");
}

?>