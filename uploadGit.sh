name=$1

git status
git add .
git status
if [$name != '']; then
    git commit -m $name
else
    git commit -m "提交新的数据"
fi

git status
git push -u origin master
echo "执行完成"
