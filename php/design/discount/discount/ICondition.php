<?php
interface ICondition{

    /**
     * 条件判断
     *
     * @param double $price
     * @return bool
     */
    public function check($price);
}