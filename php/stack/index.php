<?php
/*
 * @Author: Brightness
 * @Date: 2021-10-18 16:44:01
 * @LastEditors: Brightness
 * @LastEditTime: 2021-10-18 16:49:10
 * @Description:  栈，先进后出的数据结构
 */

/********php标准库中的栈********** */
$stack = new SplStack();
$stack->push(1);
$stack->push(2);
echo $stack->pop(); //2
echo '<br/>';
echo $stack->pop();//1
