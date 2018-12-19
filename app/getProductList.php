<?php
require_once('conn.php');
require_once('base.php');
$sqla = "SELECT * from product"; 
$result = mysql_query($sqla,$conn); 
$array = array(); 
while ($row = mysql_fetch_array($result)){
    $id = @$row["id"] ? $row["id"] : ""; 
    $title = @$row["title"] ? $row["title"] : ""; 
    $attribute = @$row["attribute"] ? $row["attribute"] : ""; 
    $price = @$row["price"] ? $row["price"] : ""; 
    $stock = @$row["stock"] ? $row["stock"] : ""; 
    $spec = @$row["spec"] ? $row["spec"] : ""; 
    $info = @$row["info"] ? $row["info"] : ""; 
    $imgIds = @$row["imgIds"] ? $row["imgIds"] : ""; 
    $status = @$row["status"] ? $row["status"] : ""; 
    $price_unit = @$row['price_unit'] ? $row['price_unit'] : "";
    $brand = @$row['brand'] ? $row['brand'] : "";
    $unit = @$row['unit'] ? $row['unit'] : "";
    $imgID_array = explode(',',$imgIds);
    $imgId = ""; 
    if (count($imgID_array)){
        $imgId = $imgID_array[0]; 
    }
    // if (!empty($imgId)){
    //     $imgId = $domain_name."/img/".$imgId;
    // }

    $objectData = array(
        "id"=>$id,
        "title"=>$title, 
        "attribute"=>$attribute,
        "price"=>$price,
        "stock"=>$stock,
        "spec"=>$spec,
        "info"=>$info,
        "status"=>$status,
        "img"=>$imgId,
        "price_unit"=>$price_unit,
        "brand"=>$brand,
        "unit"=>$unit,
        "img_prefix"=>$domain_name."/img/"
    ); 
    array_push($array,$objectData);
}

if ($result){
    Response::json("0","获取数据成功",array(
        "list"=>$array
    ) ); 
} else {
    Response::failure("101","获取数据失败 ");
}




?>
