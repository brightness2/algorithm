<?php
/**
 * 接口
 */
interface ICouponDiscount{

    /**
     * 计算
     *
     * @param double $typeContent 券内容(x元或 n折)
     * @param double $price 原价
     * @return double
     */
    public function discountAmount($typeContent,$price);

}