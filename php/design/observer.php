<?php
/*
 * @Author: Brightness
 * @Date: 2021-11-01 10:18:13
 * @LastEditors: Brightness
 * @LastEditTime: 2021-11-01 11:54:22
 * @Description:  观察着模式
 */

 /**
  * 
  */

/**过程式 */
$style = 'male';//male or female

class Bg{
  public  $color;

}
class Content{
    public $ctx;
}
$bg = new Bg();

$content = new Content();
if($style == 'male'){
    $bg->color = '蓝色';
    $content->ctx = '汽车';
}else if($style == 'female'){
    $bg->color = '粉色';
    $content->ctx = '减肥';
    
}
// var_dump($bg,$content);
//$bg,$content 根据$style的变化进行改变
/*******如果要增加border 根据style变化，又要修改代码了，不符合开闭原则********* */

/****可以通过观察者模式实现，style 是被观察者，bg，content，是观察者 */

//php 提供了观察者和被观察者的接口

class Style implements SplSubject{
    protected $observers;
    public $type = 'male';
    public function __construct()
    {
        $this->observers = new SplObjectStorage;
        // $this->type = $type;
    }
    public function attach(SplObserver $observer)
    {
        $this->observers->attach($observer);
    }

    public function detach(SplObserver $observer)
    {
        $this->observers->detach($observer);
    }

    public function notify()
    {
       $this->observers->rewind();
       while($this->observers->valid()){
            //    $index = $this->observers->key();
            //    $data = $this->observers->getInfo();
            $obj = $this->observers->current();
            $obj->update($this);
           $this->observers->next();
       }
    }
}

class Bg2 implements SplObserver{
    public $color = '';
    public function update(SplSubject $subject)
    {
        if($subject->type == 'male'){
            $this->color = '蓝色';
        }else{
            $this->color = '粉色';

        }
    }
}

class Content2 implements SplObserver{
    public $ctx = '';
    public function update(SplSubject $subject)
    {
        if($subject->type == 'male'){
            $this->ctx = '汽车';
        }else{
            $this->ctx = '减肥';
        }
    }
}

$sub = new Style();
$bg2 = new Bg2();
$content2 = new Content2();

$sub->attach($bg2);
$sub->attach($content2);

$sub->notify();//发送通知
var_dump($bg2,$content2);
//object(Bg2)#5 (1) { ["color"]=> string(6) "蓝色" } object(Content2)#6 (1) { ["ctx"]=> string(6) "汽车" } 
echo '<br/>';
$sub->type = 'female';//修改类型
$sub->notify();//发送通知
// var_dump($bg2,$content2);
//object(Bg2)#5 (1) { ["color"]=> string(6) "粉色" } object(Content2)#6 (1) { ["ctx"]=> string(6) "减肥" } 

/**********扩展border 观察者************ */

class Border implements SplObserver{
    public $width='0px';
    public function update(SplSubject $subject)
    {
        if($subject->type == 'male'){
            $this->width = '10px';
        }else{
            $this->width = '20px';
        }
    }
}
$border = new Border();
$sub->attach($border);
$sub->notify();
echo '<br/>';
var_dump($border);
//object(Border)#7 (1) { ["width"]=> string(4) "20px" } 