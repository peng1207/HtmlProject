/// 域名
var domain_name = "http://120.77.38.114"; 
var prefix_url = "/app"; 




//  添加或编辑商品请求
function addProduct(data,success){
    
    $.ajax(
        {
            type:"POST", 
            dataType:"josn",
            data:data,
            url : domain_name + prefix_url + "/addProduct.php", 
            success:function(data){
                success(data); 
            }
        }
    ); 
}
// 添加意见反馈
function addFeecdback(){
    
}
function upload(data,success){
    console.log(data);
    $.ajax(
        {
            type:"POST", 
            data:data,
            cache: false,
            contentType: false,        /*不可缺*/
            processData: false,     
            url : domain_name + prefix_url + "/upload.php", 
            success:function(data){
                success(data); 
            },
            error:function(){
                alert('上传出错 请重新上传');
            }
        }
    ); 

}





