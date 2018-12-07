#!/usr/bin/expect
echo "开始执行脚本"

echo $PWD
root_path="";
root_path="$PWD"
echo $root_path
 
service_name="root@huangshupeng.cn:/usr/share/nginx/html"
echo "上传app目录 请输入密码"
 scp -r $root_path"/app/" $service_name
echo "上传page目录 请输入密码"
scp -r $root_path"/page/" $service_name
echo "上传js目录 请输入密码"
scp -r $root_path"/js/" $service_name
echo "上传css目录 请输入密码"
scp -r $root_path"/css/" $service_name
echo "上传img目录 请输入密码"
scp -r $root_path"/img/" $service_name
echo "执行完成"
exit
