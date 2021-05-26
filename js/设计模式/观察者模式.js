/*
 * @Author: Brightness
 * @Date: 2021-05-26 10:16:18
 * @LastEditors: Brightness
 * @LastEditTime: 2021-05-26 11:08:45
 * @Description:观察者模式
 */
/**
 * 使用场景，模块中调用其它模块,耦合性高
 */
// class A {
//   action() {
//     console.log("hello");
//   }
// }

// class C {
//   Hi() {
//     let a = new A();
//     a.action();
//   }
// }

// new C().Hi();
/************** 通过观察者模式解耦 ***********************/
class Event {
  constructor() {
    //存储事件
    this.callbacks = {};
  }

  //添加事件
  $on(name, fn) {
    if (typeof fn === "function") {
      (this.callbacks[name] || (this.callbacks[name] = [])).push(fn);
    }
    return this;
  }
  //触发事件
  $emit(name, arg) {
    let cbs = this.callbacks[name];
    if (cbs) {
      cbs.forEach((fn) => {
        fn.call(this, arg);
      });
    }
    return this;
  }

  //取消事件
  $off(name) {
    this.callbacks[name] = null;
    return this;
  }
}

//使用方式
// let e = new Event();

// e.$on("test", () => {
//   console.log("test");
// })
//   .$on("test2", () => {
//     console.log("test2");
//   })
//   .$emit("test")
//   .$emit("test2")
//   .$off("test")
//   .$emit("test");

//解耦上面的例子
let ev = new Event();
class A {
  constructor() {
    ev.$on("Aaction", () => {
      console.log("hello");
    });
  }
}

class C {
  Hi() {
    ev.$emit("Aaction");
  }
}
new A();
new C().Hi();
