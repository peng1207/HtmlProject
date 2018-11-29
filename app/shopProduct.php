<?php
require_once('conn.php');

$sqla = "SELECT * FROM product"; 
$result = mysql_query($sqla,$conn); 
if ($result){
    Response::json("0","获取数据成功",$result); 
} else {
    Response::failure("101","获取数据失败 ");
}


?> 
