<?php

require_once('conn.php');
 
$raw = file_get_contents('php://input');//获取非表单数据
$requestData = json_decode($raw,TRUE); 
$spec_id = @$requestData['spec_id'] ? $requestData['spec_id'] : ''; 
if (empty($spec_id)){
    Response::failure("1","id不能为空");
}
$sqla = "DELETE from spec where spec_id = '$spec_id'";
$result1 = mysql_query($sqla,$conn);
mysql_close($conn);
if ($result1){
    Response::json("0","删除规格成功",null);  
}else{
    Response::failure("101","删除规格失败");
}


?>