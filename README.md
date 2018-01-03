Paladin Admin Panel
=

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

### 配置认证服务的用户Model

请修改 `config/auth.php` 中的 providers.users.model 选项，改为以下内容

```php
    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => Charlestide\Paladin\Models\Admin::class, //这就是要修改的地方
        ],
    ],
```

### 运行Paladin的发布程序

发布程序(publish)能够使Laravel的扩展包中的文件，移动到目标项目中

请在项目根目录运行 `artian` 工具，它是Laravel的一部分

```bash
php artian vendor:puslish --tag=paladin
```

### 运行数据库库迁移

修改 `database/seeds/DatabaseSeeder.php`，在`run`方法中增加`AdminsTableSeeder`的调用，就下面这样

```php
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(AdminsTableSeeder::class); //这是增加的部分
    }
}
```

然后运行迁移命令 

```bash
php artian mirgate --seed
```

```blade
<font color=red>注意</font>，这会运行您的所有mirgations
```

### 启用服务器

你可以启动本地的nginx, apache或者其他web服务器，当然也可以使用的Laravel的valet，然后就可以访问了



