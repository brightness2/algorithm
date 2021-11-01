<?php
/*
 * @Author: Brightness
 * @Date: 2021-11-01 13:35:13
 * @LastEditors: Brightness
 * @LastEditTime: 2021-11-01 13:42:45
 * @Description:  策略模式
 */

/*****比如实现计算器** */

interface Math {
    public function calc();
}

Class MathAdd{
    public function calc($a,$b)
    {
        return $a+$b;
    }
}

Class MathSub{
    public function calc($a,$b)
    {
        return $a-$b;
    }
}

Class MathMut{
    public function calc($a,$b)
    {
        return $a*$b;
    }
}

Class MathDiv{
    public function calc($a,$b)
    {
        return $a/$b;
    }
}

class CMath{
    protected $calc = null;

    public function __construct($type)
    {
        $calc = 'Math'.$type;
        $this->calc = new $calc;
    }

    public function calc($a,$b)
    {
       return $this->calc->calc($a,$b);
    }
}

$c = new CMath('Div');
$res = $c->calc(1,2);
echo $res;
