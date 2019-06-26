<?php

require_once('conn.php');
require_once('base.php');
$raw = file_get_contents('php://input');//获取非表单数据
$requestData = json_decode($raw,TRUE); 

$user_id = @$requestData['user_id'] ? $requestData['user_id'] : ''; 

$sqla = "select * from appModel where type = 'icon'";
$resutl = mysql_query($sqla,$conn);
$id ; 
while($row = mysql_fetch_array($resutl)){
    $id = @$row["id"] ? $row["id"] : ""; 
}
if (empty($id)){
    Response::failure("101","没有获取到数据");
}

$sqla = "select * from appModelDet where model_id = '$id'"; 
$resutl1 = mysql_query($sqla,$conn); 
$array = array(); 

while($row = mysql_fetch_array($resutl1)){
    $detID = @$row["id"] ? $row["id"] : "";
    $name = @$row["name"] ? $row["name"] : ""; 
    $img = @$row["img"] ? $row["img"] : "";
    $type = @$row["type"] ? $row["type"] : ""; 
    $type_value = @$row["type_value"] ? $row["type_value"] : "";  
    if (empty($img) == false){
        $img = $domain_name."/".$upload_img_directory.$img;
    }
    $obj = array(
        "id"=>$detID,
        "name"=>$name,
        "img"=>$img,
        "type"=>$type,
        "type_value"=>$type_value
        // "img_prefix"=>$domain_name."/".$upload_img_directory
    );
    array_push($array,$obj);
}
  
if ($resutl1){
    Response::json("0","获取数据成功",array(
        "list"=>$array,
    ) ); 
} else {
    Response::failure("102","获取数据失败".$sqla);
}


?>