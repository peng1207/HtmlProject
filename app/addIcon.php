<?php 

require_once('conn.php');
 
$raw = file_get_contents('php://input');//获取非表单数据

$requestData = json_decode($raw,TRUE); 
$user_id = @$requestData['user_id'] ? $requestData['user_id'] : ''; 
$id = @$requestData['id'] ? $requestData['id'] : '';
$list = $requestData['list'];
$insert = false; 
if (empty($id)){
    $id = md5(uniqid());
    $insert = true;
}
if (empty($list)){
    Response::failure("1","list参数不能为空");
}
 

$time_str = time();
if ($insert){
    $sqla = "insert into appModel(id,name,type,create_time,update_time,create_user_id,update_user_id) values('$id','icon','icon','$time_str','$time_str','$user_id','$user_id')";
    $sqlaDet = "insert into appModelDet(id,name,img,model_id,type,type_value,create_time,update_time,create_user_id,update_user_id) values";
    $isAdd = false;
    foreach($list as $listdic){
        $detID =md5(uniqid());
        $name = $listdic['name'];
        $type_value = $listdic['type_value'];
        $img = $listdic['img'];
        
        if ($isAdd){
            $sqlaDet = $sqlaDet.','; 
        }
        $sqlaDet = $sqlaDet."('$detID','$name','$img','$id','sort','$type_value','$time_str','$time_str','$user_id','$user_id')";
       
        $isAdd = true;
    }

    $result = mysql_query($sqla,$conn);
    if ($result){
        $detResult = mysql_query($sqlaDet,$conn);
        if ($detResult){
            Response::json("0","添加成功",null); 
        }else{
            mysql_query("delete from appModel where id = '$id'"); 
            Response::failure("101","添加失败");
        }
    }else{
        Response::failure("101","添加失败");
    }
   

}else{
    $sqla = "update appModel set update_user_id = '$user_id',update_time = '$time_str' where id = '$id'";
    $sqlaDet = "update appModelDet set ";
    $nameSql = "";
    $imgSql = ""; 
    $type_valueSql = "";
    $idSql = ""; 
    foreach($list as $listdic){
        $detID = $listdic['id'];
        $name = $listdic['name'];
        $type_value = $listdic['type_value'];
        $img = $listdic['img'];
        $nameSql = $nameSql."when '$detID' then '$name'";
        $type_valueSql = $type_valueSql."when '$detID' then '$type_value'";
        $imgSql = $imgSql."when '$detID' then '$img'";
        if (empty($idSql) == false){
            $idSql = $idSql.",";
        }
        $idSql = $idSql."'$detID'";
    }
    if (empty($nameSql) == false) {
        $nameSql = $nameSql."end,";  
        $sqlaDet = $sqlaDet."name = case id ".$nameSql;
    }
    if (empty($imgSql) == false) {
        $imgSql = $imgSql."end,";
        $sqlaDet = $sqlaDet."img = case id ".$imgSql;
    }
    if (empty($type_valueSql) == false){
        $type_valueSql = $type_valueSql."end,";
        $sqlaDet = $sqlaDet."type_value = case id ".$type_valueSql;
    }
    $sqlaDet = $sqlaDet."update_user_id = '$user_id',update_time = '$time_str' where id in ($idSql)";
    $result = mysql_query($sqla,$conn);
    if ($result){
        $detResult = mysql_query($sqlaDet,$conn);
        if ($detResult){
            Response::json("0","更新成功",null); 
        }else{
            Response::failure("101","更新失败1".$sqlaDet);
        }
    }else{
        Response::failure("101","更新失败2");
    }

}







?>