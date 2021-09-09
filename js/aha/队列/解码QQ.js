/*
 * @Author: Brightness
 * @Date: 2021-09-06 17:11:35
 * @LastEditors: Brightness
 * @LastEditTime: 2021-09-07 09:55:13
 * @Description:  队列练习
 */
/*
刚开始这串数是“6 3 1 7 5 8 9 2 4”，首先删除 6 并将 3 放到
这串数的末尾，这串数更新为“1 7 5 8 9 2 4 3”。接下来删除 1 并将 7 放到末尾，即更新为
“5 8 9 2 4 3 7”。以此类推，最后一个数也删除，记录被删除的数字
 */

/**实现一 使用数组原有方法*/
function fun(arr=[]){
    let del,sec,len = arr.length;
    let res = [];
    for (let index = 0; index < len; index++) {
        del = arr.shift();
        res.push(del);
        sec = arr.shift();
        arr.push(sec);
    }
    return res;
}
// let start = new Date().getTime();
let res = fun([6,3,1,7,5,8,9,2,4]);
console.log(res);//[6, 1, 5, 9, 4,7, 2, 8, 3]
// let end = new Date().getTime();
// console.log(end - start);

/*方法二 ,速度比方法一快10倍*/
/*
引入两个整型变量 head 和 tail。head 用来记录队列的队首（即第一位），
tail 用来记录队列的队尾（即最后一位）的下一个位置。为什么 tail 不直接记
录队尾，却要记录队尾的下一个位置呢？这是因为当队列中只剩下一个元素时，队首和队尾
重合会带来一些麻烦。我们这里规定队首和队尾重合时，队列为空。
So:
    h                 t
    6 1 5 9 4 7 2 8 3 空
    ----------------------
    在队首删除一个数的操作是 head++
      h               t
    6 1 5 9 4 7 2 8 3 空
    --------------------
    移动第二个数到后面的操作是 q[tail]=1;tail++,head++
        h               t
    6 1 5 9 4 7 2 8 3 1 空
    --------直至队首，队尾指针重合，表示数据为空，结束操作，即head == tail----------
*/
function fun2(arr=[]){
    let head = 0,tail = arr.length;
    let res = [];
    while (head < tail) {
        //删除第一个数
        res.push(arr[head]);
        //队首指针移动
        head++;
        //移动第二个数到末尾
        arr[tail] = arr[head];
        //队首,队尾指针移动
        head++;
        tail++;
    }
    return res;
}
// let start2 = new Date().getTime();
let res2 = fun2([6,3,1,7,5,8,9,2,4]);
console.log(res2);//[6, 1, 5, 9, 4,7, 2, 8, 3]
// let end2 = new Date().getTime();
// console.log(end2-start2);