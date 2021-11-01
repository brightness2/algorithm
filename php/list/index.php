<?php

/*
 * @Author: Brightness
 * @Date: 2021-10-18 16:40:58
 * @LastEditors: Brightness
 * @LastEditTime: 2021-10-28 10:20:21
 * @Description:  链表使用
 */

/**
 * 单向节点
 */
class Node
{
    public $key = null;
    public $value = null;
    public $next = null;

    public function __construct($key, $data)
    {
        $this->key = $key;
        $this->value = $data;
    }
}
/**
 * 单向链表
 */
class singleList
{
    public $head = null;
    public $size = 0;

    /**
     * 追加
     *
     * @param string $data
     * @return void
     */
    public function append($key, $data)
    {
        $newNode = new Node($key, $data);
        if ($this->head == null) {
            $this->head = $newNode;
        } else {
            $currNode = $this->head;
            while ($currNode->next != null) {
                $currNode = $currNode->next;
            }
            $currNode->next = $newNode;
        }
        $this->size++;
        return true;
    }
    /**
     * 在最前插入节点
     */
    public function insertFront($key, $data)
    {
        $newNode = new Node($key, $data);
        $currNode = $this->head;
        $newNode->next = $currNode;
        $this->head = $newNode;
        $this->size++;
        return true;
    }

    /**
     * 在某个节点后插入节点
     */
    public function insert($preKey, $key, $data)
    {
        if ($this->size <= 0) {
            return false;
        }
        $bool = false;
        $currNode = $this->head;
        while ($currNode != null) {
            if ($currNode->key == $preKey) {
                $newNode = new Node($key, $data);
                $next = $currNode->next;
                $newNode->next = $next;
                $currNode->next = $newNode;
                $this->size++;
                $bool = true;
                break;
            }
            $currNode = $currNode->next;
        }
        return $bool;
    }

    /**
     * 遍历
     *
     * @param Closure $call
     * @return void
     */
    public function map(Closure $call)
    {
        $arr = [];
        $currNode = $this->head;
        while ($currNode != null) {
            $arr[] = $call($currNode);
            $currNode = $currNode->next;
        }
        return $arr;
    }
    /**
     * 是否为空
     *
     * @return boolean
     */
    public function isNull()
    {
        return $this->size == 0;
    }

    /**
     * 搜索节点
     *
     * @param string $key
     * @return mixed
     */
    public function get($key)
    {
        if ($this->size <= 0) {
            return null;
        }
        $currNode = $this->head;
        while ($currNode != null) {
            if ($currNode->key == $key) {
                return $currNode->value;
            }
            $currNode = $currNode->next;
        }
    }

    /**
     * 获取长度
     *
     * @return int
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * 删除头部节点
     */
    public function deleteFront()
    {
        if ($this->size <= 0) {
            return false;
        }
        $currNode = $this->head;
        $next = $currNode->next;
        $this->head = $next;
        $this->size--;
        return true;
    }
}

$list = new singleList();
// var_dump($list->isNull());

$list->append('one', ['name' => 'one']);
$list->append('two', ['name' => 'two']);
$list->insertFront('three', ['name' => 'three']);
$list->insert('one', 'four', ['name' => 'four']);
// $list->map(function ($currNode) {
//     echo ($currNode->value['name']);
// });
// var_dump($list->isNull());

// var_dump($list->get('two'));
// echo $list->getSize();

echo json_encode($list);
