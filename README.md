Yii 2 Advanced Project Template
===============================

Yii 2 Advanced Project Template is a skeleton [Yii 2](http://www.yiiframework.com/) application best for
developing complex Web applications with multiple tiers.

The template includes three tiers: front end, back end, and console, each of which
is a separate Yii application.

The template is designed to work in a team development environment. It supports
deploying the application in different environments.

Documentation is at [docs/guide/README.md](docs/guide/README.md).

[![Latest Stable Version](https://poser.pugx.org/yiisoft/yii2-app-advanced/v/stable.png)](https://packagist.org/packages/yiisoft/yii2-app-advanced)
[![Total Downloads](https://poser.pugx.org/yiisoft/yii2-app-advanced/downloads.png)](https://packagist.org/packages/yiisoft/yii2-app-advanced)
[![Build Status](https://travis-ci.org/yiisoft/yii2-app-advanced.svg?branch=master)](https://travis-ci.org/yiisoft/yii2-app-advanced)

# 结合[深入理解Yii2.0](http://www.digpage.com/index.html)学习 提升代码理解

## 深入理解Yii2 目录

**属性（Property）**

- [实现属性的步骤](http://www.digpage.com/property.html#id2)
- [Object的其他与属性相关的方法](http://www.digpage.com/property.html#object)
- [Object和Component](http://www.digpage.com/property.html#objectcomponent)
- [Object的配置方法](http://www.digpage.com/property.html#object-config)

**事件（Event）**

- [Yii中与事件相关的类](http://www.digpage.com/event.html#yii)
- [事件handler](http://www.digpage.com/event.html#handler)
- [事件的绑定与解除](http://www.digpage.com/event.html#id2)[事件的绑定](http://www.digpage.com/event.html#id3)[保存handler的数据结构](http://www.digpage.com/event.html#id4)[事件的解除](http://www.digpage.com/event.html#id5)
- [事件的触发](http://www.digpage.com/event.html#id6)
- [多个事件handler的顺序](http://www.digpage.com/event.html#id7)
- [事件的级别](http://www.digpage.com/event.html#id8)[类级别事件](http://www.digpage.com/event.html#id9)[全局事件](http://www.digpage.com/event.html#id10)

**行为（Behavior）**

- [使用行为](http://www.digpage.com/behavior.html#id2)
- [行为的要素](http://www.digpage.com/behavior.html#id3)[行为的依附对象](http://www.digpage.com/behavior.html#id4)[行为所要响应的事件](http://www.digpage.com/behavior.html#id5)[行为的绑定与解除](http://www.digpage.com/behavior.html#id6)
- [定义一个行为](http://www.digpage.com/behavior.html#id7)[行为的绑定](http://www.digpage.com/behavior.html#id8)[绑定的内部原理](http://www.digpage.com/behavior.html#id11)[解除行为](http://www.digpage.com/behavior.html#id12)[行为响应的事件实例](http://www.digpage.com/behavior.html#id13)
- [行为的属性和方法注入原理](http://www.digpage.com/behavior.html#id14)[属性的注入](http://www.digpage.com/behavior.html#id15)[方法的注入](http://www.digpage.com/behavior.html#id16)[注入属性与方法的访问控制](http://www.digpage.com/behavior.html#id17)
- [行为与继承和特性（Traits） 的区别](http://www.digpage.com/behavior.html#traits)[行为与继承](http://www.digpage.com/behavior.html#id18)[行为与特性](http://www.digpage.com/behavior.html#id19)

**yii laravel routes **

- [routes](https://github.com/missxiaolin/yii-routes)

DIRECTORY STRUCTURE
-------------------

```
common
    config/              contains shared configurations
    mail/                contains view files for e-mails
    models/              contains model classes used in both backend and frontend
console
    config/              contains console configurations
    controllers/         contains console controllers (commands)
    migrations/          contains database migrations
    models/              contains console-specific model classes
    runtime/             contains files generated during runtime
backend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains backend configurations
    controllers/         contains Web controller classes
    models/              contains backend-specific model classes
    runtime/             contains files generated during runtime
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
frontend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains frontend configurations
    controllers/         contains Web controller classes
    models/              contains frontend-specific model classes
    runtime/             contains files generated during runtime
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
    widgets/             contains frontend widgets
vendor/                  contains dependent 3rd-party packages
environments/            contains environment-based overrides
tests                    contains various tests for the advanced application
    codeception/         contains tests developed with Codeception PHP Testing Framework
```
# yii


# phalcon-project
[![Total Downloads](https://poser.pugx.org/limingxinleo/phalcon-project/downloads)](https://packagist.org/packages/limingxinleo/phalcon-project)
[![Latest Stable Version](https://poser.pugx.org/limingxinleo/phalcon-project/v/stable)](https://packagist.org/packages/limingxinleo/phalcon-project)
[![Latest Unstable Version](https://poser.pugx.org/limingxinleo/phalcon-project/v/unstable)](https://packagist.org/packages/limingxinleo/phalcon-project)
[![License](https://poser.pugx.org/limingxinleo/phalcon-project/license)](https://packagist.org/packages/limingxinleo/phalcon-project)


[Phalcon 官网](https://docs.phalconphp.com/zh/latest/index.html)

[wiki](https://github.com/limingxinleo/simple-subcontrollers.phalcon/wiki)

## 安装
1. 安装项目
~~~
composer create-project limingxinleo/thrift-go-phalcon-project
~~~
2. 使用Composer安装Thrift扩展后，把go的扩展包拷贝到GOPATH中(或建立软连接)。
~~~
ln -s  /your/path/to/thrift-go-phalcon-project/vendor/apache/thrift/lib/go/thrift thrift
~~~
3. 编译服务 
- Go 使用 thrift -r --gen go:thrift_import=thrift App.thrift
- Php 使用 thrift -r --gen php:server,psr4 App.thrift

4. Go服务安装
~~~
从GO官网下载编译好的压缩包 例如 go1.8.3.linux-amd64.tar.gz
$ tar -xzf go1.8.3.linux-amd64.tar.gz
$ mv go /usr/local/go/1.8.3
$ vim /etc/profile 
export GOROOT='/usr/local/go/1.8.3' # 没有文件夹则新建
export GOPATH='/usr/local/go/libs/' # 没有文件夹则新建
export PATH=$GOROOT/bin:$PATH
$ go get -u github.com/kardianos/govendor
$ cd /usr/local/go/libs/src/github.com/kardianos/govendor/
$ go build
$ cd /usr/local/bin
$ ln -s /usr/local/go/libs/src/github.com/kardianos/govendor/govendor govendor
~~~

## Go&Swoole RPC 服务
* Go
thrift/gen-go/main.go
~~~
# RPC服务注册方法
server.RegisterProcessor("app", service.NewAppProcessor(&impl.App{}));
~~~

* Swoole
app/tasks/Thrift/Service.php
~~~
$handler = new AppHandler();
$processor->registerProcessor('app', new AppProcessor($handler));
~~~

## 服务实现
* Swoole
app/thrift/Services/AppHandle.php
~~~php
<?php 
namespace App\Thrift\Services;

use MicroService\AppIf;

class AppHandler extends Handler implements AppIf
{
    public function version()
    {
        return $this->config->version;
    }

}
~~~

## 负载均衡
- Nginx Stream负载均衡已经十分强大了，自带健康检查。[TCP负载均衡](https://github.com/limingxinleo/note/blob/master/nginx/nginx.md#tcp负载均衡)

## 服务发现
1. 项目本人已内置基于Thrift的注册中心功能
- 已实现Swoole服务注册中心
- 已实现Go服务注册中心

2. 或者配合[注册中心](https://github.com/limingxinleo/service-registry-swoole-phalcon.git)一起使用
app/tasks/Thrift/ServiceTask.php
~~~
protected function beforeServerStart(swoole_server $server)
{
    parent::beforeServerStart($server); // TODO: Change the autogenerated stub

    // 增加服务注册心跳进程
    $worker = new swoole_process(function (swoole_process $worker) {
        $client = new swoole_client(SWOOLE_SOCK_TCP);
        if (!$client->connect(env('REGISTRY_IP'), env('REGISTRY_PORT'), -1)) {
            exit("connect failed. Error: {$client->errCode}\n");
        }
        swoole_timer_tick(5000, function () use ($client) {
            $service = env('REGISTRY_SERVICE', 'github');
            $data = [
                'service' => $service,
                'ip' => env('SERVICE_IP'),
                'port' => env('SERVICE_PORT'),
                'nonce' => time(),
                'register' => true,
                'sign' => 'xxx',
            ];

            $client->send(json_encode($data));
            $result = $client->recv();

            $result = json_decode($result, true);
            if ($result['success']) {
                foreach ($result['services'] as $key => $item) {
                    Redis::hset($service, $key, json_encode($item));
                }
            }
        });
    });

    $server->addProcess($worker);
}

~~~


## Thrift 数据类型
1. 基本类型（括号内为对应的Java类型）：
~~~
bool（boolean）: 布尔类型(TRUE or FALSE)
byte（byte）: 8位带符号整数
i16（short）: 16位带符号整数
i32（int）: 32位带符号整数
i64（long）: 64位带符号整数
double（double）: 64位浮点数
string（String）: 采用UTF-8编码的字符串
~~~

2. 特殊类型（括号内为对应的Java类型）
~~~
binary（ByteBuffer）：未经过编码的字节流
~~~

3. Structs（结构）：
~~~
struct UserProfile {
    1: i32 uid,
    2: string name,
    3: string blurb
}

struct UserProfile {
    1: i32 uid = 1,
    2: string name = "User1",
    3: string blurb
}
~~~

4. 容器，除了上面提到的基本数据类型，Thrift还支持以下容器类型：

> list(java.util.ArrayList)
> set(java.util.HashSet)
> map（java.util.HashMap）

~~~
struct Node {
    1: i32 id,
    2: string name,
    3: list<i32> subNodeList,
    4: map<i32,string> subNodeMap,
    5: set<i32> subNodeSet
}

struct SubNode {
    1: i32 uid,
    2: string name,
    3: i32 pid
}

struct Node {
    1: i32 uid,
    2: string name,
    3: list<subNode> subNodes
}
~~~

5. 服务
~~~
service UserStorage {
    void store(1: UserProfile user),
    UserProfile retrieve(1: i32 uid)
}
~~~


