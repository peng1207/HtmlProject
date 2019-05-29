<?php

require_once('conn.php');
 
$raw = file_get_contents('php://input');//获取非表单数据
$requestData = json_decode($raw,TRUE); 
$sort_id = @$requestData['sort_id'] ? $requestData['sort_id'] : ''; 
if (empty($sort_id)){
    Response::failure("1","id不能为空");
}
// $sqla = "DELETE from sort where sort_id = '$sort_id'";
$sqla = "update sort set status = '0' where sort_id = '$sort_id'";
$result1 = mysql_query($sqla,$conn);
mysql_close($conn);
if ($result1){
    Response::json("0","删除分类成功",null);  
}else{
    Response::failure("101","删除分类失败");
}


?>