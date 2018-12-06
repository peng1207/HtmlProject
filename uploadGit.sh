name=$0
echo $name
git status
git add .
git status
git commit -m "提交新的数据"
git status
git push -u origin master
echo "执行完成"
