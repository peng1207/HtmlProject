<?php
require_once('base.php');
require_once('conn.php');
$path = '../'.$upload_img_directory;
$result = scanFile($path);
// echo "------目录下的所有文件-----";
// print_r($result);

$productSql = "select imgIds from product";
$advertSql = "select img from advert";
$companySql = "select logo from company";
$sortSql = "select logo from sort"; 
$brandSql = "select logo from brand";
$productResult = mysql_query($productSql,$conn); 
$advertResult = mysql_query($advertSql,$conn); 
$companyResult = mysql_query($companySql,$conn);
$sortResutlt = mysql_query($sortSql,$conn); 
$brandResult = mysql_query($brandSql,$conn);
$save_img_array = array();
 
while($row = mysql_fetch_array($productResult)){
    $imgIds = @$row["imgIds"] ? $row["imgIds"] : ""; 
    $imgID_array = explode(',',$imgIds);
    $save_img_array = array_merge($save_img_array,$imgID_array);
}

while($row = mysql_fetch_array($advertResult)){
    $img = @$row["img"] ? $row["img"] : ""; 
    array_push($save_img_array,$img);
}
while($row = mysql_fetch_array($companyResult)){
    $logo = @$row["logo"] ? $row["logo"] : ""; 
    array_push($save_img_array,$logo);
}
while($row = mysql_fetch_array($sortResutlt)){
    $logo = @$row["logo"] ? $row["logo"] : ""; 
    array_push($save_img_array,$logo);
}
while($row = mysql_fetch_array($brandResult)){
    $logo = @$row["logo"] ? $row["logo"] : ""; 
    array_push($save_img_array,$logo);
}

// echo "---------数据库中的----------";
// print_r($save_img_array);

// echo "----------合并后的---------";
// $all_img = array_merge($save_img_array,$result);
// print_r($all_img);
// echo "---------去重的---------";
// $list_array = array_unique($all_img);
// print_r($list_array);
// echo "---------得到存在于目录下但不存在于数据库中的元素组成的数组--------";
$c = array_diff($result,$save_img_array); 
// print_r($c);
foreach($c as $value){
    unlink("../".$upload_img_directory.$value); 
}
Response::json("0","删除成功",null); 
// echo "删除成功";

function scanFile($path) {
  global $result;
  $files = scandir($path);
  foreach ($files as $file) {
    if ($file != '.' && $file != '..') {
      if (is_dir($path . '/' . $file)) {
        scanFile($path . '/' . $file);
      } else {
        //   echo $file."\n";
        $result[] = basename($file);
      }
    }
  }
  return $result;
}

?>