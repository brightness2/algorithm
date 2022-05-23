<?php
include_once './autoload.php';

/**
 * 折扣计算
 *
 * @param int $type
 * @param double $typePrice 券内容(x元或 n折)
 * @param double $typeMax 满减要求价格
 * @return double
 */
function discountAmount($type,$price,$typeContent,$typeMax=0)
{
    //1、直减券
    if(1 === $type){
        return $price - $typeContent;
    }
    //2、满减券
    if(2 === $type){
        if($typeMax <= $price){
            return $price -$typeContent;
        }
    }
    //3、折扣券
    if(3 === $type){
        return $price * ($typeContent/10);
    }
    //4、n元购
    if(4 === $type){
        return $typeContent;
    }
    //5、不符合规则，按原价
    return $price;
}
/*
//1、直减券
var_dump(discountAmount(1,100,50)).'<br/>';
    

//2、满减券
var_dump(discountAmount(2,100,40,80)).'<br/>';


//3、折扣券
var_dump(discountAmount(3,100,2)).'<br/>';



//4、n元购
var_dump(discountAmount(4,100,40)).'<br/>';



//5、不符合规则，按原价
var_dump(discountAmount(5,100,40)).'<br/>';

echo '<br/>';
*/
/******************* 现在需要把上面的工作转化成策略模式 ********************************************************* */
/*
$obj = new DiscountMount();

//1、直减券
var_dump($obj->calc(1,100,50)).'<br/>';
    

//2、满减券
var_dump($obj->calc(2,100,40,80)).'<br/>';


//3、折扣券
var_dump($obj->calc(3,100,2)).'<br/>';



//4、n元购
var_dump($obj->calc(4,100,40)).'<br/>';



//5、不符合规则，按原价
var_dump($obj->calc(5,100,40)).'<br/>';
*/

/**********使用简单工厂消除if else,不在通过DiscountMount类************ */
/*
$factory = new CouponDiscountServer();

//1、直减券
var_dump($factory->create(0)->discountAmount(50,100)).'<br/>';
    
//2、满减券
var_dump($factory->create(1,80)->discountAmount(40,100)).'<br/>';

//3、折扣券
var_dump($factory->create(2)->discountAmount(2,100)).'<br/>';


//4、n元购
var_dump($factory->create(3)->discountAmount(40,100)).'<br/>';


//5、不符合规则，按原价
var_dump(100).'<br/>';
*/

/*****************改进优化工厂类以及对应的策略类，使其方便扩展************************ */
//注册
$factory = new CouponDiscountServer();

$factory->add(ZJCouponDiscount::$key,ZJCouponDiscount::class);
$factory->add(MJCouponDiscount::$key,MJCouponDiscount::class);
$factory->add(ZKCouponDiscount::$key,ZKCouponDiscount::class);
$factory->add(NYCouponDiscount::$key,NYCouponDiscount::class);
//使用
//1、直减券
var_dump($factory->calc(1,50,100)).'<br/>';
    
//2、满减券
var_dump($factory->calc(2,40,100)).'<br/>';

//3、折扣券
var_dump($factory->calc(3,2,100)).'<br/>';


//4、n元购
var_dump($factory->calc(4,40,100)).'<br/>';


//5、不符合规则，按原价
var_dump(100).'<br/>';
