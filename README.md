#longphp

######A simple php framework

<a href="http://weibo.com/206123787" target="_blank">作者微博</a>

<yuwenlong@wenlong.pw>

框架应用说明：<a href="http://www.wenlong.pw/category/kuangjia" target="_blank">框架应用说明</a>

测试地址：
> 普通：http://localhost/longphp

> smarty: http://localhost/longphp/?c=smarty

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
