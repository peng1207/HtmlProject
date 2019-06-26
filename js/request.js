/// 域名
var domain_name = "https://huangshupeng.cn"; 
var prefix_url = "/app"; 
var K_REQUEST_SUCCESS = "0";
/**
 * 公共发送请求
 * @param {*} data  参数
 * @param {*} url  请求链接
 * @param {*} success 成功回调 
 * @param {*} failureCom 失败回调
 */
function sendRequest(data,url,successCom,failureCom){
    $.ajax(
        {
            type:"POST", 
            dataType:"json",
            data:data,
            url : url, 
            success:function(data){
                if (successCom){
                    successCom(data); 
                }
            },
            error:function(){
                if (failureCom){
                    failureCom();
                }
               
            }
        }
    );  
}

//  添加或编辑商品请求
function addProduct(data,success){
    sendRequest(data,domain_name + prefix_url + "/addProduct.php",success,null);
}

/// 获取商品列表
function getProductList(data,success){
    sendRequest(data,domain_name + prefix_url + "/getProductList.php",success,null); 
}
/// 获取商品详情
function getProductDetRequest(data,success){
    sendRequest(data,domain_name + prefix_url + "/getProductDet.php",success,null); 
}
// 添加意见反馈
function addFeecdback(data,success){
    sendRequest(data,domain_name + prefix_url + "/addFeedback.php",success,null);   
}
/// 获取反馈列表
function feedBackListRequest(data,success){
    sendRequest(data,domain_name + prefix_url + "/getFeedbackList.php",success,null);
}
/// 获取店铺的商品列表
function shopProductListRequest(data,success){
    sendRequest(data,domain_name + prefix_url + "/shopProduct.php",success,null);
}
/**
 *  获取店铺商品详情
 * @param {*} data 请求参数
 * @param {*} success 回调
 */
function getShopProductDet(data,success){
    sendRequest(data,domain_name + prefix_url + "/shopProductDet.php",success,null);
}
/**
 * 删除商品
 * @param {*} data 请求参数
 * @param {*} success 回调
 */
function delProduct(data,success){
    sendRequest(data,domain_name + prefix_url + "/delProduct.php",success,null);
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
    sendRequest(data,domain_name + prefix_url + "/login.php",success,failureCom);    
}
function changeFeedbackStatusRequest(data,success,failureCom){
    sendRequest(data,domain_name + prefix_url + "/changeFeedbackStatus.php",success,failureCom);  
}
/**
 * 添加品牌或修改品牌 
 * @param {*} data 
 * @param {*} success 
 * @param {*} failureCom 
 */
function addBrandRequest(data,success,failureCom){
    sendRequest(data,domain_name + prefix_url + "/addBrand.php",success,failureCom); 
}
/**
 *  获取品牌列表
 * @param {*} data 
 * @param {*} success 
 * @param {*} failureCom 
 */
function getBrandListRequest(data,success,failureCom){
    sendRequest(data,domain_name + prefix_url + "/getBrandList.php",success,failureCom); 
}
/**
 * 删除品牌
 * @param {*} data 
 * @param {*} success 
 * @param {*} failureCom 
 */
function deleteBrandRequest(data,success,failureCom){
    sendRequest(data,domain_name + prefix_url + "/deleteBrand.php",success,failureCom); 
}
/**
 * 添加分类或修改分类
 * @param {*} data 
 * @param {*} success 
 * @param {*} failureCom 
 */
function addSortRequest(data,success,failureCom){
    sendRequest(data,domain_name + prefix_url + "/addSort.php",success,failureCom);
}
/**
 *  获取分类列表
 * @param {*} data 
 * @param {*} success 
 * @param {*} failureCom 
 */
function getSortListRequest(data,success,failureCom){
    sendRequest(data,domain_name + prefix_url + "/getSortList.php",success,failureCom);   
}
/**
 * 删除分类
 * @param {*} data 
 * @param {*} success 
 * @param {*} failureCom 
 */
function deleteSortRequest(data,success,failureCom){
    sendRequest(data, domain_name + prefix_url + "/deleteSort.php",success,failureCom);
}
/**
 * 添加规格或修改规格
 * @param {*} data 
 * @param {*} success 
 * @param {*} failureCom 
 */
