<?php
/*
 * @Author: Brightness
 * @Date: 2021-11-01 13:50:06
 * @LastEditors: Brightness
 * @LastEditTime: 2021-11-01 15:49:05
 * @Description:  装饰器模式
 */

 /*********文章处理************* */
/**
 * 文章类
 */
 class Article{
     protected $ctx;
     public function __construct($ctx)
     {
         $this->ctx = $ctx;
     }

     public function show()
     {
         return $this->ctx;
     }
 }

 $a = new Article('test');//编写一篇文章
 $res = $a->show();//展示
//  echo $res;


 /**********此时要求颜色为红色************** */
 //为了符合开闭原则，所以通过继承来实现
 class ColorArticle extends Article{
     public function show()
     {
         return  '<div style="color:red;">'.$this->ctx.'</div>';
     }
 }

 $a = new ColorArticle('test');//编写一篇文章
 $res = $a->show();//展示
//  echo $res;
 //如果要继续增加字体，字号，背景 。。。,等等呢？要继续继承?

 /************所以用装饰器模式实现*************** */
/**
 * 扩展接口,装饰器和被装饰的类都要实现这个接口
 */
interface Component{
    public function operation();
}
/**
 * 被装饰的类，文章类
 */
class BaseArticl implements Component{
    protected $ctx;
    public function __construct($ctx)
    {
        $this->ctx = $ctx;
    }
    public function operation()
    {
        return $this->ctx;
    }
}

/**
 * 装饰器抽象类，规定需要实现的方法
 */
abstract class Decorator implements Component{

    protected $_component;

    public function __construct(Component $component)
    {
        $this->_component = $component;
    }

    public function operation()
    {
      return  $this->_component->operation();
    }

}

/**
 * 具体装饰类，颜色装饰类
 */
class ColorDecorator extends Decorator{
    public function operation()
    {
        $res = $this->_component->operation();//获取数据
        return '<div style="color:red;">'.$res.'</div>';//装饰修改
    }
}

/**
 * 具体装饰类，字体装饰类
 */
class FontDecorator extends Decorator{
    public function operation()
    {
        $res = $this->_component->operation();
        return '<div style="font-size:30px;">'.$res.'</div>';
    }
}

$article = new FontDecorator(new ColorDecorator( new BaseArticl('test') ));//继承嵌套消失了，实例化嵌套增加了
$res = $article->operation();
echo $res;
//如果不需要颜色装饰
$article = new FontDecorator(new BaseArticl('test'));
$res = $article->operation();
echo $res;

//如果不需要字体装饰
$article = new ColorDecorator( new BaseArticl('test'));
$res = $article->operation();
echo $res;

/**********增加背景装饰 ******** */
class BgDecorator extends Decorator{
    public function operation()
    {
        $res = $this->_component->operation();
        return '<div style="background:#aaa;">'.$res.'</div>';
    }
}
//使用背景装饰
$article = new BgDecorator( new BaseArticl('test'));
$res = $article->operation();
echo $res;