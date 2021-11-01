<?php
/*
 * @Author: Brightness
 * @Date: 2021-11-01 16:19:12
 * @LastEditors: Brightness
 * @LastEditTime: 2021-11-01 16:58:52
 * @Description:  桥接模式
 */

/********发送email，手机信息;都分普通信息和紧急信息*********** */

interface msg{
    public function send($to,$content);
}



class CommonEmail implements msg{
    public function send($to,$content)
    {
        echo 'email：',$to,'内容：'.$content;
    }
}

class CommonPhone implements msg{
    public function send($to,$content)
    {
        echo '手机：',$to,'内容：'.$content;
    }
}

class WarnEmail implements msg{
    public function send($to,$content)
    {
        echo 'email：',$to,'紧急内容：'.$content;
    }
}

class WarnPhone implements msg{
    public function send($to,$content)
    {
        echo '手机：',$to,'紧急内容：'.$content;
    }
}
/***类太多了,m*n个，桥接模式解决***/

abstract class Info {
    protected $_send = null;

    public function __construct($send)
    {
        $this->send = $send;
    }

   abstract public function msg($content);
       

    public function send($to,$content){
        $data = $this->msg($content);
        $this->send->send($to,$data);
    }
}


class Email {
    public function send($to,$content){
        echo 'email：',$to,'内容：'.$content;
    }

}

class Phone {
    public function send($to,$content){
        echo 'email：',$to,'内容：'.$content;
    }
}

class Common extends Info{
    public function msg($content)
    {
        return $content;
    }
}

class Warn extends Info{
    public function msg($content)
    {
        return '紧急'.$content;
    } 
}



$common = new Warn(new Email());
$common->send('Brightness','test');

//现在是 m+n个类