function addSpecRequest(data,success,failureCom){
    sendRequest(data,domain_name + prefix_url + "/addSpec.php",success,failureCom);
}
/**
 *  获取规格列表
 * @param {*} data 
 * @param {*} success 
 * @param {*} failureCom 
 */
function getSpecListRequest(data,success,failureCom){
    sendRequest(data,domain_name + prefix_url + "/getSpecList.php",success,failureCom);   
}
/**
 * 删除规格
 * @param {*} data 
 * @param {*} success 
 * @param {*} failureCom 
 */
function deleteSpecRequest(data,success,failureCom){
    sendRequest(data, domain_name + prefix_url + "/deleteSpec.php",success,failureCom);
}
/**
 * 添加单位或修改单位
 * @param {*} data 
 * @param {*} success 
 * @param {*} failureCom 
 */
function addUnitRequest(data,success,failureCom){
    sendRequest(data,domain_name + prefix_url + "/addUnit.php",success,failureCom);
}
/**
 *  获取单位列表
 * @param {*} data 
 * @param {*} success 
 * @param {*} failureCom 
 */
function getUnitListRequest(data,success,failureCom){
    sendRequest(data,domain_name + prefix_url + "/getUnitList.php",success,failureCom);   
}
/**
 * 删除单位
 * @param {*} data 
 * @param {*} success 
 * @param {*} failureCom 
 */
function deleteUnitRequest(data,success,failureCom){
    sendRequest(data, domain_name + prefix_url + "/deleteUnit.php",success,failureCom);
}
/**
 * 更改商品是否推荐
 * @param {*} data 
 * @param {*} success 
 * @param {*} failureCom 
 */
function productRecommendRequest(data,success,failureCom){
    sendRequest(data, domain_name + prefix_url + "/productRecommend.php",success,failureCom);
}
/**
 * 添加广告
 * @param {*} data 
 * @param {*} success 
 * @param {*} failureCom 
 */
function addAdvertRequest(data,success,failureCom){
    sendRequest(data, domain_name + prefix_url + "/addAdvert.php",success,failureCom);
}
/**
 *  获取广告列表
 * @param {*} data 
 * @param {*} success 
 * @param {*} failureCom 
 */
function getAdvertListRequest(data,success,failureCom){
    sendRequest(data, domain_name + prefix_url + "/shopAdvertList.php",success,failureCom);
}
/**
 * 删除广告
 * @param {*} data 
 * @param {*} success 
 * @param {*} failureCom 
 */
function deleteAdvertRequest(data,success,failureCom){
    sendRequest(data, domain_name + prefix_url + "/deleteAdvert.php",success,failureCom);
}
/**
 * 更新广告状态
 * @param {*} data 
 * @param {*} success 
 * @param {*} failureCom 
 */
function updateAdvertStatusRequest(data,success,failureCom){
    sendRequest(data, domain_name + prefix_url + "/advertStatus.php",success,failureCom);
}
/**
 * 获取公司信息
 * @param {*} data 
 * @param {*} success 
 * @param {*} failureCom 
 */
function getCompanyInfoRequest(data,success,failureCom){
    sendRequest(data, domain_name + prefix_url + "/shopCompanyInfo.php",success,failureCom);
}
/**
 * 更新公司信息
 * @param {*} data 
 * @param {*} success 
 * @param {*} failureCom 
 */
function updateCompanyInfoRequest(data,success,failureCom){
    sendRequest(data, domain_name + prefix_url + "/updateCompanyInfo.php",success,failureCom);
}
/**
 * 编辑密码
 * @param {*} data 
 * @param {*} success 
 * @param {*} failureCom 
 */
function editPwdRequest(data,success,failureCom){
    sendRequest(data, domain_name + prefix_url + "/editPwd.php",success,failureCom);
}
/**
 * 添加icon请求
 * @param {*} data 
 * @param {*} success 
 * @param {*} failureCom 
 */
function addIconRequest(data,success,failureCom){
    sendRequest(data, domain_name + prefix_url + "/addIcon.php",success,failureCom);
}
/**
 * 获取icon的数据
 * @param {*} data 
 * @param {*} success 
 * @param {*} failureCom 
 */
function getIconRequest(data,success,failureCom){
    sendRequest(data, domain_name + prefix_url + "/shopIconList.php",success,failureCom);
}
