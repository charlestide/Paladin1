

import StoreFactory from "../factory";
import list from "../mix/list";
import store from "../mix/store";
import filtered from "../mix/filtered";

let factory = new StoreFactory();

factory.enableNamespace();
factory.registerMix(list);
factory.registerMix(filtered);
factory.registerMix(store);

factory.registerState({
    setting: {
        getUrl: '/menu/:id',
        getError: '无法获取单个数据',
        saveUrl: '/menu/:id',
        saveError: '无法更新数据',
        createUrl: '/menu',
        createError: '无法创建数据',
        deleteUrl: '/menu/:id',
        deleteError: '无法删除数据',
        listUrl: '/menu',
        listError: '无法获取菜单列表数据'
    },
    empty: {
        id: 0,
        name: '',
        icon: '',
        url: '',
        parent_id: 0,
        permission_id: 0,
        created_at: '',
        updated_at: '',
        parent_path: []
    },
    fromRemote(menu) {
        menu.status = Boolean(menu.status);
        if (_.isString(menu.parent_path)) {
            menu.parent_path = menu.parent_path.split('|');
            menu.parent_path = _.map(menu.parent_path,Number);
        } else if (!_.isArray(menu.parent_path)) {
            menu.parent_path = [];
        }
        return menu;
    },
    toRemote(menu) {
        if (_.isArray(menu.parent_path)) {
            menu.parent_path = menu.parent_path.length ? menu.parent_path.join('|') : '';

            if (!menu.parent_id && menu.parent_path.length) {
                menu.parent_id = menu.parent_path[menu.parent_path.length-1];
            }
        }


        return menu;
    }
});

export default factory.make();

