<?php
require_once('conn.php');
require_once('base.php');
$raw = file_get_contents('php://input');//获取非表单数据
$requestData = json_decode($raw,TRUE); 
 

$id = @$requestData['id'] ? $requestData['id'] : ""; 
 
if (empty($id)){
    Response::failure("1","商品ID不能为空");
}

$sqla = "SELECT p.id,p.title,p.price,p.stock,p.status,p.info,p.imgIds,p.create_time,p.update_time,p.sub_title,p.purpose,p.features,p.packing,u.unit_id,u.unit_name,s.sort_name,s.sort_id,sp.spec_name,sp.spec_id,b.brand_name,b.brand_id from product p LEFT JOIN unit u on u.unit_id = p.unit_id LEFT JOIN brand b on b.brand_id = p.brand_id LEFT JOIN sort s on s.sort_id = p.sort_id LEFT JOIN spec sp on sp.spec_id = p.spec_id  where p.id = '$id'"; 
$result = mysql_query($sqla,$conn); 
$objectData ; 
$b_id ;
while ($row = mysql_fetch_array($result)){
    $id = @$row["id"] ? $row["id"] : ""; 
    $title = @$row["title"] ? $row["title"] : ""; 
    $price = @$row["price"] ? $row["price"] : ""; 
    $stock = @$row["stock"] ? $row["stock"] : ""; 
    $info = @$row["info"] ? $row["info"] : ""; 
    $imgIds = @$row["imgIds"] ? $row["imgIds"] : ""; 
    $status = @$row["status"] ? $row["status"] : ""; 
    $sub_title =  @$row["sub_title"] ? $row["sub_title"] : ""; 
    $purpose =  @$row["purpose"] ? $row["purpose"] : ""; 
    $features =  @$row["features"] ? $row["features"] : ""; 
    $packing =  @$row["packing"] ? $row["packing"] : ""; 
    $unit_id =  @$row["unit_id"] ? $row["unit_id"] : ""; 
    $unit_name =  @$row["unit_name"] ? $row["unit_name"] : ""; 
    $sort_name =  @$row["sort_name"] ? $row["sort_name"] : ""; 
    $sort_id =  @$row["sort_id"] ? $row["sort_id"] : ""; 
    $spec_name =  @$row["spec_name"] ? $row["spec_name"] : ""; 
    $spec_id =  @$row["spec_id"] ? $row["spec_id"] : ""; 
    $brand_name =  @$row["brand_name"] ? $row["brand_name"] : ""; 
    $brand_id =  @$row["brand_id"] ? $row["brand_id"] : ""; 
    $b_id = $brand_id;
    $imgArray = explode(",",$imgIds);
    $imgIds = ""; 
    foreach($imgArray as $value){
        if (!empty($imgIds)){
            $imgIds = $imgIds.","; 
        }
        $imgIds = $imgIds.$domain_name."/".$upload_img_directory.$value;
    }
    $objectData = array(
        "id"=>$id,
        "title"=>$title, 
        "price"=>$price,
        "stock"=>$stock,
        "info"=>$info,
        "status"=>$status,
        "imgs"=>$imgIds,
        "sub_title"=>$sub_title,
        "purpose"=>$purpose,
        "features"=>$features,
        "packing"=>$packing,
        "unit_id"=>$unit_id,
        "unit_name"=>$unit_name,
        "sort_name"=>$sort_name,
        "sort_id"=>$sort_id,
        "spec_name"=>$spec_name,
        "spec_id"=>$spec_id,
        "brand_name"=>$brand_name,
        "brand_id"=>$brand_id,
        "img_prefix"=>$domain_name."/".$upload_img_directory
    ); 
}

 
  
if ($result){
    Response::json("0","获取数据成功",$objectData); 
}else{
    Response::failure("101","获取数据失败"); 
}

?>
