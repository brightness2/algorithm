/*
 * @Author: Brightness
 * @Date: 2021-06-16 16:54:02
 * @LastEditors: Brightness
 * @LastEditTime: 2021-06-17 09:56:01
 * @Description:
 */
/* 队列：先入先出的数据结构 */

class Node {
  constructor(ele) {
    this.ele = ele;
    this.next = null;
  }
}

class LinkedQueue {
  constructor() {
    this.size = 0;
    this.front = null; //队首指针
    this.rear = null; //队尾指针
  }

  push(ele) {
    let node = new Node(ele),
      temp;

    if (this.size == 0) {
      this.front = node;
    } else {
      temp = this.rear;
      temp.next = node;
    }

    this.rear = node;
    this.size++;
    return true;
  }

  pop() {
    let temp = this.front;
    this.front = this.front.next;
    this.size--;
    temp.next = null;
    return temp;
  }

  getSize() {
    return this.size;
  }

  getFront() {
    return this.front;
  }

  getRear() {
    return this.rear;
  }

  clear() {
    this.front = null;
    this.rear = null;
    this.size = 0;
    return true;
  }
}

let link = new LinkedQueue();
link.push({ a: "a" });
link.push({ b: "b" });
link.push({ a: "a" });
let front = link.getFront();
// console.log(front);
/*
Node {
  ele: { a: 'a' },
  next: Node { ele: { b: 'b' }, next: Node { ele: [Object], next: null } }
}
*/
let rear = link.getRear();
// console.log(rear);//Node { ele: { a: 'a' }, next: null }
let a = link.pop();
// console.log(a); //Node { ele: { a: 'a' }, next: null }
// console.log(link);
let size = link.getSize();
// console.log(size); //2
/* 
LinkedQueue {
  size: 2,
  front: Node { ele: { b: 'b' }, next: Node { ele: [Object], next: null } },
  rear: Node { ele: { a: 'a' }, next: null }
}
*/
link.clear();
// console.log(link); //LinkedQueue { size: 0, front: null, rear: null }

/******************************************************* */
class ArrayQueue {
  constructor() {
    this.arr = [];
  }

  push(ele) {
    this.arr.push(ele);
    return true;
  }

  pop() {
    return this.arr.shift();
  }

  getFront() {
    return this.arr[0];
  }

  getRear() {
    return this.arr[this.arr.length - 1];
  }

  clear() {
    this.arr = [];
  }

  getSize() {
    return this.arr.length;
  }
}

let queue = new ArrayQueue();
queue.push({ a: "a" });
queue.push({ b: "b" });
queue.push({ c: "c" });

let f = queue.getFront();
// console.log(f);//{ a: 'a' }
let r = queue.getRear();
// console.log(r);//{ c: 'c' }
let i = queue.pop();
// console.log(i); //{ a: 'a' }
let s = queue.getSize();
// console.log(s); //2
queue.clear();
