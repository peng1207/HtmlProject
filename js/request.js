/// 域名
var domain_name = "https://huangshupeng.cn"; 
var prefix_url = "/app"; 

//  添加或编辑商品请求
function addProduct(data,success){
    $.ajax(
        {
            type:"POST", 
            dataType:"json",
            data:data,
            url : domain_name + prefix_url + "/addProduct.php", 
            success:function(data){
                success(data); 
            }
        }
    ); 
}
/// 获取商品列表
function getProductList(data,success){
    $.ajax(
        {
            type:"POST", 
            dataType:"json",
            data:data,
            url : domain_name + prefix_url + "/getProductList.php", 
            success:function(data){
                success(data); 
            }
        }
    ); 
}
/// 获取商品详情
function getProductDetRequest(data,success){
    $.ajax(
        {
            type:"POST", 
            dataType:"json",
            data:data,
            url : domain_name + prefix_url + "/getProductDet.php", 
            success:function(data){
                success(data); 
            }
        }
    ); 
}
// 添加意见反馈
function addFeecdback(data,success){
    $.ajax(
        {
            type:"POST", 
            dataType:"json",
            data:data,
            url : domain_name + prefix_url + "/addFeedback.php", 
            success:function(data){
                success(data); 
            }
        }
    );    
}
/// 获取反馈列表
function feedBackListRequest(data,success){
    $.ajax(
        {
            type:"POST", 
            dataType:"json",
            data:data,
            url : domain_name + prefix_url + "/getFeedbackList.php", 
            success:function(data){
                success(data); 
            }
        }
    );  
}
/// 获取店铺的商品列表
function shopProductListRequest(data,success){
    $.ajax(
        {
            type:"POST", 
            dataType:"json",
            data:data,
            url : domain_name + prefix_url + "/shopProduct.php", 
            success:function(data){
                success(data); 
            }
        }
    );    
}
/**
 *  获取店铺商品详情
 * @param {*} data 请求参数
 * @param {*} success 回调
 */
function getShopProductDet(data,success){
    $.ajax(
        {
            type:"POST", 
            dataType:"json",
            data:data,
            url : domain_name + prefix_url + "/shopProductDet.php", 
            success:function(data){
                success(data); 
            }
        }
    );   
}
/**
 * 删除商品
 * @param {*} data 请求参数
 * @param {*} success 回调
 */
function delProduct(data,success){
    $.ajax(
        {
            type:"POST", 
            dataType:"json",
            data:data,
            url : domain_name + prefix_url + "/delProduct.php", 
            success:function(data){
                success(data); 
            }
        }
    );   
}
/**
 * 上传
 * @param {*} data 请求参数
 * @param {*} success 回调
 */
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

function loginRequest(data,success,failureCom){
    $.ajax(
        {
            type:"POST", 
            dataType:"json",
            data:data,
            url : domain_name + prefix_url + "/login.php", 
            success:function(data){
                success(data); 
            },
            error:function(){
                failureCom();
            }
        }
    );    
}
function changeFeedbackStatusRequest(data,success,failureCom){
    $.ajax(
        {
            type:"POST", 
            dataType:"json",
            data:data,
            url : domain_name + prefix_url + "/changeFeedbackStatus.php", 
            success:function(data){
                success(data); 
            },
            error:function(){
                failureCom();
            }
        }
    );    
}


