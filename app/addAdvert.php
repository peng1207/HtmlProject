<?php

require_once('conn.php');
 
$raw = file_get_contents('php://input');//获取非表单数据
$requestData = json_decode($raw,TRUE); 

$advert_name = @$requestData['advert_name'] ? $requestData['advert_name'] : ''; 
$img = @$requestData['img'] ? $requestData['img'] : ''; 
$user_id =  @$requestData['user_id'] ? $requestData['user_id'] : ''; 
if (empty($advert_name)){
    Response::failure("1","请输入广告名称");
}
if (empty($img)){
    Response::failure("1","请上传图片");
}
$advert_id = md5(uniqid());
$time_str = time();
$sqla = "insert into advert (advert_id,advert_name,create_time,update_time,create_user_id,img) values('$advert_id','$advert_name','$time_str','$time_str','$user_id','$img')";
$result = mysql_query($sqla,$conn); 
mysql_close($conn);
if ($result){
    Response::json("0","添加广告成功",null); 
}else{
    Response::failure("101","添加广告失败".$result);
}

?>