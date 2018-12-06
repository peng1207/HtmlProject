<?php
require_once('conn.php');
require_once('base.php');
$raw = file_get_contents('php://input');//获取非表单数据
$requestData = json_decode($raw,TRUE); 
 

$id = @$requestData['id'] ? $requestData['id'] : ""; 

if (empty($id)){
    Response::failure("1","商品ID不能为空");
}

$sqla = "SELECT * from product where id = '$id'"; 
$result = mysql_query($sqla,$conn); 
$objectData ; 
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
    $imgArray = explode(",",$imgIds);
    $imgIds = ""; 
    foreach($imgArray as $value){
        if (!empty($imgIds)){
            $imgIds = $imgIds.","; 
        }
        $imgIds = $imgIds.$domain_name."/img/".$value;
    }
    $objectData = array(
        "id"=>$id,
        "title"=>$title, 
        "attribute"=>$attribute,
        "price"=>$price,
        "stock"=>$stock,
        "spec"=>$spec,
        "info"=>$info,
        "status"=>$status,
        "imgs"=>$imgIds,
        "price_unit"=>$price_unit,
        "brand"=>$brand,
        "unit"=>$unit,
    ); 
  
}

if ($result){
    Response::json("0","获取数据成功",$objectData); 
}else{
    Response::failure("101","获取数据失败"); 
}

?> 
