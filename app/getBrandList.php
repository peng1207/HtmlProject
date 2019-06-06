<?php

require_once('conn.php');
 
$raw = file_get_contents('php://input');//获取非表单数据
$requestData = json_decode($raw,TRUE); 
$status = 1;
$sqla = "SELECT * FROM brand WHERE status = '$status'"; 
$result = mysql_query($sqla,$conn); 
$array = array(); 
while ($row = mysql_fetch_array($result)){
    $brand_id = @$row["brand_id"] ? $row["brand_id"] : ""; 
    $brand_name = @$row["brand_name"] ? $row["brand_name"] : ""; 
    $obj = array(
        "brand_id"=>$brand_id,
        "brand_name"=>$brand_name
    ); 
    array_push($array,$obj);
}

  
if ($result){
    Response::json("0","获取数据成功",array(
        "list"=>$array
    ) ); 
} else {
    Response::failure("101","获取数据失败");
}
?>