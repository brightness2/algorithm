/*
 * @Author: Brightness
 * @Date: 2021-09-16 10:11:08
 * @LastEditors: Brightness
 * @LastEditTime: 2021-09-16 10:32:57
 * @Description:根据父id转成tree结构
 */
/**字段配置 */
let attr = {
    id: "id",
    parendId: "pid",
    name: "text",
    rootId: 1, //顶级父级id值
};

function toTreeData(data, attr) {
    let tree = []; //tree结构结果
    let resData = data; //原数据
    /********找出父级数据，并删除原数据的父级数据****** */
    for (let i = 0; i < resData.length; i++) {
        if (resData[i][attr.parendId] === attr.rootId) {
            let obj = {
                id: resData[i][attr.id],
                name: resData[i][attr.name],
                children: [],
            };
            tree.push(obj); //保存父级数据到tree结构
            resData.splice(i, 1); //删除父级数据
            i--;
        }
    }
    /*************把子级数据递归处理***************** */
    var run = function (treeArrs) {
        if (resData.length > 0) {
            for (let i = 0; i < treeArrs.length; i++) {
                for (let j = 0; j < resData.length; j++) {
                    if (treeArrs[i].id === resData[j][attr.parendId]) {
                        let obj = {
                            id: resData[j][attr.id],
                            name: resData[j][attr.name],
                            children: [],
                        };
                        treeArrs[i].children.push(obj);
                        resData.splice(j, 1);
                        j--;
                    }
                }
                run(treeArrs[i].children);
            }
        }
    };
    run(tree);
    return tree;
}
