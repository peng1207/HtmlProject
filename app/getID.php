<?php
$raw = file_get_contents('php://input');//获取非表单数据
$requestData = json_decode($raw,TRUE); 

require_once('response.php');
$num = @$requestData['num'] ? $requestData['num'] : 1; 
 
$idArray = array(); 
for ($x=0; $x<$num; $x++) {
    array_push($idArray,md5(uniqid()));
} 
$time_str = time();
Response::json("0","获取数据成功",array(
    // "id"=>$id,
    "idList"=>$idArray,
    "time"=>$time_str
)); 

?>