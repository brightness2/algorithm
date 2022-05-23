<?php
/**
 * N元购
 */
class NYCouponDiscount implements ICouponDiscount{

    public static $key = 4;
    /**
     * 计算
     *
     * @param double $typeContent 券内容(n折)
     * @param double $price 原价
     * @return double
     */
    public function discountAmount($typeContent,$price)
    {
        return $typeContent;
    }
}