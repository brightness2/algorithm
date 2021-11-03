<?php
/*
 * @Author: Brightness
 * @Date: 2021-11-03 11:29:59
 * @LastEditors: Brightness
 * @LastEditTime: 2021-11-03 14:24:44
 * @Description: 中间件实现的原理
 */
/**
 * 中间件的实现，使用到装饰器的设计模式，只是简易方式；也是把主要的操作进行包装
 * 中间件要求：
中间件要满足一定的规范：总是返回一个闭包，闭包中总是传入相同的参数（由主要逻辑决定）， 闭包总是返回句柄(handler)的执行结果；

如果中间件的逻辑在返回句柄return $handler($name)前完成，就是前置中间件，否则为后置中间件。
 */ 
$app = function($name)
{
    echo "这是{$name}应用<br/>";
};

/**
 * 前置认证中间件
 */
$auth = function($hander)
{
    return function($name) use ($hander)
    {
        echo "{$name}应用 auth 前置中间件<br/>";
        return $hander($name);
    };
};
/**
 * 前置过滤中间件
 */
$filter = function($hander){
    return function($name) use ($hander){
        echo "{$name}应用 filter 前置中间件<br/>";
        return $hander($name);
    };
};

/**
 * 后置日志中间件
 */
$log = function($hander){
    return function($name) use ($hander){
        $res = $hander($name);
        echo "{$name}应用 log 后置中间件<br/>";
        return $res;
    };
};


//中间件注册，中间件保存在栈中,注意栈是先进后出的，所以要注意注册的顺序

$stack = new SplStack();


/**
 * 打包中间件
 *
 * @return void
 */
function packMiddleware($hander,SplStack $middlewares){
    
    while($middlewares->count() !=0){
        $middleware = $middlewares->pop();
        $hander = $middleware($hander);
    }
    return $hander;
}

$stack->push($log);
$stack->push($filter);
$stack->push($auth);

$run = packMiddleware($app,$stack);
$run('Brightness');


 /**常用于验证用户是否经过认证，添加响应头（跨域），记录请求日志等。 */
