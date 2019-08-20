# kuaidi100
[![FOSSA Status](https://app.fossa.io/api/projects/git%2Bgithub.com%2Fpuzzle9%2Fkuaidi100.svg?type=shield)](https://app.fossa.io/projects/git%2Bgithub.com%2Fpuzzle9%2Fkuaidi100?ref=badge_shield)

封装快递100 接口

# 使用方法
## 安装
```shell
$ composer require puzzle9/kuaidi100 -vvv
```

## 通用方法
```php
use Puzzle9\Kuaidi100\Express;

$express = new Express($key, $customer);

//实时查询
$info = $express->synquery($com, $num, $phone=null); // 快递服务商 快递单号 手机号

//智能判断快递服务商
$info = $express->autonumber($num); // 快递单号

//订阅推送
$info = $express->subscribe($company, $number); // 快递服务商 快递单号

//从公司编码获取公司名称
$info = $express->kdbm($code, $getName=true, $default); // 快递编码 是否获取公司名称 未获取到默认返回
```

## 在 Laravel 中使用
 
 在 Laravel 中使用也是同样的安装方式，配置写在 `config/services.php` 中：
 
 ```php
     .
     .
     .
    'kuaidi100' => [
        'key' => env('KUAIDI100_KEY'),
        'customer' => env('KUAIDI100_CUSTOMER'),
        'callbackurl' => env('KUAIDI100_CALLBACKURL'),
    ],
 ```
 
 然后在 `.env` 中配置 `KUAIDI100_KEY`、`KUAIDI100_CUSTOMER`、`KUAIDI100_CALLBACKURL`；
 
 ```env
 KUAIDI100_KEY=xxxxxxxxxxxxxxxxxxxxx
 KUAIDI100_CUSTOMER=xxxxxxxxxxxxxxxxxxxxx
 KUAIDI100_CALLBACKURL=http://localhost
 ```
 
 可以用两种方式来获取 `Puzzle9\Kuaidi100` 实例：
 
 ### 方法参数注入
 
 ```php

    use Puzzle9\Kuaidi100\Express;
     .
     .
     .
     public function query(Express $express) 
     {
        $info = $express->synquery($com, $num, $phone=null);
     }
     .
     .
     .
 ```
 
 ### 服务名访问
 
 ```php
     .
     .
     .
     public function query() 
     {
         $response = app('Kuaidi100')->synquery($com, $num, $phone=null);
     }
     .
     .
     .
 
 ```

# 其他
- 返回结果为 `json`
- 可以看看 `test.php` 文件

# 感谢
- <https://kuaidi100.com/>
- <https://github.com/inbjo/express>

# License

MIT

[![FOSSA Status](https://app.fossa.io/api/projects/git%2Bgithub.com%2Fpuzzle9%2Fkuaidi100.svg?type=large)](https://app.fossa.io/projects/git%2Bgithub.com%2Fpuzzle9%2Fkuaidi100?ref=badge_large)