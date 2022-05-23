<?php
/**
 * 直减计算
 */
class ZJCouponDiscount implements ICouponDiscount{

    public static $key = 1;

    /**
     * 计算
     *
     * @param double $typeContent 券内容(x元)
     * @param double $price 原价
     * @return double
     */
    public function discountAmount($typeContent,$price)
    {
        return $price - $typeContent;
    }
}