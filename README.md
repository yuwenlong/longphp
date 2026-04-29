# 🐉 Longphp

[![PHP Version](https://img.shields.io/badge/PHP-8.0+-blue?style=flat-square&logo=php)](https://www.php.net/)
[![Version](https://img.shields.io/badge/Version-1.1.0-green?style=flat-square)]()
[![License](https://img.shields.io/badge/License-Mulan_PSL_v2-red?style=flat-square)](http://license.coscl.org.cn/MulanPSL2)
[![MVC](https://img.shields.io/badge/Architecture-MVC-purple?style=flat-square)]()
[![Zero Dependency](https://img.shields.io/badge/Dependency-Zero-orange?style=flat-square)]()

> 🚀 一款轻量级、零依赖的 PHP MVC 开发框架，支持 CLI 和 WEB 双模式运行

---

## 📑 目录

- [✨ 主要特性](#-主要特性)
- [📁 项目结构](#-项目结构)
- [🏗️ 架构说明](#️-架构说明)
- [⚙️ 环境要求](#️-环境要求)
- [🚀 快速开始](#-快速开始)
- [📖 使用说明](#-使用说明)
- [💻 代码示例](#-代码示例)
- [🔧 内置工具](#-内置工具)
- [⚠️ 注意事项](#️-注意事项)
- [📄 许可证](#-许可证)

---

## ✨ 主要特性

| 特性 | 说明 |
|:---:|:---|
| 🎯 | **零依赖** - 不依赖 Composer，纯原生 PHP 实现，开箱即用 |
| 🏗️ | **MVC 架构** - 清晰的 Controller → Service → Model 三层分离 |
| 🔄 | **双模式支持** - CLI 命令行 + WEB HTTP 统一控制器编写方式 |
| 💉 | **依赖注入** - 基于反射的自动 DI 容器，构造器自动注入 |
| 📂 | **自动加载** - 命名空间直接映射文件路径，无需手动 require |
| 📝 | **日志系统** - 按日期分文件，支持 info/error/warn 三级日志 |
| 🌐 | **cURL 封装** - 内置单个/并发 HTTP 请求工具 |
| ⏳ | **进度条** - CLI 模式下的可视化进度展示工具 |

---

## 📁 项目结构

```
longphp/
├── 📄 public/
│   └── index.php              # 🌐 WEB 模式入口
├── 📄 cli.php                 # 💻 CLI 模式入口
├── 📁 config/
│   ├── init.php               # ⚙️ 初始化配置
│   └── constant.php           # 📌 常量定义
├── 📁 controller/
│   ├── baseController.php     # 🎛️ 控制器基类
│   ├── cli/                   # 💻 CLI 控制器目录
│   └── web/                   # 🌐 WEB 控制器目录
├── 📁 service/
│   ├── baseService.php        # ⚙️ 服务基类
│   └── *.php                  # 📦 业务服务类
├── 📁 model/
│   └── *.php                  # 🗄️ 数据模型类
├── 📁 class/
│   ├── db/
│   │   └── MySQL.php          # 🗄️ 数据库操作类
│   ├── log/
│   │   └── Log.php            # 📝 日志类
│   └── ProgressBar.php        # ⏳ 进度条工具
├── 📁 function/
│   ├── init.php               # 🚀 初始化函数
│   └── help.php               # 🔧 辅助函数
├── 📄 .env.online             # 🌍 线上环境配置
├── 📄 .env.test               # 🧪 测试环境配置
└── 📄 LICENSE                 # 📜 木兰宽松许可证 v2
```

### 📂 目录说明

| 目录 | 说明 |
|:---:|:---|
| `public/` | WEB 模式入口目录，配置 Web 服务器指向此目录 |
| `controller/` | 控制器层，包含 `cli/` 和 `web/` 两个子目录 |
| `service/` | 服务层，处理业务逻辑 |
| `model/` | 模型层，负责数据库操作 |
| `class/` | 核心类库，包含数据库、日志等基础组件 |
| `function/` | 全局函数，包含初始化和辅助工具 |
| `config/` | 配置目录，包含框架初始化配置 |

---

## 🏗️ 架构说明

### 🔄 MVC 分层架构

```
┌─────────────────────────────────────────────────────────────┐
│                      🌐 请求入口                            │
├─────────────────────┬───────────────────────────────────────┤
│   📄 public/        │        💻 cli.php                     │
│   index.php         │                                       │
└─────────┬───────────┴───────────────────┬───────────────────┘
          │                               │
          ▼                               ▼
┌─────────────────────────────────────────────────────────────┐
│                  🎛️ Controller 控制器层                      │
│   • 接收用户请求                                              │
│   • 调用 Service 处理业务                                     │
│   • 返回响应结果                                              │
└─────────────────────────────┬───────────────────────────────┘
                              │
                              ▼
┌─────────────────────────────────────────────────────────────┐
│                  ⚙️ Service 服务层                           │
│   • 处理业务逻辑                                              │
│   • 数据转换和验证                                            │
│   • 调用 Model 获取数据                                      │
└─────────────────────────────┬───────────────────────────────┘
                              │
                              ▼
┌─────────────────────────────────────────────────────────────┐
│                  🗄️ Model 模型层                             │
│   • 数据库 CRUD 操作                                         │
│   • 数据表映射                                               │
│   • SQL 查询构建                                             │
└─────────────────────────────┬───────────────────────────────┘
                              │
                              ▼
┌─────────────────────────────────────────────────────────────┐
│                  🗄️ MySQL 数据库                             │
└─────────────────────────────────────────────────────────────┘
```

### 🔀 请求处理流程

#### WEB 模式
```
用户请求 → public/index.php → 解析 PATH_INFO → 路由到控制器 → 依赖注入 → 执行 run() → 返回响应
```

#### CLI 模式
```
命令行参数 → cli.php → 解析参数 → 路由到控制器 → 依赖注入 → 执行 run() → 输出结果
```

---

## ⚙️ 环境要求

### 📋 基础要求

|       | 推荐配置 | 最低配置 |
|:-----:|:-------:|:-------:|
| **PHP** | 8.1 | 8.0 |
| **MySQL** | 5.7+ | 5.6+ |

### 📦 PHP 扩展

| 扩展名 | 用途 | 是否必须 |
|:------:|:---:|:-------:|
| `mysqli` | MySQL 数据库连接 | ✅ 是 |
| `curl` | HTTP 请求 | ✅ 是 |
| `mbstring` | 多字节字符串处理 | ✅ 是 |
| `json` | JSON 数据处理 | ✅ 是 |

---

## 🚀 快速开始

### 📥 1. 获取代码

```bash
# 克隆项目
git clone https://github.com/your-username/longphp.git

# 进入项目目录
cd longphp
```

### ⚙️ 2. 环境配置

```bash
# 复制环境配置文件
cp .env.online .env

# 编辑配置文件（根据实际情况修改）
vim .env
```

**📝 .env 配置说明：**

```ini
[default]
db_default=mysql
web_default_controller=index

[log]
path_dir=log

[mysql]
host=127.0.0.1
port=3306
database=your_database
user=your_username
pass="your_password"
```

### 🌐 3. 配置 Web 服务器

#### Nginx 配置示例

```nginx
server {
    listen 80;
    server_name localhost;
    root /path/to/longphp/public;
    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass 127.0.0.1:9000;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }
}
```

#### Apache 配置示例

```apache
<VirtualHost *:80>
    DocumentRoot /path/to/longphp/public
    ServerName localhost
    
    <Directory /path/to/longphp/public>
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

### ✅ 4. 验证安装

```bash
# WEB 模式测试
curl http://localhost/

# CLI 模式测试
php -f cli.php
```

---

## 📖 使用说明

### 💻 CLI 模式

#### 基本用法

```bash
php -f cli.php [参数名]
```

#### 查看可用命令

```bash
php -f cli.php
```

**输出示例：**

```
请正确输入参数（举例：php -f cli.php getSoftware）：

getSoftware 获取软件列表
getDataSources 获取数据源
...
```

#### 执行命令

```bash
# 获取软件列表
php -f cli.php getSoftware

# 获取数据源
php -f cli.php getDataSources
```

### 🌐 WEB 模式

#### 路由规则

WEB 模式根据 `PATH_INFO` 自动映射到对应的控制器文件：

| URL | 控制器文件 |
|:---:|:---|
| `http://localhost/` | `controller/web/index.php` |
| `http://localhost/aaa/bbb/index` | `controller/web/aaa/bbb/index.php` |
| `http://localhost/aaa/bbb/index_asd` | `controller/web/aaa/bbb/indexAsd.php` |

#### 🐫 驼峰命名转换

URL 中的下划线会自动转换为驼峰命名：

- `index_asd` → `indexAsd`
- `get_user_list` → `getUserList`

---

## 💻 代码示例

### 🎛️ 控制器示例

#### CLI 控制器

```php
<?php

namespace controller\cli;

use controller\baseController;
use model\attackDsModel;
use service\datasourceService;

class getDataSources extends baseController
{
    private attackDsModel $attackDsModel;
    private datasourceService $datasourceService;

    public function __construct(attackDsModel $attackDsModel, datasourceService $datasourceService)
    {
        $this->attackDsModel = $attackDsModel;
        $this->datasourceService = $datasourceService;

        parent::__construct();
    }

    public function run()
    {
        // 🚀 获取数据源
        $data = $this->datasourceService->fetchDataSources();
        
        // 💾 保存到数据库
        $this->attackDsModel->syncData($data);
        
        echo "✅ 同步完成！" . PHP_EOL;
    }
}
```

#### WEB 控制器

```php
<?php

namespace controller\web;

use controller\baseController;

class index extends baseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function run()
    {
        // 🌐 返回 JSON 数据
        header('Content-Type: application/json');
        echo json_encode([
            'code' => 200,
            'message' => 'success',
            'data' => ['version' => '1.1.0']
        ]);
    }
}
```

### 🗄️ Model 示例

```php
<?php

namespace model;

class attackDsModel extends baseModel
{
    /**
     * 📊 获取表数据
     */
    public function getData(): mixed
    {
        return self::queryRaw('SELECT * FROM `' . self::getTableName() . '`')->fetchAll();
    }

    /**
     * 🔄 同步数据
     */
    public function syncData(array $data): void
    {
        foreach ($data as $item) {
            $sql = "INSERT INTO `" . self::getTableName() . "` (ds_id, name, description) 
                    VALUES ('{$item['ds_id']}', '{$item['name']}', '{$item['description']}')";
            self::queryRaw($sql);
        }
    }
}
```

### 📝 日志使用

```php
<?php

use class\log\Log;

// 📝 记录信息日志
Log::info('用户登录', ['user_id' => 123, 'ip' => '192.168.1.1']);

// ⚠️ 记录警告日志
Log::warn('配置文件缺失', ['file' => '.env']);

// ❌ 记录错误日志
Log::error('数据库连接失败', ['host' => 'localhost', 'port' => 3306]);
```

**日志输出格式：**

```
[2024-01-15 10:30:45] INFO "用户登录" {"user_id":123,"ip":"192.168.1.1"}
```

---

## 🔧 内置工具

### 🌐 cURL 封装

#### 单个请求

```php
<?php

// 📡 GET 请求
$response = curlCon('https://api.example.com/data');

// 📡 POST 请求
$response = curlCon('https://api.example.com/data', ['key' => 'value']);

// 📡 带 Header 请求
$response = curlCon('https://api.example.com/data', [], ['Authorization: Bearer token']);
```

#### 并发请求

```php
<?php

// 🔄 批量请求
$urls = [
    'https://api.example.com/users',
    'https://api.example.com/posts',
    'https://api.example.com/comments'
];

$results = curlMulti($urls);
```

### 🐫 命名转换

```php
<?php

// 下划线转驼峰
$camelCase = toCamelCase('get_user_list');  // getUserList

// 驼峰转下划线
$underscore = toUnderScore('getUserList');  // get_user_list
```

### ⏳ 进度条

```php
<?php

use class\ProgressBar;

$total = 100;
$progress = new ProgressBar($total);

for ($i = 0; $i < $total; $i++) {
    // 处理任务...
    $progress->update($i + 1);
}
```

---

## ⚠️ 注意事项

### 📌 命名规范

1. **控制器文件名和类名** 必须使用驼峰命名
   - ✅ `getDataSources.php` → `class getDataSources`
   - ❌ `get_data_sources.php` → `class get_data_sources`

2. **控制器命名空间** 要根据路径正确填写
   ```php
   // controller/cli/getDataSources.php
   namespace controller\cli;
   
   // controller/web/aaa/bbb/index.php
   namespace controller\web\aaa\bbb;
   ```

3. **Model 文件名** 与数据表名对应
   - 表名 `attck_group` → Model 文件 `attckGroup.php`

### 🔧 配置说明

1. **CLI 参数白名单** 需在 `config/init.php` 中配置
   ```php
   $configs['allow_argvs'] = [
       'getSoftware' => '获取软件列表',
       'getDataSources' => '获取数据源',
   ];
   ```

2. **环境配置文件** `.env` 不会被提交到 Git，请手动创建

### 🐛 常见问题

| 问题 | 解决方案 |
|:---:|:---|
| PHP 版本过低 | 升级到 PHP 8.0 或更高版本 |
| 控制器文件不存在 | 检查文件路径和命名空间是否正确 |
| 数据库连接失败 | 检查 `.env` 中的数据库配置 |
| 日志无法写入 | 确保 `log/` 目录存在且有写入权限 |

---

## 📄 许可证

本项目采用 **木兰宽松许可证 v2** ([Mulan PSL v2](http://license.coscl.org.cn/MulanPSL2)) 开源协议。

详情请查看 [LICENSE](LICENSE) 文件。

---

## 🤝 贡献

欢迎贡献代码和提交 Issue！

1. 🍴 Fork 本仓库
2. 🔀 创建特性分支 (`git checkout -b feature/AmazingFeature`)
3. 💾 提交更改 (`git commit -m 'Add some AmazingFeature'`)
4. 📤 推送到分支 (`git push origin feature/AmazingFeature`)
5. 📬 创建 Pull Request

---

<p align="center">
  <strong>🐉 Longphp</strong> - 轻量级 PHP 开发框架<br>
  <sub>Made with ❤️ by Longphp Developers</sub>
</p>
