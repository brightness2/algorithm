<?php
/**
 * 满减计算
 */
class MJCouponDiscount implements ICouponDiscount,Condition{


    private $typeMax = 80;

    public static $key = 2;

    /**
     * 初始化时，传入满减要求价格
     *
     * @param double $typeMax
     */
    // function __construct($typeMax)
    // {
    //     $this->typeMax = $typeMax;
    // }
    
    /**
     * 计算
     *
     * @param double $typeContent 券内容(x元)
     * @param double $price 原价
     * @return double
     */
    public function discountAmount($typeContent,$price)
    {
        if($this->typeMax <= $price){
            return $price - $typeContent;
        }else{
            return $price;
        }
    }

    public function check($price)
    {
       return $price >= $this->typeMax;
    }
}