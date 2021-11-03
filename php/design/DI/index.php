<?php
/*
 * @Author: Brightness
 * @Date: 2021-11-02 15:57:19
 * @LastEditors: Brightness
 * @LastEditTime: 2021-11-03 10:34:10
 * @Description:  控制反转(IOC)和依赖注入(DI)
 */
/**
 * IOC（inversion of control）控制反转模式；控制反转是将组件间的依赖关系从程序内部提到外部来管理；
 *DI（dependency injection）依赖注入模式；依赖注入是指将组件的依赖通过外部以参数或其他形式注入；
 *两个说法本质上是一个意思。
 * 通俗点：就是
 * 把类里面其它类的new操作提取到外面，把new出来的实例作为参数传进来
 */

class A{
    public function __construct()
    {
        echo 'A class';
    }
}
class B{
    protected $a;
    function __construct()
    {
        $this->a = new A();//这里产生了依赖，依赖了A类
    }
}
/**上面是未作处理的代码，下面做处理 */
//外面实例化A
$a = new A();
class B2{
    protected $a;
    function __construct(A $a)
    {
        $this->a = $a;
    }
    public function action()
    {
        echo 'B action';
    }
}
// var_dump((new B2($a)));

/**此时就实现了控制反转(IOC)，而 __construct(A $a) 这样传参数 称为依赖注入(DI) */
/**
 * 如果 B2类,依赖的类很多
    $e = new E();
    $d = new D($e);
    $c = new C($d);
    $app = new B2($c);
    
 * ，每个依赖的类都手动new就麻烦，所以需要一个容器类帮忙自动new并传参；
 * 
 */
/**
 * 简易容器类
 * 实例化依赖的类
 */
class Container1{
    public $bindings = [];

    public function bind($key,Closure $value)
    {
        $this->bindings[$key] = $value;
    }

    public function make($key)
    {
        $newFn =  $this->bindings[$key];
        return @$newFn();//低版本的php会报warning
    }
}

$app = new Container1();//实例化容器
//绑定a类实例化操作
$app->bind('a',function()
{
    return new A();
});
//绑定b类实例化操作，并调用依赖类 a的实例化操作
$app->bind('b2',function() use($app)
{
    return new B2($app->make('a'));
});

// $b2 = $app->make('b');
// $b2->action();
/*实现了简易容器类，容器类中有两个方法，bind和make，一个是绑定操作，一个是实例化操作。
 *将每一个需要使用到的类使用关键字绑定到容器类中去，但是每一个类仍然需要手动去实例化，
 *这里引入了闭包函数，主要作用是在调用的时候才真正去实例化，而如果仅仅是绑定了一个类，是不会实例化这个类的。
 */
/**在简易容器类的基础上继续升级优化 */

/**
 * 通过php反射类 ReflectionClass，实现自动实例化操作
 * 
*/

    /**
     * 反射类
     *
     * @param string|object $className
     * @param array $params
     * @return void
     */
    function reflectionClass($className,array $params=[])
    {
       $reflection = new ReflectionClass($className);
       // isInstantiable() 方法判断类是否可以实例化
       $isInstantiable = $reflection->isInstantiable();
       if($isInstantiable){
           // getConstructor() 方法获取类的构造函数，为NULL没有构造函数
           $constructor = $reflection->getConstructor();
           if(is_null($constructor)){
               // 没有构造函数直接实例化对象返回
                return $reflection->newInstance();
           }else{
               // 有构造函数
               $conParams = $constructor->getParameters();
               if(empty($conParams)){
                  // 构造函数没有参数，直接实例化对象返回
                 return $reflection->newInstance(); 
               }else{
                   // 构造函数有参数，将$arams传入实例化对象返回
                   return $reflection->newInstanceArgs($params);
               }
           }
       }
       return null;
    }


// $a = reflectionClass('A');
// var_dump($a instanceof A);//true
/**
 * 引入反射类，他的作用是可以实例化一个类，和new操作一样。但是实例化一个类所需要的参数，他都能自动检测出来。
 * 并且能够检测出来这个参数是不是一个继承了接口的类。上面说一个类依赖另一个类，然后将另一个类作为参数注入，
 * 这个反射能够检测出一个类实例化的时候需要什么样的类，好像有点眉目了是吧。
 */
/**********把反射功能结合到容器类中************* */
class Container2{
    public $bindings = [];

    /**
     * 绑定
     *
     * @param  $key
     * @param mixed $value
     * @return void
     */
    public function bind($key,$value)
    {
        if(!$value instanceof Closure){
            $this->bindings[$key] = $this->getClosure($value);
        }else{
            $this->bindings[$key] = $value;
        }
    }

    /**
     * 创建实例
     *
     * @param string $key
     * @return mixed
     */
    public function make($key)
    {
        if(isset($this->bindings[$key])){
            return $this->build($this->bindings[$key]);
        }
        return $this->build($key);
    }

    /**
     * 包装成闭包
     *
     * @param mixed $value
     * @return Closure
     */
    protected function getClosure($value)
    {
        return function() use($value){
            return $this->build($value);
        };
    }

    /**
     * 通过反射实例化类
     *
     * @param mixed $value
     * @return object|null
     */
    protected  function build($value)
    {
        //如果是闭包函数直接执行并返回结果
        if($value instanceof Closure){
            return $value();
        }
        //实例化反射类
        $reflection = new ReflectionClass($value);
        // isInstantiable() 方法判断类是否可以实例化
        $isInstantiable = $reflection->isInstantiable();
        if($isInstantiable){
            // getConstructor() 方法获取类的构造函数，为NULL没有构造函数
            $constructor = $reflection->getConstructor();
            if(is_null($constructor)){
                // 没有构造函数直接实例化对象返回
                return $reflection->newInstance();
            }else{
                // 有构造函数
                $params = $constructor->getParameters();
                if(empty($params)){
                    // 构造函数没有参数，直接实例化对象返回
                    return $reflection->newInstance();
                }else{
                    // 构造函数有参数
                    $dependencies = [];
                    foreach($params as $param){
                        $dependency = $param->getClass();//获取参数(依赖类)
                        if(is_null($dependency)){
                             // 构造函数参数不为class，返回NULL
                             $dependencies[] = NULL;
                        }else{
                            // 类存在创建类实例
                            $dependencies[] = $this->make($dependency->name);
                        }
                    }
                    return $reflection->newInstanceArgs($dependencies);
                }
            }
        }
        return null;
    }
}

$app2 = new Container2();
$app2->bind('b2','B2');
$b2 = $app2->make('b2');
$b2->action();