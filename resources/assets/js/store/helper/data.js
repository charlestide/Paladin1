
export default class DataHelper {

    /**
     * 递归获取子节点，一般可以通过传给parentId=0，来获取整个树
     *
     * @param items 完整节点列表
     * @param parent 父节点，传入null表示顶级顶点
     * @param idKey 代表唯一标识的key
     * @param parentKey 代表父节点唯一标识的key
     * @param pathKey 代码节点路径的唯一标识的key，key的值将被收集在名为_path的数组中
     * @returns {Array}
     */
    static getChildren(items,parent,idKey = 'id',parentKey = 'parent_id',pathKey = 'id') {
        let list = [];
        _.each(items,item => {
            if ( item[parentKey] === (_.has(parent,idKey) ? parent[idKey] : 0)) {
                //父节点
                if (parent) {
                    item.parent = parent;
                    item._path = parent._path.concat(parent[pathKey]);
                } else {
                    item._path = [];
                }

                //子节点
                let children = DataHelper.getChildren(items,item,idKey,parentKey);
                if (_.isArray(children) && children.length) {
                    item.children = children;
                }

                list.push(item);
            }
        });

        return list;
    }
}