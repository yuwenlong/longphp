#longphp

######A simple php framework

[作者微博](http://weibo.com/206123787 "作者微博")

<yuwenlong@wenlong.org>

测试地址：
> 普通：http://localhost/longphp

> smarty: http://localhost/longphp/smarty

> 路由：http://localhost/aaa/bbb/ddd

```
//Nginx
location / {
    try_files $uri $uri/ /index.php;
}

//如果是二级目录
location /xxxx/ {
    try_files ^/xxxx/$uri xxxx/$uri/ /xxxx/index.php;
}
```
##### 详细文档地址
[文档地址](http://www.wenlong.org/longphp "文档地址")
