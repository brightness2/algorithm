<?php
/*
 * @Author: Brightness
 * @Date: 2021-10-18 16:50:00
 * @LastEditors: Brightness
 * @LastEditTime: 2021-10-18 16:55:10
 * @Description:  队列 先进先出的数据结构
 */

/***********php标准库中的队列**************** */
$queue = new SplQueue();
$queue->enqueue(1);
$queue->enqueue(2);
echo $queue->dequeue();
echo '<br/>';
echo $queue->dequeue();
