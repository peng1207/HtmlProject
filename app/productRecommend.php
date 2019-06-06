<?php
require_once('conn.php');
$raw = file_get_contents('php://input');//获取非表单数据
$requestData = json_decode($raw,TRUE); 

$is_recommend = $requestData['is_recommend'] == null ? 0 : $requestData['is_recommend']; 
$id =  @$requestData['id'] ? $requestData['id'] : ''; 
if (empty($id)){
    Response::failure("1","id不能为空");
}

$sqla = "UPDATE product set is_recommend = '$is_recommend' where id ='$id'";
$result = mysql_query($sqla,$conn);
  
if ($result){
    Response::json("0",$is_recommend == 0 ? "取消推荐成功" : "设置推荐成功",null); 
}else{
    Response::failure("101","修改失败");
}
?>