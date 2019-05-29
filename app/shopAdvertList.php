<?php

require_once('conn.php');
 
$raw = file_get_contents('php://input');//获取非表单数据
$requestData = json_decode($raw,TRUE); 
$user_id =  @$requestData['user_id'] ? $requestData['user_id'] : ''; 
$sqla = "select * from advert where create_user_id = '$user_id'"; 
$result = mysql_query($sqla,$conn); 
$array = array(); 
while ($row = mysql_fetch_array($result)){
    $img = @$row["img"] ? $row["img"] : ""; 
    $advert_id = @$row["advert_id"] ? $row["advert_id"] : ""; 
    $advert_name = @$row["advert_name"] ? $row["advert_name"] : ""; 
    $status = @$row["status"] ? $row["status"] : ""; 
    $obj = array(
        "img"=>$img,
        "advert_id"=>$advert_id,
        "advert_name"=>$advert_name,
        "status"=>$status
    );
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