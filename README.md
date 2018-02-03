Paladin Admin Panel 
=
[![Build Status](https://travis-ci.org/charlestide/Paladin.svg?branch=master)](https://travis-ci.org/charlestide/Paladin)
[![experimental](http://badges.github.io/stability-badges/dist/experimental.svg)](http://github.com/badges/stability-badges)

    目标是实现一个包含简单权限管理的后台脚手架

##安装

### 从composer 安装
```bash
    composer require charlestide/paladin`
```
### 配置Mysql

Paladin 使用Mysql作为数据库，请配置Mysql信息

一般在项目根目标的 `.env` 文件中配置，这个文件一般在使用 [laravel/installer](https://d.laravel-china.org/docs/5.5/installation) 创建项目时，会自动生成

以下是示例
```ini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306 
DB_DATABASE=paladin 
DB_USERNAME=root
DB_PASSWORD=
```

### 运行安装程序

```bash
    php artisan paladin:install
```
安装程序最后会询问您是否创建超级管理员，建议您选择是，并指定登陆用的邮箱和密码

##安装程序做了什么

###发布了配置文件

覆盖了以下文件
```blade
    config/auth.php
    config/permission.php //这是 spatie/laravel-permission 的配置文件
```

创建了Paladin自身的配置文件
```text
    config/paladin.php
```
###生成了.babelrc

其内容如下：
```json
{
  "presets": ["env"],
  "plugins": ["syntax-dynamic-import"]
}
```
其作用主要是便于后续前端编译


## 启用服务器

你可以启动本地的nginx, apache或者其他web服务器，当然也可以使用的Laravel的valet，然后就可以访问了



