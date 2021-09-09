/*
 * @Author: Brightness
 * @Date: 2021-09-06 14:21:18
 * @LastEditors: Brightness
 * @LastEditTime: 2021-09-06 16:47:18
 * @Description:  冒泡排序 的时间复杂度是 O(N2)
 */
/***********
 * 冒泡排序的基本思想是：每次比较两个相邻的元素，如果它们的顺序错误就把它们交换过来。时间复杂度高
******************* */
/**
 * 
 * @param {*} nums 
 * @returns 
 */
function maopao(nums=[]) { 
    let n = nums.length;
    let t = 0;
    for (let i = 1; i <= n-1; i++) {///n个数排序，只用进行n-1趟
        for (let j = 0; j <= n - i; j++) {//从第1位开始比较直到最后一个尚未归位的数,到n-i就可以了
            if(nums[j] < nums[j+1]){
                t = nums[j];
                nums[j] = nums[j+1];
                nums[j+1] = t;
            }
        }
    }
    return nums;
}

let a = [6,1,2,7,9,3,4,5,10,8];
a = maopao(a);
console.log(a);



