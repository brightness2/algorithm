/*
 * @Author: Brightness
 * @Date: 2021-06-17 09:58:40
 * @LastEditors: Brightness
 * @LastEditTime: 2021-06-17 10:51:11
 * @Description:
 */
/* 循环队列 */
class CircularQueue {
  constructor(len) {
    this.arr = new Array(len);
    this.rear = -1;
    this.front = -1;
    this.size = 0;
  }

  enQueue(value) {
    if (this.isFull()) return false;
    if (this.isEmpty()) this.front = 0;
    this.rear = (this.rear + 1) % this.arr.length;
    this.arr[this.rear] = value;
    this.size = this.size === this.arr.length ? this.arr.length : this.size + 1;
    return true;
  }

  deQueue() {
    if (this.isEmpty()) return false;
    if (this.size === 1) {
      this.front = -1;
      this.rear = -1;
    } else {
      this.front = (this.front + 1) % this.arr.length;
    }
    this.size = this.size === 0 ? 0 : this.size - 1;
    return true;
  }

  Front() {
    if (this.isEmpty()) return -1;
    return this.arr[this.front];
  }

  Rear() {
    if (this.isEmpty()) return -1;
    return this.arr[this.rear];
  }

  isEmpty() {
    return this.size === 0;
  }

  isFull() {
    return this.size === this.arr.length;
  }
}

let e = new CircularQueue(3); //设置长度为 3
e.enQueue(1); //true
e.enQueue(2); //true
e.enQueue(3); //true
e.enQueue(4); //false,队列已满
e.Rear(); //3
e.isFull(); //true
e.deQueue(); //true
e.enQueue(4); //true
e.Rear(); //4
