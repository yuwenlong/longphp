
<!DOCTYPE html>
<!-- saved from url=(0023)http://www.longphp.com/ -->
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        
        <meta http-equiv="X-UA-Compatible" content="chrome=1">
        <title>longphp 相关文档</title>
        <meta name="keywords" content="php,于文龙,文龙,longphp,Longphp,php框架,框架,php轻框架">
        <meta name="description" content="为了生活可以忍，侮辱技术就不行">
		<link rel="stylesheet" href="./static/bootstrap.min.css">
        <script type="text/javascript" src="./static/jquery.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <style type="text/css">
            footer{width: auto;}
            .red{color: red;}
            .nav>li>a{padding: 5px;}
            .x{display: none !important;}
        </style>
		<script type="text/javascript">
			var _hmt = _hmt || [];
			(function() {
			  var hm = document.createElement("script");
			  hm.src = "https://hm.baidu.com/hm.js?f9b26e0dbeb427962c311c8065b150df";
			  var s = document.getElementsByTagName("script")[0]; 
			  s.parentNode.insertBefore(hm, s);
			})();

			$(function(){
				var version = "1.2.2";
				$('#version').html(version);

				var download_url = new Object();
				download_url.github = 'https://github.com/yuwenlong/longphp/releases/tag/';
				download_url.oschina = 'https://git.oschina.net/longphp/longphp/tree/';
				download_url.csdn = 'https://code.csdn.net/ywl890227/longphp/tree/';
				download_url.coding = 'https://coding.net/u/yuwenlong/p/longphp/git/tree/';

				var download_html = '';
				$.each(download_url, function(k, v){
					download_html += '<p><a href="' + v + 'v' + version + '" target="_blank">' + k  + '</a></p>';
				});

				$('#Download').after(download_html);
			});
		</script>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    </head>
    <body youdao="bind">
        <div class="container bs-docs-container">
            <div class="row">
                <div class="col-md-9">
                    <h2 id="Info">框架简介</h2>
                    <h3>作者：<a href="http://www.wenlong.org/">于文龙</a></h3>
                    <h4>框架名称：Longphp</h4>
                    <h5>当前框架最新版本：<span class="red" id="version"></span></h5>
                    <p>一个轻框架，配置简单，不臃肿。本软件使用GPL开源协议</p>
                    
                    <h2 id="Download">框架下载地址</h2>
                    
                    <h2 id="Directory">目录说明</h2>
                    <p>┌ class      （类文件目录）</p>
                    <p>├ conf       （配置文件目录）</p>
                    <p>├ controller （控制器目录）</p>
                    <p>├ fun        （函数文件目录）</p>
                    <p>├ lib        （基类目录）</p>
                    <p>├ model      （模型文件目录）</p>
                    <p>├ tpl        （模板目录 smarty模板引擎）</p>
                    <p>├ www        （网站根目录）</p>
                    <p>├ LICENSE    （GPL开源协议）</p>
                    <p>├ README.md  （框架基础描述文件）</p>
                    <p>└ session.sql（内置session数据库）</p>
                    
                    <h2 id="Nginx">Nginx配置</h2>
                    <p>放在根目录下</p>
                    <pre>location / {
    try_files $uri $uri/ /index.php;
}</pre>
                    <p>二级根目录xxxx下</p>
                    <pre>location /xxxx/ {
    try_files ^/xxxx/$uri xxxx/$uri/ /xxxx/index.php;
}</pre>
                    
                    <h2 id="Routing">路由说明</h2>
                    <p class="red">http://localhost/[目录名]/[控制器]/[方法名]</p>
                    <p>例如：http://localhost/test</p>
                    <p>访问的 <span class="red">app/Test.controller.php</span> 控制器，<span class="red">index</span> 方法</p>
                    <p>例如：http://localhost/test/aaa</p>
                    <p>访问的 <span class="red">app/test/Aaa.controller.php</span> 控制器，<span class="red">index</span> 方法</p>
                    <p>例如：http://localhost/test/aaa/bbb</p>
                    <p>访问的 <span class="red">app/test/Aaa.controller.php</span> 控制器，<span class="red">bbb</span> 方法</p>
                    
                    <h2 id="Conf">配置文件说明</h2>
                    <p id="config.conf.php">config.conf.php</p>
                    <p>配置框架基础相关，如cookie 返回数组，在控制器里使用 <span class="red">$this-&gt;config</span> 调用，配置文件代码如下：</p>
                    <pre>&lt;?php
