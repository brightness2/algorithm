<?php
/*
 * @Author: Brightness
 * @Date: 2021-11-03 10:48:10
 * @LastEditors: Brightness
 * @LastEditTime: 2021-11-03 10:48:32
 * @Description:  IOC 容器
 */

class Container{
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