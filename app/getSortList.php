<?php

require_once('conn.php');
 
$raw = file_get_contents('php://input');//获取非表单数据
$requestData = json_decode($raw,TRUE); 
$status = 1;
$sqla = "select * from sort WHERE status = '$status'"; 
$result = mysql_query($sqla,$conn); 
$array = array(); 
while ($row = mysql_fetch_array($result)){
    $sort_id = @$row["sort_id"] ? $row["sort_id"] : ""; 
    $sort_name = @$row["sort_name"] ? $row["sort_name"] : ""; 
    $logo = @$row["logo"] ? $row["logo"] : ""; 
    $obj = array(
        "sort_id"=>$sort_id,
        "sort_name"=>$sort_name,
        "logo"=>$logo
    ); 
    array_push($array,$obj);
}
  
if ($result){
    Response::json("0","获取数据成功",array(
        "list"=>$array
    ) ); 
} else {
    Response::failure("101","获取数据失败 ");
}
?>