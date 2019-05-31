<?php

require_once('conn.php');
require_once('base.php');

$sqla = "select * from company";
$result = mysql_query($sqla,$conn);
 
$objectData;
while ($row = mysql_fetch_array($result)){
    $company_name = @$row["company_name"] ? $row["company_name"] : ""; 
    $phone = @$row["phone"] ? $row["phone"] : ""; 
    $address = @$row["address"] ? $row["address"] : ""; 
    $logo = @$row["logo"] ? $row["logo"] : ""; 
    $info = @$row["info"] ? $row["info"] : ""; 
   
    if (!empty($logo)){
        $logo = $domain_name."/".$upload_img_directory.$logo;
    }

    $objectData = array(
        "company_name"=>$company_name,
        "phone"=>$phone,
        "address"=>$address,
        "logo"=>$logo,
        "info"=>$info,
    );
}
if ($result){
    Response::json("0","获取数据成功",$objectData); 
}else{
    Response::failure("101","获取数据失败"); 
}


?>