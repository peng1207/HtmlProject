<?php
require_once('conn.php');


$sqla = "SELECT * FROM feedback"; 
$result = mysql_query($sqla,$conn); 
$array = array();
while($row = mysql_fetch_array($result)){
    $id = @$row['id'] ? $row['id'] : ''; 
    $name = @$row['name'] ? $row['name'] : ''; 
    $phone = @$row['phone'] ? $row['phone']: ''; 
    $info = @$row['info'] ? $row['info'] : '';
    $create_time =  @$row['create_time'] ? $row['create_time'] : '';
    $update_time =  @$row['update_time'] ? $row['update_time'] : '';
    $status =  @$row['status'] ? $row['status'] : 0;
    array_push($array,array(
        'id'=>$id,
        'name'=>$name,
        'phone'=>$phone,
        'info'=>$info,
        "createTime"=>$create_time,
        "updateTime"=>$update_time, 
        "status"=>$status
    )); 
}
  
if ($result  ) {
    Response::json("0","获取数据成功",array(
        "list"=>$array 
    ));
}else{
    Response::failure("101","获取数据失败"); 
}
?>


