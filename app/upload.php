<?php 
require_once('response.php');
require_once('base.php');
 
$index = 0; 
$success_index = 0;
$remove_path = ""; 
$img_paths; 
foreach($_FILES as $file){
   
    $upload_file_name = 'upload_file'.$index;        //对应index.html FomData中的文件命名
 
    if ($_FILES[$upload_file_name]["error"] > 0)
    {
		echo "Return Code: " . $_FILES[$upload_file_name]["error"] . "<br />";
    }
    $filename = $_FILES[$upload_file_name]['name']; 
   
    $gb_filename = iconv('utf-8','gb2312',md5(uniqid()).".jpg");    //名字转换成gb2312处理
   
   
    $rEFileTypes = "/^\.(jpg|jpeg|gif|png){1}$/i"; 
    $move_path =  '../img/'.$gb_filename; 
  
    
    if (move_uploaded_file ( $_FILES[$upload_file_name]['tmp_name'], $move_path )){
        if (!empty($img_paths)){
            $img_paths = $img_paths.","; 
            $remove_path = $remove_path.","; 
        }
        $img_paths = $img_paths.$domain_name."/img/".$gb_filename;
        $remove_path = $remove_path."../img/".$gb_filename; 
        $success_index++; 
    }else{
        
    }
    $index++;
}

if ($index == $success_index){
    Response::json("0","上传成功",array(
        "imgs"=>$img_paths
    ));
}else{
    $imgArray = explode(",",$remove_path);
     
    foreach($imgArray as $value){
        unlink($value); 
    }
    Response::failure("101","上传失败"); 
}


?>

