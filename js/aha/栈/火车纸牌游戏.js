/*
 * @Author: Brightness
 * @Date: 2021-09-07 13:38:37
 * @LastEditors: Brightness
 * @LastEditTime: 2021-09-08 13:43:54
 * @Description: 队列 与 栈 的使用 
 */
/*
将一副扑克牌平均分成两份，每人拿一份。A拿出手中的第一张扑克牌放在桌上，然后B也拿出手中的第一张扑克牌，
并放在A刚打出的扑克牌的上面，两人交替出牌。出牌时，如果某人打出的牌与桌上某张牌的牌面相同，
即可将两张相同的牌及其中间所夹的牌全部取走(包括匹配的牌)，并依次放到自己手中牌的末尾。当任意一人
手中的牌全部出完时，游戏结束，对手获胜。
 */
/*
分析:这个游戏有哪几种操作,分别是出牌和赢牌,这恰好对应队列的两个操作，出牌就是出队，赢牌就是入队。
而桌子就是一个栈，每打出一张牌放到桌上就相当于入栈，牌从桌上拿走，这就相当于出栈。
所以需要队列A，队列B和栈。这里我们做一个约定，小哼和小哈手中牌的牌面只有 1~9。

 */
//队列类
class Queue {
    constructor() {
        this.data = []; //队列中的数据
        this.head = 0; //头部指针
        this.tail = 0; //尾部指针
    }

    //入队
    enqueue(num) {
        this.data[this.tail] = num;
        this.tail++;
    }

    //出队
    dequeue() {
        let num = this.data[this.head];
        this.head++;
        return num;
    }

    //队列空了，head>=tail
    isNull() {
        return this.head >= this.tail;
    }

    //输出当前
    all(){
        let res = [],t;
        t = this.dequeue();
        while (t) {
            res.push(t);
            t = this.dequeue();
        }
        return res;
    }
}

//栈类
class StacK {
    constructor() {
        this.data = []; //因为只有 9 种不同的牌面,数组长度最大为10
        this.top = 0;
    }

    //入栈
    enstack(num) {
        this.data[this.top] = num;
        this.top++;
    }

    //出栈
    destack() {
        let num = this.data[this.top - 1];
        this.top--;
        return num;
    }
    //输出当前
    all(){
        let res=[],t;
        t = this.destack();
        while (t) {
            res.push(t);
            t = this.destack();
        }
        return res;
    }
}
//创建队列和栈
let qA = new Queue();
let qB = new Queue();
let s = new StacK();

/*发牌,要求数量相同，平均分配*/
qA.data = [2, 4, 1, 2, 5, 6];
qA.tail = 6;
qB.data = [3, 1, 3, 5, 6, 4];
qB.tail = 6;

/*游戏开始*/
let p, //出的牌
    t, //临时存储
    book = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0] //桌上存在的牌，下标表示牌，值表示牌的个数，如[0,1,0,1,0,0,0,0,0,0]，1牌在做桌上,3牌在做桌上
;
while (!qA.isNull() && !qB.isNull()) {
    //A出牌
    p = qA.dequeue();
    //判断A是否赢牌
    if (book[p] == 0) { //否
        //放在桌面
        s.enstack(p);
        //标记桌上现在已经有牌面为p的牌
        book[p] = 1;
    } else { //是
        //紧接着把打出的牌放到手中牌的末尾
        qA.enqueue(p);
        //把桌上可以赢得的牌依次放到手中牌的末尾,不包括匹配的牌
        t = s.destack();
        while (t != p) {
            //取消标记
            book[t] = 0;
            //依次放入队尾
            qA.enqueue(t);
            t = s.destack();
        }
        //把匹配的牌,也放到A的牌末尾,并取消标记
        book[t] = 0;
        qA.enqueue(t);
    }
    /******************************* */
    //B出牌
    p = qB.dequeue();
    //判断A是否赢牌
    if (book[p] == 0) { //否
        //放在桌面
        s.enstack(p);
        //标记桌上现在已经有牌面为p的牌
        book[p] = 1;
    } else { //是
        //紧接着把打出的牌放到手中牌的末尾
        qB.enqueue(p);
        //把桌上可以赢得的牌依次放到手中牌的末尾,不包括匹配的牌
        t = s.destack();
        while (t != p) {
            //取消标记
            book[t] = 0;
            //依次放入队尾
            qB.enqueue(t);
            t = s.destack();
        }
        //把匹配的牌,也放到B的牌末尾,并取消标记
        book[t] = 0;
        qB.enqueue(t);
    }

}
/*比赛结束*/
if(qA.isNull()){
    console.log('B 赢!');
}else if(qB.isNull()){
    console.log('A 赢!');
}else{
    console.log('异常');
}

console.log('A牌');
console.log(qA.all());


console.log('B牌');
console.log(qB.all());


console.log('桌面牌');
console.log(s.all());

// console.log('A=>',qA);
// console.log('B=>',qB);
// console.log('s=>',s);
// console.log('book=>',book);