if(!defined('DIR')){
    exit('Please correct access URL.');
}

return array(
    //设置cookie信息
    'cookie_domain' =&gt; '.wenlong.org',
    'cookie_path' =&gt; '/',
);
</pre>
                    
                    <p id="db.conf.php">db.conf.php</p>
                    <p>支持分库 读写分离设置, 在控制器调用 <span class="red">$this-&gt;db = 'db1, db2'</span>，配置文件代码如下：</p>
                    <pre>&lt;?php
if(!defined('DIR')){
    exit('Please correct access URL.');
}

return array(
    'db1' =&gt; array(
        'host' =&gt; '127.0.0.1',
        'port' =&gt; '3306',
        'name' =&gt; 'root',
        'pass' =&gt; '1111',
        'database' =&gt; 'test',
        'prefix' =&gt; '',
        'charset' =&gt; 'utf8mb4'
    ),
    'db2' =&gt; array(
        'host' =&gt; '127.0.0.1',
        'port' =&gt; '3306',
        'name' =&gt; 'root',
        'pass' =&gt; '1111',
        'database' =&gt; 'mysql',
        'prefix' =&gt; '',
        'charset' =&gt; 'utf8mb4'
    ),
);
</pre>
                    <p id="smarty.conf.php">smarty.conf.php</p>
                    <p>Smarty相关配置 代码：</p>
                    <pre>&lt;?php
if(!defined('DIR')){
	exit('Please correct access URL.');
}

require_once DIR_CLASS.'smarty/Smarty.class.php';
$smarty = new Smarty();
$smarty-&gt;template_dir = DIR_TPL;
$smarty-&gt;compile_dir = DIR.'tpl_c/';
$smarty-&gt;left_delimiter = '&lt;!--{';
$smarty-&gt;right_delimiter = '}--&gt;';</pre>
                    
                    <h2 id="Controller">控制器说明</h2>
                    <p>控制器目录 <span class="red">controller/</span> 下，支持多目录，控制器代码如下</p>
                    <p>比如：http://localhost/test/aaa</p>
                    <pre>&lt;?php
if(!defined('DIR')){
	exit('Please correct access URL.');
}

class Action_Aaa extends Libs{
    function __construct(){
        //  配置数据库信息
        $this-&gt;db = 'db1, db2';     //  引入数据库 必须放在初始化函数里
        $this-&gt;is_smarty = true;    //  是否使用Smarty模板， ture or false, 默认使用，可以不要这行； 不使用的话可以用php原生，必须赋值false； 可以不放在初始化函数里
        $this-&gt;tpl = 'test/aaa';    //  对应模板文件 tpl/test/aaa.tpl.html 可以不放在初始化函数里
        $this-&gt;title = '测试';      //  选写 在模板里使用变量方法 &lt;!--{$title}--&gt; 可以不放在初始化函数里
    }
    function index(){
        $reg = M('user/reg', $this-&gt;db1);   //  模型使用方法 对应模型文件 model/user/Reg.model.php <span class="red">传进数据库操作对象 用于操作数据库</span>
        $reg-&gt;get();
        
        $reg1 = M('user/reg', $this-&gt;db2);
        $reg1-&gt;get();
        
        // 数据库操作相关
        $this-&gt;db1-&gt;fetchFirst($sql);   //  返回一条数据
        $this-&gt;db1-&gt;fetchAll($sql);     //  返回全部数据
        $this-&gt;db1-&gt;insert($tableName, $data);  //  insert数据 <span class="red">data是数组 array('字段名' =&gt; '值')</span>;
        $this-&gt;db1-&gt;replace_into($tableName, $data);    //  REPLACE INTO 参数同上
        $this-&gt;db1-&gt;insert_id();    //  返回insert的ID
        
        // 加载类和方法
        $this-&gt;load_class('xxx/xxx');   //  加载类文件 支持多目录
        $this-&gt;load_fun('xxx/xxx');     //  加载函数文件 支持多目录
        
        //  post get 获取值
        Request::post('aa');
        Request::post_int('aa');    //  如果不是整型 返回 NULL
        Request::post_email('aa');  //  如果不是email 返回 NULL
        Request::post_phone('aa');  //  如果不是手机号 返回 NULL 目前支持 13/14/15/17/18 开头的
        
        Request::get('aa');
        Request::get_int('aa');
        Request::get_email('aa');
        Request::get_phone('aa');
    }
}
</pre>
                    
                    <h2 id="Model">模型说明</h2>
                    <p>模型目录 model/ 支持多目录，<a href="http://www.longphp.com/#Controller">控制器里加载及使用</a>，模型代码如下：</p>
                    <pre>&lt;?php
