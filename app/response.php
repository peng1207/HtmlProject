<?php 
header("Access-Control-Allow-Origin: *");
header("charset=utf-8"); 
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-cache");
header("Pragma: no-cache");
header('content-type:text/html charset:utf-8');
class Response{
    public static function json($code,$message="",$data=null){
        if ($data == null){
            $data = (object)array(); 
        }
        $result=array(
         'code'=>$code,
         'message'=>$message,
         'data'=>$data
        ); 
        echo json_encode($result); 
        exit; 
    }
    public static function failure($code,$message=""){
        $result=array(
            'code'=>$code, 
            'message'=>$message,
            'data'=>(object)array()
        );
        echo json_encode($result); 
        exit;  
    }


    
}

?>
