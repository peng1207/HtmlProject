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
$imgIds = @$requestData['imgIds'] ? $requestData['imgIds'] : ''; 
$id = @$requestData["id"] ? $requestData['id'] : ""; 
$price_unit = @$requestData['price_unit'] ? $requestData['price_unit'] : ''; 
$unit = @$requestData['unit'] ? $requestData['unit'] : ''; 
$brand = @$requestData['brand'] ? $requestData['brand'] : '';
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
if (empty($price_unit)){
    Response::failure("8","请输入价格单位");
}
if (empty($unit)){
    Response::failure("9","请输入单位");
}
if (empty($brand)){
    Response::failure("10","请输入品牌");
}
$is_insert = FALSE; 
if (empty($id)){
    $id =  md5(uniqid());
    $is_insert = true; 
}
if ($is_insert){
    $sqla = "INSERT INTO product(id,title,attribute,price,stock,spec,info,imgIds,price_unit,unit,brand) VALUES('$id','$title','$attribute','$price','$stock','$spec','$info','$imgIds','$price_unit','$unit','$brand')";
    $result = mysql_query($sqla,$conn); 
    
    if ($result){
        Response::json("0","添加商品成功",array(
            'id'=>$id
        )); 
    }else{
        Response::failure("101","添加商品失败");
    }
}else{
    $sqla = "UPDATE product set title='$title',attribute = '$attribute',price = '$price',stock = '$stock',spec = '$spec',info = '$info', imgIds = '$imgIds',price_unit = '$price_unit',unit='$unit',brand='$brand'  WHERE id = '$id'"; 
    $result = mysql_query($sqla,$conn); 
    if ($result){
        Response::json("0","更新商品成功",null); 
    }else{
        Response::failure("101","更新商品失败");
    }
}


?>