/**
 * @require : none
 * @author : yuwenlong@wenlong.org
 * @date : 2015-09-02 15:45:05
 * @description : 模型文件
 */
if(!defined('DIR')){
    exit('Please correct access URL.');
}
 
class Reg extends Model {
    function get(){
        print_r($this-&gt;db);
    }
}
</pre>
                    
                    <h2 id="View">视图说明</h2>
                    <p>视图目录 tpl/ 支持多目录，<a href="http://www.longphp.com/#Controller">控制器里加载及使用</a>，视图代码如下：</p>
                    <p>使用smarty</p>
                    <pre>&lt;!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"&gt;
&lt;html xmlns="http://www.w3.org/1999/xhtml"&gt;
&lt;head&gt;
&lt;meta http-equiv="Content-Type" content="text/html; charset=utf-8" /&gt;
&lt;title&gt;
&lt;!--{$title}--&gt;
&lt;/title&gt;
&lt;script type="text/javascript" src="http://cdn.iciba.com/web/js/jquery-1.10.2.min.js"&gt;&lt;/script&gt;
&lt;/head&gt;
</pre>
                    <p>不使用smaryt</p>
                    <pre>&lt;!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"&gt;
&lt;html xmlns="http://www.w3.org/1999/xhtml"&gt;
&lt;head&gt;
&lt;meta http-equiv="Content-Type" content="text/html; charset=utf-8" /&gt;
&lt;title&gt;
&lt;?php echo $title;?&gt;
&lt;/title&gt;
&lt;script type="text/javascript" src="http://cdn.iciba.com/web/js/jquery-1.10.2.min.js"&gt;&lt;/script&gt;
&lt;/head&gt;
</pre>
                    
                    <h2 id="Class">类库文件说明</h2>
                    <p>类库文件放在 class/ 下，<a href="http://www.longphp.com/#Controller">控制器里可使用 $this-&gt;load_class(); 加载</a></p>
                    <p class="red">文件名和类名首字母要大写</p>
                    <p id="Bihua.class.php">笔画</p>
                    <pre>$this-&gt;load_class('bihua');
$this-&gt;bihua-&gt;find('于');
</pre>
                    <p id="Page.class.php">翻页</p>
                    <pre>$this-&gt;load_class('page', false);

/**
 *  翻页类
 *
 *  $num            总条数
 *  $pagesize       每页显示的条数
 *  $nowpage        当前页数
 *  $url            翻页参数名
 *  $pagenum        显示出多少页
 *
 *  author          于文龙
 **/
Page::show(1000, 10, 5, 'page', 5);
</pre>
                    
                    <p id="Session.class.php">Session</p>
                    <pre>//  框架里session使用方法 <span class="red">使用前先把session.sql导入到数据库</span>
global $key;    //  调用全局加密key 在 lib/Source.lib.php 里设置
$this-&gt;load_class('session', false);
$session = new Session($this-&gt;db1);

$sid = $session-&gt;generate_sid();

$test_data = array(
    'uid' =&gt; 111,
    'username' =&gt; '于文龙'
);

$session-&gt;set_session($sid, $test_data);
$session-&gt;del_session($sid);
$content = $session-&gt;get_session($sid);
</pre>
                    
                    <p id="Verification_code.class.php">动态验证码</p>
                    <pre>//  比如前端
&lt;img src="/verification_code" onclick="this.src=this.src+'?'+Math.random();"&gt;

//  控制器 verification_code 里的 index 方法 直接
$this-&gt;load_class('verification_code', false);
</pre>
                    
                    <h2 id="Function">函数文件说明</h2>
                    <p id="Source.fun.php">公共函数库</p>
                    <pre>/**
 * 无需加载
 * 加密解密函数
 * key 可使用全局key 控制器内声明 global $key;
 */
$a = authcode('abc', 'ENCODE', 'key');
$b = authcode($a, 'DECODE', 'key');  // $b(abc)

