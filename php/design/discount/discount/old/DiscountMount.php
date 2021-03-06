<?php
class DiscountMount{

    /**
     * 折扣计算
     *
     * @param int $type
     * @param double $Price 原价
     * @param double $typePrice 券内容(x元或 n折)
     * @param double $typeMax 满减要求价格
     * @return double
     */
    function calc($type,$price,$typeContent,$typeMax=0)
    {
        //1、直减券
        if(1 === $type){
          return (new ZJCouponDiscount())->discountAmount($typeContent,$price);
        }
        //2、满减券
        if(2 === $type){
          return (new MJCouponDiscount($typeMax))->discountAmount($typeContent,$price);
        }
        //3、折扣券
        if(3 === $type){
          return (new ZKCouponDiscount())->discountAmount($typeContent,$price);
        }
        //4、n元购
        if(4 === $type){
           return (new NYCouponDiscount())->discountAmount($typeContent,$price);
        }
        //5、不符合规则，按原价
        return $price;
    }
}