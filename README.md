#longphp

A simple php framework

作者微博：[http://weibo.com/206123787](http://weibo.com/206123787 "作者微博"){:target="_blank"}

作者邮箱：<yuwenlong@wenlong.pw>

框架应用说明：[http://www.wenlong.pw/category/kuangjia](http://www.wenlong.pw/category/kuangjia "框架应用说明"){:target="_blank"}

测试地址：
>普通：http://localhost/longphp

>smarty: http://localhost/longphp/?c=smarty

```php
Apache伪静态
RewriteCond %{QUERY_STRING} ^(.*)$
RewriteRule (?!source)(.*)/([\w]+)\.html$ index.php?f=$1&c=$2&%1
RewriteCond %{QUERY_STRING} ^(.*)$
RewriteRule ([\w]+)\.html$ index.php?c=$1&%1

Nginx伪静态
rewrite ^/([\w]+).html$ /index.php?c=$1 last;
rewrite ^/(?!source)(.*)/([\w]+).html$ /index.php?f=$1&c=$2 last;

二级目录 xxxx
Apache伪静态
RewriteCond %{QUERY_STRING} ^(.*)$
RewriteRule xxxx/(?!source)(.*)/([\w]+)\.html$ xxxx/index.php?f=$1&c=$2&%1
RewriteCond %{QUERY_STRING} ^(.*)$
RewriteRule xxxx/([\w]+)\.html$ xxxx/index.php?c=$1&%1

Nginx伪静态
rewrite ^/xxxx/([\w]+).html$ /xxxx/index.php?c=$1 last;
rewrite ^/xxxx/(?!source)(.*)/([\w]+).html$ /xxxx/index.php?f=$1&c=$2 last;
```
