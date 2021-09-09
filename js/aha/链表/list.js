/*
 * @Author: Brightness
 * @Date: 2021-09-08 16:56:35
 * @LastEditors: Brightness
 * @LastEditTime: 2021-09-09 11:34:17
 * @Description:  模拟链表
 */
/*
在存储一大波数的时候,若使用数组，在插入一个新的数时，需要把插入位置后面的数都往后移动，不灵活；
用链表存储则可以快速插入
 */
/**
 *节点类
 *
 * @class Node
 */
class Node{
    constructor(key){
        this.key = key;
        this.next = null;
    }
}

/**
 * 单向链表
 * 结构 c -> b -> a,这样操作更方便,最新的节点在最前面
 * @class List
 */
class List{
    constructor(){
        this.head = null;
        this.length = 0;
    }

    /**
     *创建节点
     *
     * @param {*} data
     * @return {*} 
     * @memberof List
     */
    static createNode(key){
        return new Node(key);
    }

   

    /**
     *搜索节点
     * 从最后加入的节点开始搜索
     * -》
     * c -> b -> a
     * @param {*} key
     * @memberof List
     */
    find(key){
        let node = this.head;
        while (node != null && node.key != key) {
                node = node.next;
        }
        return node;
    }

    /**
     * 查找节点的上一个节点
     *
     * @param {*} node
     * @return {*} 
     * @memberof List
     */
    findPrevNode(node){
        //查找所要删除节点的上一个节点 如 c -> b -> a 中 b的上节点 c
        let prevNode = this.head;
        while (prevNode && prevNode.next !== node) {
            prevNode = prevNode.next;
        }
        return prevNode;
    }

     /**
     * 追加节点 ,排在最前
     * b -> a  =>  c -> b -> a
     * @param {*} node
     * @memberof List
     */
    append(node){
        if(!node){
            return;
        }
        //如果head有指向的节点
        if(this.head){
            node.next = this.head;
         }else {
            node.next = null;
         }
         this.head = node;
         this.length++;
    }
    
    /**
     *删除节点
     * 需要通过find 搜索节点
     * @param {*} node 搜索到的节点
     * @memberof List
     */
    delete(node){
        if(!node){
            return;
        }
        //情况一,要删除的节点是最新加入的节点，也就是 c -> b -> a 的 c,删除后 b -> a
        if(node === this.head){
            this.head = node.next;
            return;
        }
        //查找所要删除节点的上一个节点 如 c -> b -> a 中 b的上节点 c
        let prevNode = this.findPrevNode(node);
        
        //情况二,要删除的节点是中间的节点,如 c -> b -> a 的 b,删除后,c -> a
          // 查找所要删除节点的上一个节点
        if(node.next) {
            prevNode.next = node.next;
        }

        //情况三,要删除的节点是第一个加入的节点,如 c -> b -> a 的 a,删除后, c -> b
        // 第三种情况
        
        if(node.next === null) {
            prevNode.next = null;
        }
        this.length--;
    }

    /**
     *在某个节点前插入
     * c -> b -> a 的 b 前插入 d ，=》  c -> d -> b  -> a
     * @param {*} node
     * @param {*} beforeNode
     * @memberof List
     */
    insert(node,beforeNode){
       //如果是空
        if(!beforeNode){
          return;   
        }

        let prevNode = this.findPrevNode(beforeNode);
        node.next = beforeNode;
        //如果是最新（最前）节点,没有上级节点
        if(!prevNode){
            this.head = node;
        }else if(prevNode){
            prevNode.next = node;
        }
        
        this.length++;
    }

    /**
     * 插入到最后
     *
     * @param {*} node
     * @memberof List
     */
    insertToEnd(node){
        // 插入到最后，如c -> b -> a 的 a后面，=》 c -> b -> a -> node
        let nextNode  = this.head;
        while(nextNode.next != null){
            nextNode = nextNode.next;
        } 
        nextNode.next = node;   
        this.length++;
    }


}

let l = new List();
l.append(List.createNode('two'));//追加
l.append(List.createNode('four'));//追加
l.append(List.createNode('six'));//追加
l.insert(List.createNode('three'),l.find('two'));//插入
l.insertToEnd(List.createNode('one'));//插入到末尾
l.delete(l.find('six'));//删除

console.log(l.head);

