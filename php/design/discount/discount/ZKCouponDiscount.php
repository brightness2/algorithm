<?php
/**
 * 折扣计算
 */
class ZKCouponDiscount implements ICouponDiscount{

    public static $key = 3;

    /**
     * 计算
     *
     * @param double $typeContent 券内容(n折)
     * @param double $price 原价
     * @return double
     */
    public function discountAmount($typeContent,$price)
    {
        return $price * ($typeContent/10);
    }
}