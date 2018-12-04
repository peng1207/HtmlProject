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
    array_push($array,array(
        'id'=>$id,
        'name'=>$name,
        'phone'=>$phone,
        'info'=>$info
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


