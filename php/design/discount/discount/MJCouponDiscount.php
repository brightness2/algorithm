<?php
/**
 * 满减计算
 */
class MJCouponDiscount implements ICouponDiscount,ICondition{


    private $typeMax = 80;//满减要求金额

    public static $key = 2;
    
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

    //条件判断
    public function check($price)
    {
       return $price >= $this->typeMax;
    }
}