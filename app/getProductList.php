<?php
require_once('conn.php');

$sqla = "SELECT * from product"; 
$result = mysql_query($sqla,$conn); 
if ($result){
    if(mysql_fetch_array($result)){
        while ($row = mysql_fetch_array($result)){
            echo "asdasd";
        } 
        Response::json("0","获取数据成功qqww",$result); 
    }else{
        Response::json("0","获取数据成功"); 
    }
} else {
    Response::failure("101","获取数据失败 ");
}




?>