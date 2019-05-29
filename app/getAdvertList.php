<?php

require_once('conn.php');
require_once('base.php');
// $raw = file_get_contents('php://input');//获取非表单数据
// $requestData = json_decode($raw,TRUE); 

$sqla = "select * from advert where status = 1"; 
$result = mysql_query($sqla,$conn); 
$array = array(); 
while ($row = mysql_fetch_array($result)){
    $obj = @$row["img"] ? $row["img"] : ""; 
    $obj = $domain_name."/".$upload_img_directory.$obj;
    array_push($array,$obj);
}
mysql_close($conn);
if ($result){
    Response::json("0","获取数据成功",array(
        "list"=>$array
    ) ); 
}else{
    Response::failure("101","获取数据失败");
}
?>