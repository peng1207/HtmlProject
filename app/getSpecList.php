<?php

require_once('conn.php');
 
$raw = file_get_contents('php://input');//获取非表单数据
$requestData = json_decode($raw,TRUE); 

$sqla = "select * from spec"; 
$result = mysql_query($sqla,$conn); 
$array = array(); 
while ($row = mysql_fetch_array($result)){
    $spec_id = @$row["spec_id"] ? $row["spec_id"] : ""; 
    $spec_name = @$row["spec_name"] ? $row["spec_name"] : ""; 
    $obj = array(
        "spec_id"=>$spec_id,
        "spec_name"=>$spec_name
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