 
var storage = window.localStorage;
var K_USER_USERID_KEY = "user_id";
var K_USER_TOKEN_KEY = "token";

/**
 *  保存用户信息
 * @param {*} obj 登录成功返回的数据
 */
function saveUserData(obj){
    if (obj != null){
        console.log(obj[K_USER_USERID_KEY]);
        storage[K_USER_USERID_KEY] = obj[K_USER_USERID_KEY]; 
        storage[K_USER_TOKEN_KEY] = obj[K_USER_TOKEN_KEY];
    }else{
        clearUserData();
    }
}
/**
 *  获取用户ID
 */
function getUserId(){
    var userID = storage[K_USER_USERID_KEY]; 
    if (userID != null){
        return userID; 
    }else{
        return null; 
    }
}
/**
 *  获取用户的token
 */
function getUserToken(){
    var token = storage[K_USER_TOKEN_KEY]; 
    if (token != null){
        return token; 
    }else{
        return null; 
    }
}
/**
 * 是否有登录
 */
function isLogin(){
    var userID = getUserId()
    console.log(userID);
    if (isEmpty(userID) == false){
        return true;
    }else{
        return false; 
    }
}
/**
 * 清除用户数据
 */
function clearUserData(){
    storage[K_USER_USERID_KEY] = ""; 
    storage[K_USER_TOKEN_KEY] = ""; 
}
/**
 * 检查是否登录 没有登录根据isJump是否跳转
 * @param {*} isJump 是否跳转
 */
function sp_checkLogin(isJump){ 
    if (isLogin() == true){
        return true; 
    }else{
        if (isJump == true){
            clearUserData()
            window.location.href = "./login.html";
        }
        return false; 
    }
}