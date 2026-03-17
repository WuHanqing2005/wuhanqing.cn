# wuhanqing.cn

> Dynamic WordPress deployment with a geo-aware routing gateway.

## 先说结论（重要）

当前仓库的生产架构已经切换为：

- 根目录 `index.html` 仅作为入口重定向网关
- 业务站点全部运行在 `wordpress/` 动态系统中
- 旧静态目录（`zh-CN/`、`en-US/`、`ja-JP/`、`ko-KR/`、`de-DE/`、`css/`、`js/` 等）目前不作为主站运行路径

也就是说，这不再是“静态多语言站点仓库”，而是“WordPress 动态站点仓库 + 一个智能入口页”。

---

## 架构概览

```mermaid
flowchart LR
    A[Visitor Request] --> B[index.html Gateway]
    B --> C{Geo/IP Detect}
    C -->|zh| D[/wordpress]
    C -->|en/ja/ko/de| E[/wordpress/?lang=xx]
    D --> F[WordPress Core]
    E --> F[WordPress Core]
    F --> G[Theme + Plugins + DB]
```

入口页负责“识别 + 跳转”，内容页、文章页、管理页、主题渲染全部由 WordPress 提供。

---

## 仓库事实扫描（基于当前目录）

扫描结果（本地实测）：

- 全仓库文件数：`9041`
- `wordpress/` 文件数：`8765`
- 占比约：`96.95%`

`wp-content/` 组成：

- `themes`: 4500 files
- `languages`: 739 files
- `plugins`: 610 files
- `uploads`: 1 file

结论：仓库的绝对主体已经是 WordPress 动态系统。

---

## 生产中实际生效的核心目录

```text
.
├── index.html                     # 路由网关（Geo/IP -> WordPress）
└── wordpress/
    ├── wp-admin/                  # 管理后台
    ├── wp-includes/               # WordPress 核心库
    ├── wp-content/
    │   ├── themes/                # 主题
    │   ├── plugins/               # 插件
    │   ├── languages/             # 语言包
    │   └── uploads/               # 媒体资源
    ├── wp-config.php              # 站点配置（敏感）
    ├── wp-login.php               # 登录入口
    └── index.php                  # WordPress 入口
```

---

## 当前主题与插件（扫描结果）

### 已安装主题

- `Sakurairo`（style.css 显示版本 3.0.10，支持 WP 6.8）
- `argon`（版本 1.3.5）
- `blocksy`
- `generatepress`
- `twentytwentyfive`
- `twentytwentyfour`
- `twentytwentythree`
- `twentytwentytwo`

### 已安装插件

- `akismet`
- `media-cleaner`
- `polylang`
- `theme-my-login`

### 语言包现状

`wp-content/languages/` 中存在多语言包，覆盖 `zh_CN`、`ja`、`ko_KR`、`de_DE` 等，和 `polylang` 组合后可用于多语言动态内容。

---

## 入口页路由逻辑（index.html）

根目录 `index.html` 的行为是：

1. 读取访问者 IP / Geo 信息（多接口兜底：`ipapi`、`ipwho.is`、`ipinfo`）
2. 映射语言：
   - `CN/HK/MO/TW -> zh`
   - `JP -> ja`
   - `KR/KP -> ko`
   - `DE/AT/CH -> de`
   - 其他 -> `en`
3. 跳转到：
   - 中文：`https://wuhanqing.cn/wordpress`
   - 其他语言：`https://wuhanqing.cn/wordpress/?lang=<lang>`
4. 如果已在 `/wordpress`、`/wp-`、`/wp-admin` 路径，直接退出，避免重定向循环

这是一个典型“冷启动入口网关”方案：入口轻量，主站动态。

---

## 本地开发与上线（WordPress模式）

### 开发环境建议

- PHP 8.x
- MySQL 8.x 或 MariaDB 10.6+
- Nginx 或 Apache
- HTTPS（生产强制）

### 最小启动流程

1. 部署 `wordpress/` 到 Web 根目录（或子目录 `/wordpress`）。
2. 配置数据库并完成 `wp-config.php`。
3. 访问 `/wordpress/wp-admin` 完成站点初始化。
4. 配置固定链接、主题、插件和语言策略（Polylang）。
5. 验证根目录 `index.html` 路由跳转正确。

---

## 安全与运维基线

- 不要在仓库中暴露真实数据库密码、盐值与 API 密钥
- `wp-config.php` 建议按环境分离（生产/测试）
- 定期升级 WordPress 核心、主题与插件
- 启用自动备份（数据库 + `wp-content/uploads`）
- 对 `/wp-admin` 增加额外防护（IP 白名单、二次验证或 WAF）
- 全站启用 HTTPS 与安全头

---

## 关于旧静态目录

当前仓库中仍保留了大量历史静态目录与资源文件，这些内容可视为：

- 历史版本归档
- 迁移参考素材
- 可复用前端资源池

但默认生产路径已迁移到 WordPress 动态系统，不再建议将这些静态目录作为主站入口。

---

## License

仓库根目录包含 `LICENSE`。WordPress 核心及部分主题/插件遵循各自开源协议，请在二次分发时分别遵守其许可证条款。
