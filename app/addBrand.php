<?php

require_once('conn.php');
 
$raw = file_get_contents('php://input');//获取非表单数据
$requestData = json_decode($raw,TRUE); 

$brand_name = @$requestData['brand_name'] ? $requestData['brand_name'] : ''; 
$brand_id = @$requestData['brand_id'] ? $requestData['brand_id'] : ''; 
$user_id =  @$requestData['user_id'] ? $requestData['user_id'] : '';
if (empty($brand_name)){
    Response::failure("1","请输入品牌名称");
}
$is_insert = FALSE; 
if (empty($brand_id)){
    $brand_id =  md5(uniqid());
    $is_insert = true; 
}
$time_str = time();
if ($is_insert){
    $sqla = "INSERT INTO brand (brand_id,brand_name,create_time,update_time,create_user_id,update_user_id) VALUES ('$brand_id','$brand_name','$time_str','$time_str','$user_id','$user_id')";
    $result = mysql_query($sqla,$conn); 
    mysql_close($conn);
    if ($result){
        Response::json("0","添加品牌成功",array(
            'id'=>$brand_id
        )); 
    }else{
        Response::failure("101","添加品牌失败");
    }
}else{
    $sqla = "UPDATE brand SET brand_name='$brand_name',update_time='$time_str',update_user_id='$user_id' WHERE brand_id='$brand_id'";
    $result = mysql_query($sqla,$conn); 
    mysql_close($conn);
    if ($result){
        Response::json("0","修改品牌成功",null); 
    }else{
        Response::failure("101","修改品牌失败");
    }
}


?>