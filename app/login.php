<?php
require_once('conn.php');



$accound = @$_POST['accound'] ? $_POST['accound'] : ''; 
$pwd = @$_POST['pwd'] ? $_POST['pwd'] : ''; 
if (empty($accound)){

}

if (empty($pwd)){

}

//  /* 
//   *选择数据表 
//   * */
//   $sqla = "SELECT * from user"; 
//   $result = mysql_query($sqla,$conn); 
//   $dataarr = array(); 
//   while($row = mysql_fetch_array($result)){ 
//    $dataarr[]=$row; 
//   } 
//   $id=$_GET['id']; 
//   if($id==1){ 
//    Response::json(1,'数据返回成功',$dataarr); 
//   }else if($id==2){ 
//    Message::json(0,'失败'); 
//   } 
?>