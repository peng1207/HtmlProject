<?php

require_once('conn.php');
 
$raw = file_get_contents('php://input');//获取非表单数据
$requestData = json_decode($raw,TRUE); 

$spec_name = @$requestData['spec_name'] ? $requestData['spec_name'] : ''; 
$spec_id = @$requestData['spec_id'] ? $requestData['spec_id'] : ''; 
$user_id =  @$requestData['user_id'] ? $requestData['user_id'] : '';
if (empty($spec_name)){
    Response::failure("1","请输入规格名称");
}
$is_insert = FALSE; 
if (empty($spec_id)){
    $spec_id =  md5(uniqid());
    $is_insert = true; 
}
$time_str = time();
if ($is_insert){
    $sqla = "insert into spec (spec_id,spec_name,create_time,update_time,create_user_id,update_user_id) values('$spec_id','$spec_name','$time_str','$time_str','$user_id','$user_id')";
    $result = mysql_query($sqla,$conn); 
    mysql_close($conn);
    if ($result){
        Response::json("0","添加规格成功",array(
            'id'=>$spec_id
        )); 
    }else{
        Response::failure("101","添加规格失败");
    }
}else{
    $sqla = "update spec set spec_name='$spec_name',update_time='$time_str',update_user_id='$user_id' where spec_id='$spec_id'";
    $result = mysql_query($sqla,$conn); 
    mysql_close($conn);
    if ($result){
        Response::json("0","修改规格成功",null); 
    }else{
        Response::failure("101","修改规格失败");
    }
}


?>