- [Longphp](#Longphp)
  + [协议](#协议)
  + [开发环境](#开发环境)
  + [用法说明](#用法说明)
    + [CLI](#CLI)
    + [WEB](#WEB)
  + [代码简单说明](#代码简单说明)
  + [注意事项](#注意事项)

# Longphp
Longphp 开发框架

## 协议
木兰宽松许可证, 第2版

## 开发环境

|       | 推荐配置 | 最低配置 |
|-------|------|------|
| PHP   | 8.1  | 8.0  |

## 用法说明
### CLI
```shell
php -f cli.php [参数]

## 如果不知道参数，直接执行如下语句，会显示参数
php -f cli.php
## 显示结果如下:
请正确输入参数（举例：php -f cli.php aaa）：

aaa bbb
ccc ddd
fff eee
...
```

### WEB
> 根据 uri 查找控制器 遵循驼峰命名
> 
> 比如：http://127.0.0.1:8081/aaa/bbb/index
> 
> 会查找 controller/web/aaa/bbb/index.php
> 
> 比如：http://127.0.0.1:8081/aaa/bbb/index_asd
> 
> 会查找 controller/web/aaa/bbb/indexAsd.php

## 代码简单说明
1. 在文件 `config/init.php` 里添加 `参数白名单` 例如：
      ```phpt
      // 允许的参数白名单
      $configs['allow_argvs'] = [
          'aaa' => 'bbb',
          'ccc' => 'ddd',
          'fff' => 'eee'
      ];
   
      // web 默认控制器
      $configs['web'] = [
          'default_controller' => env('default.web_default_controller')
      ];
      ...
      ```
2. `controller` 目录里增加参数同名控制器文件
   1. 文件路径
      1. CLI：`controller/cli`
      2. WEB: `contrller/web`
   2. 控制器调 `service、model` 支持 `依赖注入`，例如：
      ```phpt
      <?php

      namespace controller\cli;

      use controller\baseController;
      use model\attackSoftModel;
      use service\softwareService;

      class getSoftware extends baseController
      {
          private attackSoftModel $attackSoftModel;
          private softwareService $softwareService;

           public function __construct(attackSoftModel $attackSoftModel, softwareService $softwareService)
           {
               $this->attackSoftModel = $attackSoftModel;
               $this->softwareService = $softwareService;

               parent::__construct();
           }

           public function run()
           {
               $softWares = $this->softwareService->getSoftware();

               $softData  = $this->attackSoftModel->getData();
           }
      }
      ```
3. `model` 目录说明
   1. 需要继承 `baseModel` 类
   2. 文件命名
      1. 原则上与数据表同名，会自动匹配数据表
         1. 例如，表名：`attck_group`，`model` 就是 `attckGroup.php`
      2. 同时支持自定义表名
         1. `model` 文件里设置受保护变量 `protected $tableName`
   3. 内置方法
      1. `queryRaw` 传参 SQL，执行给定的 SQL
      2. `featchAll` 获取上述方法执行的结果集
      3. `self::getTableName()` 获取当前 `model` 的表名
   4. 举例
      ```phpt
      <?php

      namespace model;

      class attackSoftModel extends baseModel
      {
          /**
           * 获取表数据
           *
           * @return mixed
          */
          public function getData(): mixed
          {
              return self::queryRaw('select * from `' . self::getTableName() . '`')->fetchAll();
          }
      }
      ```
4. `Log` 操作
   1. 举例
      ```phpt
      use class\log\Log;
   
      Log::info('asdasd', ['aaa'=>'bbb', 'ccc' => 'ddd', 'eee']);
      ```
      生成的日志内容
      ```log
      [2022-04-27 19:39:59] INFO "asdasd" {"aaa":"bbb","ccc":"ddd","0":"eee"}
      ```
   2. 支持 `info,error,warn` 三个方法
      1. 第一个参数：字符串
      2. 第二个参数：数组，日志里会转成 `JSON`
   3. 日志生成路径可以在 `.env` 里进行配置，记得在 `.gitignore` 配置忽略日志

## 注意事项
1. `控制器` 的命名空间要根据路径正确填写
2. `控制器` 文件名和类名，必须驼峰命名