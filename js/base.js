//判断字符是否为空的方法
function isEmpty(obj){
    if(typeof obj == "undefined" || obj == null || obj == ""){
        return true;
    }else{
        return false;
    }
}
/// 清除div下的元素
function cleanDiv(id){
    var div = document.getElementById(id);  
     div.innerHTML = "";
}
/*获取到Url里面的参数*/
(function ($) {
    $.getUrlParam = function (name) {
     var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
     var r = window.location.search.substr(1).match(reg);
     if (r != null) return unescape(r[2]); return null;
    }
   })(jQuery);
  
