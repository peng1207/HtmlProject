<?php

require_once('conn.php');
 
$raw = file_get_contents('php://input');//获取非表单数据
$requestData = json_decode($raw,TRUE); 
$status = 1;
$sqla = "select * from unit WHERE status = '$status'"; 
$result = mysql_query($sqla,$conn); 
$array = array(); 
while ($row = mysql_fetch_array($result)){
    $unit_id = @$row["unit_id"] ? $row["unit_id"] : ""; 
    $unit_name = @$row["unit_name"] ? $row["unit_name"] : ""; 
    $obj = array(
        "unit_id"=>$unit_id,
        "unit_name"=>$unit_name
    ); 
    array_push($array,$obj);
}
mysql_close($conn);
if ($result){
    Response::json("0","获取数据成功",array(
        "list"=>$array
    ) ); 
} else {
    Response::failure("101","获取数据失败 ");
}
?>