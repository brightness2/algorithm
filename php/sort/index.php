<?php
/*
 * @Author: Brightness
 * @Date: 2021-10-18 17:05:49
 * @LastEditors: Brightness
 * @LastEditTime: 2021-10-19 14:23:41
 * @Description:  常见排序算法
 */

$arr = [22, 10, 60, 7];
/****** 冒泡算法 时间复杂度 n*2 稳定排序******** */

/**
 * 冒泡算法
 * 从大到小
 * 两两比较，往上冒
 * @param array $a
 * @return array
 */
function bub($a)
{
    $len = count($a);
    for ($i = 1; $i < $len; $i++) {
        for ($j = 0; $j < $len - $i; $j++) {
            if ($a[$j] < $a[$j + 1]) {
                $t  = $a[$j];
                $a[$j] = $a[$j + 1];
                $a[$j + 1] = $t;
            }
        }
    }
    return  $a;
}

/**
 * 冒泡算法
 * 从小到大
 * @param array $a
 * @return array
 */
function bub2($a)
{
    $len = count($a);
    for ($i = 1; $i < $len; $i++) {
        for ($j = 0; $j < $len - $i; $j++) {
            if ($a[$j] > $a[$j + 1]) { //只是大于号小于号的不同
                $t = $a[$j];
                $a[$j] = $a[$j + 1];
                $a[$j + 1] = $t;
            }
        }
    }

    return $a;
}
/****** 选择排序 时间复杂度 n*2 ，不稳定排序，比冒泡排序比较次数少******** */

/**
 * 选择排序
 *
 * @param array $a
 * @return array
 */
function sel($a)
{
    $len = count($a);
    for ($i = 0; $i < $len; $i++) {
        $minIndex = $i;
        for ($j = $i + 1; $j < $len; $j++) { //寻找最小值，并记录其位置
            if ($a[$j] < $a[$minIndex]) {
                $minIndex = $j;
            }
        }
        //把最小值记录在未排序的位置
        $t = $a[$i];
        $a[$i] = $a[$minIndex];
        $a[$minIndex] = $t;
    }
    return $a;
}
/****** 插入排序 时间复杂度n*2,比冒泡快  ，稳定排序，适合数据量小于一万******** */

/**
 * 插入排序 
 *
 * @param array $a
 * @return array
 */
function ins($a)
{
    $len = count($a);
    for ($i = 1; $i < $len; $i++) {
        $t = $a[$i]; // “提取” 元素 X,可以看成x位置为空了，腾出了可移动空间
        $j = $i - 1; //已排序的范围
        //遍历已排序的数据，把大于x的数据往前移
        while ($j >= 0 and $a[$j] > $t) {
            $a[$j + 1] = $a[$j];
            $j = $j - 1;
        }
        $a[$j + 1] = $t; //把x插入小于x的前
    }
    return $a;
}
/*********** 快速排序 ************** */
/**
 * 以第一个数为基数，大于基数的放右边，小于基数的放左边；然后两边的数据都递归重复这种操作
 */
/**
 * 快速排序
 *
 * @param array $a
 * @return array
 */
function qui($a)
{
    $len = count($a);
    if ($len <= 1) {
        return $a;
    }
    $middle = $a[0]; //中间值
    $left = array(); // 接收小于中间值
    $right = array(); // 接收大于中间值
    // 循环比较
    for ($i = 1; $i < $len; $i++) {
        if ($middle < $a[$i]) {
            //大于中间值
            $right[] = $a[$i];
        } else {
            $left[] = $a[$i];
        }
    }

    //递归排序划分好的两边
    $left = qui($left);
    $right = qui($right);
    //合并排序后的数据
    return array_merge($left, array($middle), $right);
}

$res = qui($arr);
echo json_encode($res);
