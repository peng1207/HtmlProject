<?php

require_once('conn.php');
require_once('base.php');

$raw = file_get_contents('php://input');//获取非表单数据
$requestData = json_decode($raw,TRUE); 
$user_id =  @$requestData['user_id'] ? $requestData['user_id'] : '';

if (empty($user_id)){
    Response::failure("1","无效用户"); 
}

$sqla = "select * from company";
$result = mysql_query($sqla,$conn);
 
$objectData;
while ($row = mysql_fetch_array($result)){
    $company_name = @$row["company_name"] ? $row["company_name"] : ""; 
    $phone = @$row["phone"] ? $row["phone"] : ""; 
    $address = @$row["address"] ? $row["address"] : ""; 
    $logo = @$row["logo"] ? $row["logo"] : ""; 
    $info = @$row["info"] ? $row["info"] : ""; 
    $company_id = @$row["company_id"] ? $row["company_id"] : ""; 


    $objectData = array(
        "company_name"=>$company_name,
        "phone"=>$phone,
        "address"=>$address,
        "logo"=>$logo,
        "info"=>$info,
        "company_id"=>$company_id,
        "img_prefix"=>$domain_name."/".$upload_img_directory
    );
}
if ($result){
    Response::json("0","获取数据成功",$objectData); 
}else{
    Response::failure("101","获取数据失败"); 
}


?>