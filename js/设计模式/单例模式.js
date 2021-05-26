/*
 * @Author: Brightness
 * @Date: 2021-05-26 11:50:04
 * @LastEditors: Brightness
 * @LastEditTime: 2021-05-26 11:56:22
 * @Description:单例模式
 */
class Single {
  constructor(name) {
    this.name = name;
    this.instance = null;
  }
  static getInstance(name) {
    if (!this.instance) {
      this.instance = new Single(name);
    }
    return this.instance;
  }
}
console.log(Single.getInstance("one"));
var d = Single.getInstance("two");
console.log(d);
