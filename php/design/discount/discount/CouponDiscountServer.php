<?php
class CouponDiscountServer{
    //所有打折服务
    public  $map = [];

    /**
     * 创建对象
     *
     * @param mixed $type
     * @param double $typeMax
     * @return void
     */
    public  function create($type)
    {
        return new $this->map[$type];
    }

    /**
     * 添加打折服务
     *
     * @param mixed $key
     * @param string $server
     * @return void
     */
    public function add($key,$server)
    {
        if(isset($this->map[$key])){
            throw new Exception('key值: “'.$key.'” 已存在!');
        }
        $this->map[$key] = $server;
    }

    /**
     * 移除打折服务
     *
     * @param mixed $key
     * @return void
     */
    public function remove($key)
    {
        unset($this->map[$key]);
    }

    /**
     * 执行打折
     *
     * @param mixed $type
     * @param double $typeContent
     * @param double $price
     * @return double
     */
    public function calc($type,$typeContent,$price)
    {
       $obj = new $this->map[$type];
       $check = true;
       //如果存在条件要求，执行条件判断
       if(method_exists($obj,'check')){
           $check = $obj->check($price);
       }
       //通过
       if($check){
           return $obj->discountAmount($typeContent,$price);
       }else{
           return $price;
       }
    }
}