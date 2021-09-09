/*
 * @Author: Brightness
 * @Date: 2021-09-07 10:24:09
 * @LastEditors: Brightness
 * @LastEditTime: 2021-09-07 11:22:56
 * @Description:  栈练习
 */
/*
判断字符串是否为回文字符串
如果一个字符串是回文的话，那么它必须是中间对称的，我们需要求中点，即：mid=len/2-1;
将 mid 之前的字符全部入栈，栈中的字符依次出栈mid 之后的字符一一匹配
 */
function fun(str = ''){
    let len = str.length;
    let mid =Math.floor( len/2-1);
    let top = 0,next;
    let arr = [];
    //将前一半入栈
    for (let i = 0; i <= mid; i++) {
        arr[top++] = str[i];
    }
    //判断字符串的长度是奇数还是偶数，并找出需要进行字符匹配的起始下标
    if(len%2==0){
        next=mid+1; 
    }
    else {
        next=mid+2; 
    }
    
    for (let i = next; i <=len-1; i++) {
        if(str[i]!=arr[top-1]){
            break; 
        }
        top--; 
    }
    
    //如果top的值为0，则说明栈内所有的字符都被一一匹配了
    if(top == 0){
        return true;
    }else{
        return false;
    }

}

let res = fun('ahaha');
console.log(res);
