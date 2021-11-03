<?php
//采用PSR-0方式来定义namespace的命名
/**
 *  [1]命名空间必须与绝对路径一致
 *  [2]类名首字母必须大写
 *  [3]除去入口文件外，其他“.php”必须只有一个类
 *  [4]php类文件必须自动载入，不采用include等
 *  [5]单一入口 
 */
namespace test;
class A{
    function __construct()
    {
        echo 'test A';
    }
}