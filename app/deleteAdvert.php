<?php
require_once('conn.php');
require_once('base.php');
$raw = file_get_contents('php://input');//获取非表单数据
$requestData = json_decode($raw,TRUE); 
$advert_id = @$requestData['advert_id'] ? $requestData['advert_id'] : ''; 
$user_id =  @$requestData['user_id'] ? $requestData['user_id'] : '';

if (empty($advert_id)){
    Response::failure("1","ID不能为空"); 
}
$sqla = "SELECT * from advert where advert_id = '$advert_id' and create_user_id = '$user_id'"; 
$result = mysql_query($sqla,$conn); 
$img = ""; 
while ($row = mysql_fetch_array($result)){
    $img = @$row["img"] ? $row["img"] : ""; 
}
if (!empty($img)){
    unlink("../".$upload_img_directory.$img); 
} 
$sql1 = "delete from advert where advert_id = '$advert_id'"; 
$result1 = mysql_query($sql1); 
if ($result1){
    Response::json("0","删除广告成功",null);  
}else{
    Response::failure("101","删除广告失败");
}

?>