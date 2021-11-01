<?php
/*
 * @Author: Brightness
 * @Date: 2021-11-01 09:43:05
 * @LastEditors: Brightness
 * @LastEditTime: 2021-11-01 10:16:45
 * @Description:  单例模式
 */

 /*******常用于DB类******** */

class S{

}
$s1 = new S();
$s2 = new S();
// var_dump($s1 === $s2) ;//false
$s3 = $s1;
// var_dump($s1 === $s3);//true
//所以控制类类只能进行一次new就能实现单例，而控制关键在于类的访问权限，private,final 防止继承后修改，禁止clone

 class  Single{
    protected static $instance;
    final private function __construct()
    {
        
    }

    public static function getInstance()
    {
        if(self::$instance === null){
            self::$instance = new self();
        }
        return self::$instance;
        
    }

    //封锁clone
    final protected function __clone()
    {
        
    }
}

$sin1 = Single::getInstance();
$sin2 = Single::getInstance();

var_dump($sin1 === $sin2);//true