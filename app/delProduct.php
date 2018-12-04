<?php
require_once('conn.php');
$raw = file_get_contents('php://input');//获取非表单数据
$requestData = json_decode($raw,TRUE); 
$id = @$requestData['id'] ? $requestData['id'] : ''; 

if (empty($id)){
    Response::failure("1","ID不能为空"); 
}

$sqla = "DELETE FROM product where id='$id'";
$result = mysql_query($sqla,$conn);
if ($result){
    Response::json("0","删除商品成功",null);  
}else{
    Response::failure("101","添加商品失败");
}

?>
