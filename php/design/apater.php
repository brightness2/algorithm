<?php
/*
 * @Author: Brightness
 * @Date: 2021-11-01 15:58:54
 * @LastEditors: Brightness
 * @LastEditTime: 2021-11-01 16:17:17
 * @Description:  适配器模式
 */

 /******比如返回适合的数据格式********* */

 /****服务端返回今天天气 */
 class Today{
     public static function show()
     {
         $arr = ['tep'=>'28度','wind'=>'一级','sun'=>'sunny'];
         return serialize($arr);
     }
 }


 /**客户端1 获取serialize格式的数据** */

 $data = unserialize(Today::show());
//  print_r($data);

  /**客户端2 获取json格式的数据** */
// $data = json_decode(Today::show());
// var_dump($data);//null,数据格式不对所以为空

//为了不影响客户端1的代码，实现客户端2格式输出，通过适配器模式实现
/**
 * 其实就是继承父类把父类的数据进行处理
 */
class ApaterToday extends Today{
    public static function show()
    {
        $data = parent::show();
        return json_encode(unserialize($data));
    }
}

/**客户端2 获取json格式的数据** */
$data = json_decode(ApaterToday::show(),true);
 print_r($data);
