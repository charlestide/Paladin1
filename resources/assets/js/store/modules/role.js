

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
        listUrl: '/role',
        listError: '无法获取角色列表数据',
        getUrl: '/role/:id',
        getError: '无法获取单个数据',
        saveUrl: '/role/:id',
        saveError: '无法更新数据',
        createUrl: '/role',
        createError: '无法创建数据',
        deleteUrl: '/role/:id',
        deleteError: '无法删除数据',
    },
    empty: {
        id: 0,
        name: '',
        display_name: '',
        created_at: '',
        updated_at: '',
        permissions: []
    },
    fromRemote(role) {
        // role.status = Boolean(role.status);
        role.permissionNames = _.map(role.permissions,'name');
        return role;
    }
});


export default factory.make();

