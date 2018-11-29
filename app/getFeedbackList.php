<?php
require_once('conn.php');


$sqla = "SELECT * FROM feedback"; 
$result = mysql_query($sqla,$conn); 

if ($result && mysql_fetch_array($result)) {
    Response::json("0","获取数据成功",array(
        "list"=>$result 
    ));
}else{
    Response::failure("101","获取数据失败"); 
}
?>


