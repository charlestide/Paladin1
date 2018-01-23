

export default class FormattingHelper {

    /**
     * 使数组拥有key和label
     * @param items
     * @param key item中对应key的字段名称
     * @param label item中对应label的字段名称
     * @returns {Array}
     */
    static toKeyLabel(items,key,label) {
        if (_.isArray(items)) {
            return _.map(items,item => {
                item.key = item[key];
                item.label = item[label];
                return item;
            })
        } else {
            console.error('cannot convent to key-label cause the ITEMS is not array');
            console.log(items);
            return [{key:'',label:''}];
        }
    }
}