<?php

require_once('conn.php');
 
$raw = file_get_contents('php://input');//获取非表单数据
$requestData = json_decode($raw,TRUE); 

$unit_name = @$requestData['unit_name'] ? $requestData['unit_name'] : ''; 
$unit_id = @$requestData['unit_id'] ? $requestData['unit_id'] : ''; 
$user_id =  @$requestData['user_id'] ? $requestData['user_id'] : '';
if (empty($unit_name)){
    Response::failure("1","请输入单位名称");
}
$is_insert = FALSE; 
if (empty($unit_id)){
    $unit_id =  md5(uniqid());
    $is_insert = true; 
}
$time_str = time();
if ($is_insert){
    $sqla = "insert into unit (unit_id,unit_name,create_time,update_time,create_user_id,update_user_id) values('$unit_id','$unit_name','$time_str','$time_str','$user_id','$user_id')";
    $result = mysql_query($sqla,$conn); 
    mysql_close($conn);
    if ($result){
        Response::json("0","添加单位成功",array(
            'id'=>$unit_id
        )); 
    }else{
        Response::failure("101","添加单位失败");
    }
}else{
    $sqla = "update unit set unit_name='$unit_name',update_time='$time_str',update_user_id='$user_id' where unit_id='$unit_id'";
    $result = mysql_query($sqla,$conn); 
    mysql_close($conn);
    if ($result){
        Response::json("0","修改单位成功",null); 
    }else{
        Response::failure("101","修改单位失败");
    }
}


?>