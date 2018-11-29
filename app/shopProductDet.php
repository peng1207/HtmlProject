<?php
require_once('conn.php');
$raw = file_get_contents('php://input');//获取非表单数据
$requestData = json_decode($raw,TRUE); 
 

$id = @$requestData['id'] ? $requestData['id'] : ""; 

if (empty($id)){
    Response::failure("1","商品ID不能为空");
}

$sqla = "SELECT * from product where id = '$id'"; 
$result = mysql_query($sqla,$conn); 
if ($result){
    Response::json("0","获取数据成功",$result); 
}else{
    Response::failure("101","获取数据失败"); 
}

?> 
