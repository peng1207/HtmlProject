<?php

require_once('conn.php');
 
$raw = file_get_contents('php://input');//获取非表单数据
$requestData = json_decode($raw,TRUE); 
$unit_id = @$requestData['unit_id'] ? $requestData['unit_id'] : ''; 
if (empty($unit_id)){
    Response::failure("1","id不能为空");
}
// $sqla = "DELETE from unit where unit_id = '$unit_id'";
$sqla = "update unit set status = '0' where unit_id = '$unit_id'";
$result1 = mysql_query($sqla,$conn);
  
if ($result1){
    Response::json("0","删除单位成功",null);  
}else{
    Response::failure("101","删除单位失败");
}
?>