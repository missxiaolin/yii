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
