<?php
require_once('conn.php');
require_once('base.php');
$raw = file_get_contents('php://input');//获取非表单数据
$requestData = json_decode($raw,TRUE); 
$status = 1;
// 每页查询的数量
$pageSize = @$requestData['pageSize'] ? $requestData['pageSize'] : 10;
// 当前页
$c_page = @$requestData['c_page'] ? $requestData['c_page'] : 1;
$array = array(); 
if ($c_page != 1){
    Response::json("0","获取数据成功",array(
        "list"=>$array,
    ) ); 
}
$sqla = "SELECT SQL_CALC_FOUND_ROWS p.id,p.title,p.price,p.stock,p.status,p.info,p.imgIds,p.create_time,p.update_time,p.sub_title,p.purpose,p.features,p.packing,u.unit_id,u.unit_name,s.sort_name,s.sort_id,sp.spec_name,sp.spec_id,b.brand_name,b.brand_id from product p LEFT JOIN unit u on u.unit_id = p.unit_id LEFT JOIN brand b on b.brand_id = p.brand_id LEFT JOIN sort s on s.sort_id = p.sort_id LEFT JOIN spec sp on sp.spec_id = p.spec_id where p.status = '$status'"; 
$keyword = @$requestData['keyword'] ? $requestData['keyword'] : ""; 
$select_sort_id = @$requestData['sort_id'] ? $requestData['sort_id'] : ""; 
$select_brand_id =  @$requestData['brand_id'] ? $requestData['brand_id'] : "";
$order_by =  @$requestData['order_by'] ? $requestData['order_by'] : "";
if (!empty($select_sort_id)){
    $sqla .= "and s.sort_id = '$select_sort_id'";
}
if (!empty($select_brand_id)){
    $sqla .= "and b.brand_id = '$select_brand_id'";
}
if (!empty($keyword)){
    $sqla .= "and (p.title like '%$keyword%' or b.brand_name like '%$keyword%')";
}
if (!empty($order_by)){
    // 降序
    if ($order_by == "price_desc"){
        $sqla .= "order by p.price DESC";
    }else if ($order_by == "price_asc"){ // 升序
        $sqla .= "order by p.price ASC";
    }
}
 
$result = mysql_query($sqla,$conn); 
$countResult = mysql_query("select found_rows()",$conn);

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
    $imgID_array = explode(',',$imgIds);
    $imgId = ""; 
    if (count($imgID_array)){
        $imgId = $imgID_array[0]; 
    }
    if (!empty($imgId)){
        $imgId = $domain_name."/".$upload_img_directory.$imgId;
    }
    $objectData = array(
        "id"=>$id,
        "title"=>$title, 
        "price"=>$price,
        "stock"=>$stock,
        "info"=>$info,
        "status"=>$status,
        "img"=>$imgId,
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
    array_push($array,$objectData);
}
$totalCount = 0;
while ($row = mysql_fetch_array($countResult)){
    $totalCount = (int)$row["found_rows()"];
}

  
if ($result){
    Response::json("0","获取数据成功",array(
        "list"=>$array,
        "totalCount"=>$totalCount
    ) ); 
} else {
    Response::failure("101","获取数据失败");
}
?>
