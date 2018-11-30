<?php 
require_once('response.php');
require_once('base.php');
 
$index = 0; 
echo "获取上传的图片";
echo $_FILES;
$dir_base = "../img/";
foreach($_FILES as $file){
    echo "开始上传图片";
    $upload_file_name = 'upload_file' . $index;        //对应index.html FomData中的文件命名
    $filename = $_FILES[$upload_file_name]['name']; 
    echo $filename;
    $gb_filename = iconv('utf-8','gb2312',md5(uniqid()).".jpg");    //名字转换成gb2312处理
    echo "保存的文件:".$gb_filename;
    echo "临时文件：".$_FILES[$upload_file_name]['tmp_name'];
    
   
    $rEFileTypes = "/^\.(jpg|jpeg|gif|png){1}$/i"; 
    $isMoved = @move_uploaded_file ( $_FILES[$upload_file_name]['tmp_name'], $dir_base.$gb_filename);        //上传文件
    echo "----";
    echo  $dir_base.$gb_filename;
    echo "------"; 
    if ($isMove){
        echo "上传成功";
    }else{
        echo "上传失败";
    }
    $index++;
}
?>

