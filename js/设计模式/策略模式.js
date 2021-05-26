/*
 * @Author: Brightness
 * @Date: 2021-05-26 14:26:52
 * @LastEditors: Brightness
 * @LastEditTime: 2021-05-26 15:07:06
 * @Description:策略模式
 */
/**
 * 定义一系列的算法，把他们一个个封装起来，并且使它们可以互相替换。
 * 策略模式目的是将算法的使用与算法的实现进行分离。
 * 使用场景:表单验证，计算分级提成等，多if的面条式代码
 */
//举例，销售额3000内提成2%，大于3000提成4%，大于5000提成8%
//正常代码
function pushMoney(number) {
  if (number > 5000) {
    return (number = number * 0.08);
  }
  if (number > 3000) {
    return (number = number * 0.04);
  }
  if (number <= 3000) {
    return (number = number * 0.02);
  }
}
// console.log(pushMoney(5100));
// console.log(pushMoney(4000));
// console.log(pushMoney(2000));

//使用策略模式，方便扩展
let levels = {
  S: (number) => {
    return number * 0.08;
  },
  A: (number) => {
    return number * 0.04;
  },
  B: (number) => {
    return number * 0.02;
  },
};

function bonus(level, number) {
  return levels[level](number);
}

// console.log(bonus("S", 5100));
// console.log(bonus("A", 4000));
// console.log(bonus("B", 2000));
