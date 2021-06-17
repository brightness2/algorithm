/*
 * @Author: Brightness
 * @Date: 2021-06-17 10:57:02
 * @LastEditors: Brightness
 * @LastEditTime: 2021-06-17 15:35:06
 * @Description:
 */
/* 队列 和 BFS */
//广度优先搜索(BFS)的一个常见应用是找出从根节点到目标节点的最短路径。

/*
 * 数据
 * 0表示不连接，n行m列的1表示点n通向点m
 */
let map = [
  [0, 1, 1, 0, 0],
  [0, 0, 1, 1, 0],
  [0, 1, 1, 1, 0],
  [1, 0, 0, 0, 0],
  [0, 0, 1, 1, 0],
];

function bsf(arr = [], start, end) {
  let row = arr.length;
  let queue = [];
  let i = start;
  let visited = {}; //记录遍历顺序
  let order = []; //记录顺序，给自己看的
  queue.push(i); //先把根节点加入
  while (queue.length) {
    for (let j = 0; j < row; j++) {
      if (arr[i][j]) {
        //如果是1
        if (!visited[j]) {
          queue.push(j); //队列加入未访问
        }
      }
    }
    queue.shift(); //取出队列第一个
    visited[i] = true; //记录已经访问
    while (visited[queue[0]]) {
      queue.shift();
    }
    order.push(i); //记录顺序
    i = queue[0];
  }
  return { visited: visited, result: !!visited[end], order: order };
}

let res = bsf(map, 0, 4);
console.log(res);
