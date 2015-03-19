longphp
=======

A simple php framework <br />
作者微博：<a href="http://weibo.com/206123787" target="_blank">http://weibo.com/206123787</a><br />
作者邮箱：<a href="mailto:yuwenlong@wenlong.pw">yuwenlong@wenlong.pw</a><br />
测试地址：<br />
普通：http://localhost/longphp <br />
smarty: http://localhost/longphp/?c=smarty <br />
<br />
<h3>Apache伪静态</h3>
RewriteCond %{QUERY_STRING} ^(.*)$<br />
RewriteRule (?!source)(.*)/([\w]+)\.html$ index.php?f=$1&c=$2&%1<br />
RewriteCond %{QUERY_STRING} ^(.*)$<br />
RewriteRule ([\w]+)\.html$ index.php?c=$1&%1<br />
<h3>Nginx伪静态</h3>
rewrite ^/([\w]+).html$ /index.php?c=$1 last;<br />
rewrite ^/(?!source)(.*)/([\w]+).html$ /index.php?f=$1&c=$2 last;<br />