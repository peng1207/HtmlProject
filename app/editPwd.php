<?php

require_once('conn.php');
require_once('base.php');
$raw = file_get_contents('php://input');//获取非表单数据
$requestData = json_decode($raw,TRUE); 
$user_id = @$requestData['user_id'] ? $requestData['user_id'] : '';
$old_pwd = @$requestData['old_pwd'] ? $requestData['old_pwd'] : '';
$new_pwd = @$requestData['new_pwd'] ? $requestData['new_pwd'] : '';
if (empty($user_id)){
    Response::failure("1","无效用户"); 
}
if (empty($old_pwd)){
    Response::failure("2","旧密码不能为空"); 
}
if (empty($new_pwd)){
    Response::failure("3","新密码不能为空"); 
}

$old_md = md5($old_md);
$new_md = md5($new_md); 

$mysqla = "select * from user where user_id = '$user_id' and pwd = '$old_md'"; 
$result = mysql_query($mysqla,$conn);
$row = mysql_fetch_array($result); 
if ($result && $row){
    if ($new_md == $old_md){
        Response::failure("5","设置的密码不能跟旧密码相同"); 
    }
    $mysqla = "update user set pwd = '$new_md' where user_id = '$user_id'"; 
    $result = mysql_connect($mysqla,$conn); 
    if ($result){
        Response::json("0","设置密码成功",null);  
    }else{
        Response::failure("101","设置密码失败"); 
    }
}else{
    Response::failure("4","旧密码不对"); 
}

?>