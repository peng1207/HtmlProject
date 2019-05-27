<?php

require_once('conn.php');
 
$raw = file_get_contents('php://input');//获取非表单数据
$requestData = json_decode($raw,TRUE); 

$sqla = "select * from sort"; 
$result = mysql_query($sqla,$conn); 
$array = array(); 
while ($row = mysql_fetch_array($result)){
    $sort_id = @$row["sort_id"] ? $row["sort_id"] : ""; 
    $sort_name = @$row["sort_name"] ? $row["sort_name"] : ""; 
    $obj = array(
        "sort_id"=>$sort_id,
        "sort_name"=>$sort_name
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