<?php
require_once('conn.php');
 
$raw = file_get_contents('php://input');//获取非表单数据
$requestData = json_decode($raw,TRUE); 
 
$title = @$requestData['title'] ? $requestData['title'] : ''; 
$attribute = @$requestData['attribute'] ? $requestData['attribute'] : ''; 
$price = @$requestData['price'] ? $requestData['price'] : ''; 
$stock = @$requestData['stock'] ? $requestData['stock'] : ''; 
$spec = @$requestData['spec'] ? $requestData['spec'] : ''; 
$info = @$requestData['info'] ? $requestData['info'] : ''; 
$imgIds = @$_POrequestDataST['imgIds'] ? $requestData['imgIds'] : ''; 
$id = @$requestData["id"] ? $requestData['id'] : ""; 

if (empty($title)){
    Response::failure("1","标题不能为空"); 
}
if(empty($attribute)){
    Response::failure("2","商品属性不能为空");
}
if(empty($price)){
    Response::failure("3","商品价格不能为空"); 
}
if(empty($stock)){
    Response::failure("4","商品库存不能为空"); 
}
if(empty($spec)){
    Response::failure("5","商品规格不能为空");
}
if(empty($info)){
    Response::failure("6","商品说明不能为空");
}
if (empty($imgIds)){
    Response::failure("7","请上传商品图片");
}
$is_insert = TRUE; 
if (empty($id)){
    $id =  md5(uniqid());
    $is_insert = FALSE; 
}
if ($is_insert){
    $sqla = "INSERT INTO product(id,title,attribute,price,stock,spec,info,imgIds) VALUES('$id','$title','$attribute','$price','$stock','$spec','$info','$imgIds')";
    $result = mysql_query($sqla,$conn); 
    
    if ($result){
        Response::json("0","添加商品成功",array(
            'id'=>$id
        )); 
    }else{
        Response::failure("101","添加商品失败");
    }
}else{
    $sqla = "UPDATE product set title='$title',attribute = '$attribute',price = '$price',stock = '$stock',spec = '$spec',info = '$info', imgIds = '$imgIds'  WHERE id = '$id'"; 
    $result = mysql_query($sqla,$conn); 
    if ($result){
        Response::json("0","更新商品成功",null); 
    }else{
        Response::failure("101","更新商品失败");
    }
}


?>