$a = authcode('abc', 'ENCODE', 'key', 3600);
$b = authcode('abc', 'DECODE', 'key'); // 在一个小时内，$b(abc)，否则 $b 为空
</pre>
                    
                    <p id="Mail.fun.php">发送邮件</p>
                    <pre>$this-&gt;load_fun('mail');

// 使用前请去 fun/Mail.fun.php 配置发送邮箱信息
// 给多人发送用 英文边角逗号间隔 如：yuwenlong@wenlong.org, yuwenlong@php.net
send_mail('发送给谁', '标题', '正文内容', '抄送给谁');
</pre>
                    
                    <p id="Curl.fun.php">CURL</p>
                    <pre>$this-&gt;load_fun('curl');

/**
 * $url     请求的URL
 * $type    请求方式 POST GET DELETE PUT
 * $data    请求数据 Array
 * $header  请求头信息 Array
 *
 * GET 方式的话 $data 传空 传的参数写进url
 */
curl($url, $type, $data, $header);
</pre>
                    
                    <p id="GetInitialssentence.fun.php">中文首字母</p>
                    <pre>$this-&gt;load_fun('getInitialssentence');

// 单个字
getFirstLetter_GBK($str);
getFirstLetter_UTF8($str);

// 句子
getInitialsSentence_GBK($str);
getInitialsSentence_UTF8($str);
</pre>
                </div>
                
                <div class="col-md-3">
                    <nav id="nav" class="bs-docs-sidebar hidden-print hidden-xs hidden-sm affix">
                        <ul class="nav bs-docs-sidenav">
                            <li><a href="http://www.longphp.com/#Info">框架简介</a></li>
                            <li><a href="http://www.longphp.com/#Download">框架下载地址</a></li>
                            <li><a href="http://www.longphp.com/#CodeRepository">框架代码仓库</a></li>
                            <li><a href="http://www.longphp.com/#Directory">目录说明</a></li>
                            <li><a href="http://www.longphp.com/#Nginx">Nginx配置</a></li>
                            <li><a href="http://www.longphp.com/#Routing">路由说明</a></li>
                            <li><a href="http://www.longphp.com/#Conf">配置文件说明</a></li>
                            <li class="info x" id="Conf_info">
                                <ol><a href="http://www.longphp.com/#config.conf.php">config.conf.php</a></ol>
                                <ol><a href="http://www.longphp.com/#db.conf.php">db.conf.php</a></ol>
                                <ol><a href="http://www.longphp.com/#smarty.conf.php">smarty.conf.php</a></ol>
                            </li>
                            <li><a href="http://www.longphp.com/#Controller">控制器说明</a></li>
                            <li><a href="http://www.longphp.com/#Model">模型说明</a></li>
                            <li><a href="http://www.longphp.com/#View">视图说明</a></li>
                            <li><a href="http://www.longphp.com/#Class">类库文件说明</a></li>
                            <li class="info x" id="Class_info">
                                <ol><a href="http://www.longphp.com/#Bihua.class.php">笔画</a></ol>
                                <ol><a href="http://www.longphp.com/#Page.class.php">翻页</a></ol>
                                <ol><a href="http://www.longphp.com/#Session.class.php">Session</a></ol>
                                <ol><a href="http://www.longphp.com/#Verification_code.class.php">动态验证码</a></ol>
                            </li>
                            <li><a href="http://www.longphp.com/#Function">函数文件说明</a></li>
                            <li class="info x" id="Function_info">
                                <ol><a href="http://www.longphp.com/#Source.fun.php">公共函数库</a></ol>
                                <ol><a href="http://www.longphp.com/#Mail.fun.php">发送邮件</a></ol>
                                <ol><a href="http://www.longphp.com/#Curl.fun.php">CURL</a></ol>
                                <ol><a href="http://www.longphp.com/#GetInitialssentence.fun.php">中文首字母</a></ol>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>

            <footer style="font-family: 微软雅黑; padding-bottom:15px;">© 2017 Powered by yuwenlong 感谢 <a href="http://cloud.wenlong.org/" target="_blank">文龙云</a> 提供服务器和带宽 京ICP备13039255号</footer>
        </div>
        

        
        <script type="text/javascript">
            $('.nav a').on('click', function(){
                var href = $(this).attr('href');
                $('.info').addClass('x');
                $(href + '_info').removeClass('x');
            });
        </script>
        </body></html>
