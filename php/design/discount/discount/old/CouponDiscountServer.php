<?php
class CouponDiscountServer{

    // public  $map = [
    //     ZJCouponDiscount::class,
    //     MJCouponDiscount::class,
    //     ZKCouponDiscount::class,
    //     NYCouponDiscount::class,
    // ];
    public  $map = [];

    public  function create($type,$typeMax=0)
    {
        return new $this->map[$type]($typeMax);
    }

    public function add($key,$server)
    {
        $this->map[$key] = $server;
    }

    public function remove($key)
    {
        unset($this->map[$key]);
    }

    
    // public function calc($type,$typeContent,$price,$typeMax=0)
    // {
    //     return $this->create($type,$typeMax)->discountAmount($typeContent,$price);
    // }

    public function calc($type,$typeContent,$price)
    {
       $obj = new $this->map[$type];
       $check = true;
       if(method_exists($obj,'check')){
           $check = $obj->check($price);
       }
       if($check){
           return $obj->discountAmount($typeContent,$price);
       }else{
           return $price;
       }
    }
}