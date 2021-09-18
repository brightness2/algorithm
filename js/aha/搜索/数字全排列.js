/*
 * @Author: Brightness
 * @Date: 2021-09-09 15:33:04
 * @LastEditors: Brightness
 * @LastEditTime: 2021-09-17 17:07:08
 * @Description: 深度优先搜索模型,大多搜索算法都可以使用
 */
/*
    1~n ，数字全排列；
    如：1 ，2 ， 3，的全排列 1 2 3 ， 1 3 2 ，2 1 3 ， 2 3 1 ，3 1 2 ， 3 2 1

*/
// let n = 3; //牌的张数
// let a = [];
// let step = 0; //第几个箱子
// let book = [0, 0, 0]; //标记已使用的牌

//第step个箱子处理方法
// for (let i = 1; i <= n; i++) {
//     if(book[i] == 0){//如果牌 i 未使用
//         a[step]=i;//把牌 i 放到 step 箱子中
//         book[i] = 1;//标记 牌 i 已使用
//     }
// }

//那么第step+1个箱子处理方法同上，所有可以把第step个箱子处理方法封装成函数,方便复用，这个函数叫做dfs

// function dfs(step){
//     for (let i = 1; i <= n; i++) {
//         if(book[i] == 0){//如果牌 i 未使用
//             a[step]=i;//把牌 i 放到 step 箱子中
//             book[i] = 1;//标记 牌 i 已使用
//         }
//     }
// }

//处理第step+1个箱子就是 dfs(step+1)
// function dfs(step){
//     for (let i = 1; i <= n; i++) {
//         if(book[i] == 0){//如果牌 i 未使用
//             a[step]=i;//把牌 i 放到 step 箱子中
//             book[i] = 1;//标记 牌 i 已使用
//             /*递归处理*/
//             dfs(step+1);
//             book[i]=0;//这是非常重要的一步，收回牌才能进行下一次
//         }
//     }
// }

//什么时候符合条件呢？其实当 step 等于 n+1时，因为n 个箱子都放好了，直接输入1~n箱子里的数字即可，注意要reutrn，防止死循环

let n = 3; //牌的张数
let a = []; //箱子
let step = 1; //第几个箱子
let book = []; //标记已使用的牌

// 初始化箱子 和 标记
for (let i = 0; i <= n; i++) {
    a.push(0);
    book.push(0);
}

function dfs(step) {
    if (step == n + 1) {
        console.log(a.slice(1)); //因为下标是0开始,所以第一位不要
        return; //返回之前的一步(最近一次调用dfs函数的地方)
    }
    //1~n的牌
    for (let i = 1; i <= n; i++) {
        if (book[i] == 0) {
            //如果牌 i 未使用
            a[step] = i; ////把牌 i 放到 step 箱子中,
            book[i] = 1; //标记 牌 i 已使用
            /*递归处理，到下一个箱子*/
            dfs(step + 1);
            book[i] = 0; //返回到达上一个箱子，这是非常重要的一步，收回箱子中的牌才能进行下一次，
        }
    }
    return;
}
dfs(step);
