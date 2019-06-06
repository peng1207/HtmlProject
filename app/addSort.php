<?php

require_once('conn.php');
 
$raw = file_get_contents('php://input');//获取非表单数据
$requestData = json_decode($raw,TRUE); 

$sort_name = @$requestData['sort_name'] ? $requestData['sort_name'] : ''; 
$sort_id = @$requestData['sort_id'] ? $requestData['sort_id'] : ''; 
$user_id =  @$requestData['user_id'] ? $requestData['user_id'] : '';
if (empty($sort_name)){
    Response::failure("1","请输入分类名称");
}
$is_insert = FALSE; 
if (empty($sort_id)){
    $sort_id =  md5(uniqid());
    $is_insert = true; 
}
$time_str = time();
if ($is_insert){
    $sqla = "insert into sort (sort_id,sort_name,create_time,update_time,create_user_id,update_user_id) values('$sort_id','$sort_name','$time_str','$time_str','$user_id','$user_id')";
    $result = mysql_query($sqla,$conn); 
   
    if ($result){
        Response::json("0","添加分类成功",array(
            'id'=>$sort_id
        )); 
    }else{
        Response::failure("101","添加分类失败");
    }
}else{
    $sqla = "update sort set sort_name='$sort_name',update_time='$time_str',update_user_id='$user_id' where sort_id='$sort_id'";
    $result = mysql_query($sqla,$conn); 
    
    if ($result){
        Response::json("0","修改分类成功",null); 
    }else{
        Response::failure("101","修改分类失败");
    }
}


?>