<?php
require_once('conn.php');
require_once('base.php');
$raw = file_get_contents('php://input');//获取非表单数据
$requestData = json_decode($raw,TRUE); 
$id = @$requestData['id'] ? $requestData['id'] : ''; 
$user_id =  @$requestData['user_id'] ? $requestData['user_id'] : '';
if (empty($id)){
    Response::failure("1","ID不能为空"); 
}
$sqla = "SELECT * from product where id = '$id' and user_id = '$user_id'"; 
$result = mysql_query($sqla,$conn); 
$imgIds = ""; 
while ($row = mysql_fetch_array($result)){
    $imgIds = @$row["imgIds"] ? $row["imgIds"] : ""; 
}

$sqla1 = "DELETE FROM product where id='$id'";
$result1 = mysql_query($sqla1,$conn);
  
if ($result1){
    $imgArray = explode(",",$imgIds);
    foreach($imgArray as $value){
        unlink("../".$upload_img_directory.$value); 
    }
    Response::json("0","删除商品成功",null);  
}else{
    Response::failure("101","删除商品失败");
}

?>
