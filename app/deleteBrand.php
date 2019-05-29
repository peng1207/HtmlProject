<?php

require_once('conn.php');
 
$raw = file_get_contents('php://input');//获取非表单数据
$requestData = json_decode($raw,TRUE); 
$brand_id = @$requestData['brand_id'] ? $requestData['brand_id'] : ''; 
if (empty($brand_id)){
    Response::failure("1","id不能为空");
}
// $sqla = "DELETE FROM brand where brand_id = '$brand_id'";
$sqla = "update brand set status = '0' where brand_id = '$brand_id'";
$result1 = mysql_query($sqla,$conn);
mysql_close($conn);
if ($result1){
    Response::json("0","删除品牌成功",null);  
}else{
    Response::failure("101","删除品牌失败");
}


?>