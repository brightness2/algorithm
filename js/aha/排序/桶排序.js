/*
 * @Author: Brightness
 * @Date: 2021-09-06 09:12:54
 * @LastEditors: Brightness
 * @LastEditTime: 2021-09-06 15:33:03
 * @Description:  桶排序
 */
//简单版
/*************0~10 的整数排序************** */
function  fun(nums=[]){
    if(!Array.isArray(nums)){
        return;
    }
    //需要定义这个count变量，也就是桶;所以可以看出很浪费空间
    let count = [0,0,0,0,0,0,0,0,0,0,0];//用于统计数字出现次数，数字与下标对应
    let res = [];
    nums.forEach(num => {
        count[num]++;//数字出现一次加一
    });
    console.log('统计结果：',count);
    for (let i = 10; i >=0; i--) {
        for (let j = 0; j < count[i]; j++) {
           res.push(i);
        }
    }
    console.log('排序结果:',res);
    return res;
}

let a = [5,3,2,5,8];
fun(a);
