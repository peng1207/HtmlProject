//判断字符是否为空的方法
function isEmpty(obj) {
    if (typeof obj == "undefined" || obj == null || obj == "") {
        return true;
    } else {
        return false;
    }
}
/// 判断字符串有没值 没有默认为空
function changeText(obj) {
    if (isEmpty(obj)) {
        return "";
    } else {
        return obj;
    }

}
/// 清除div下的元素
function cleanDiv(id) {
    var div = document.getElementById(id);
    div.innerHTML = "";
}
function back() {
    javascript: history.back();
}
function sp_reload() {
    location.reload();
}
function sp_contact() {
    window.location.href = 'addFeedback.html';
}
/**
 * 禁止后退
 */
function sp_no_back_off() {
    // 禁止后退按钮失效
    if (window.history && window.history.pushState) {
        $(window).on('popstate', function () {
            window.history.pushState('forward', null, '#');
            window.history.forward(1);
        });
    }
    window.history.pushState('forward', null, '#'); //在IE中必须得有这两行
    window.history.forward(1);
}

/*获取到Url里面的参数*/
(function ($) {
    $.getUrlParam = function (name) {
        var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
        var r = window.location.search.substr(1).match(reg);
        if (r != null) return unescape(r[2]); return null;
    }
})(jQuery);

 