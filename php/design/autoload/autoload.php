<?php
/*
 * @Author: Brightness
 * @Date: 2021-11-02 14:46:06
 * @LastEditors: Brightness
 * @LastEditTime: 2021-11-02 15:30:02
 * @Description:  自动加载
 */
/**
 * 主要通过  spl_autoload_register() 函数 实现
 */

define('D_S',DIRECTORY_SEPARATOR);

/**
 * 自动加载类
 */
class AutoLoader{
    public static function autoload($className)
    {
       $fileName = str_replace("\\",D_S,__DIR__."\\".$className.'.php');
       if(is_file($fileName)){
           require_once $fileName;
       }else{
           throw new Exception($fileName.'is not exits');
       }
    }
}

//注册 自动加载类 AutoLoader::autoload 方法
spl_autoload_register("AutoLoader::autoload");

new test\A();

/**
 * 现在大多使用 composer autoload
 */