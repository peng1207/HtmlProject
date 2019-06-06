<?php
require_once('conn.php');
 
$raw = file_get_contents('php://input');//获取非表单数据
$requestData = json_decode($raw,TRUE); 
$title = @$requestData['title'] ? $requestData['title'] : ''; 
$sub_title = @$requestData['sub_title'] ? $requestData['sub_title'] :'';
$price = @$requestData['price'] ? $requestData['price'] : ''; 
$unit_id = @$requestData['unit_id'] ? $requestData['unit_id'] :''; 
$sort_id = @$requestData['sort_id'] ? $requestData['sort_id'] :''; 
$brand_id = @$requestData['brand_id'] ? $requestData['brand_id'] :''; 
$spec_id = @$requestData['spec_id'] ? $requestData['spec_id'] :''; 
$stock = @$requestData['stock'] ? $requestData['stock'] : ''; 
$info = @$requestData['info'] ? $requestData['info'] : ''; 
$features = @$requestData['features'] ? $requestData['features'] : ''; 
$purpose = @$requestData['purpose'] ? $requestData['purpose'] : ''; 
$packing = @$requestData['packing'] ? $requestData['packing'] : '';
$imgIds = @$requestData['imgIds'] ? $requestData['imgIds'] : ''; 
$id = @$requestData["id"] ? $requestData['id'] : ""; 
$user_id =  @$requestData['user_id'] ? $requestData['user_id'] : '';
if (empty($title)){
    Response::failure("1","标题不能为空"); 
}
if(empty($price)){
    Response::failure("3","商品价格不能为空"); 
}
if (empty($imgIds)){
    Response::failure("7","请上传商品图片");
}
 
$is_insert = FALSE; 
if (empty($id)){
    $id =  md5(uniqid());
    $is_insert = true; 
}
$time_str = time();
if ($is_insert){
    $sqla = "INSERT INTO product(id,title,sub_title,price,unit_id,sort_id,brand_id,spec_id,stock,info,features,purpose,packing,imgIds,create_time,update_time,user_id,update_user_id) VALUES('$id','$title','$sub_title','$price','$unit_id','$sort_id','$brand_id','$spec_id','$stock','$info','$features','$purpose','$packing','$imgIds','$time_str','$time_str','$user_id','$user_id')";
    $result = mysql_query($sqla,$conn); 
      
    if ($result){
        Response::json("0","添加商品成功",array(
            'id'=>$id
        )); 
    }else{
        Response::failure("101","添加商品失败");
    }
}else{
    $sqla = "UPDATE product set title='$title',sub_title = '$sub_title',price = '$price',unit_id = '$unit_id',sort_id = '$sort_id',brand_id = '$brand_id',spec_id = '$spec_id',stock = '$stock',info = '$info',features = '$features',purpose = '$purpose',packing = '$packing', imgIds = '$imgIds',update_time='$time_str',update_user_id='$user_id' WHERE id = '$id'"; 
    $result = mysql_query($sqla,$conn); 
      
    if ($result){
        Response::json("0","更新商品成功",null); 
    }else{
        Response::failure("101","更新商品失败");
    }
}


?>