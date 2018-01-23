

import StoreFactory from "../factory";
import list from "../mix/list";
import store from "../mix/store";
import filtered from "../mix/filtered";

let factory = new StoreFactory();

factory.enableNamespace();
factory.registerMix(list);
factory.registerMix(store);
factory.registerMix(filtered);


factory.registerState({
    setting: {
        listUrl: '/permission',
        listError: '无法获取权限列表数据',
        getUrl: '/permission/:id',
        getError: '无法获取单个数据',
        saveUrl: '/permission/:id',
        saveError: '无法更新数据',
        createUrl: '/permission',
        createError: '无法创建数据',
        deleteUrl: '/permission/:id',
        deleteError: '无法删除数据',
    },
    empty: {
        id: 0,
        name: '',
        description: '',
        created_at: '',
        updated_at: ''
    },
    formatting(permission) {
        permission.status = Boolean(permission.status);
        return permission;
    }
});

export default factory.make();

