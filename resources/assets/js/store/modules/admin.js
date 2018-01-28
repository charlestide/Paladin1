

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
        getUrl: '/admin/:id',
        getError: '无法获取单个数据',
        saveUrl: '/admin/:id',
        saveError: '无法更新数据',
        createUrl: '/admin',
        createError: '无法创建数据',
        deleteUrl: '/admin/:id',
        deleteError: '无法删除数据',
        listUrl: '/admin',
        listError: '无法获取管理员列表数据'
    },
    empty: {
        id: 0,
        name: '',
        email: '',
        description: '',
        status: true,
        created_at: '',
        updated_at: '',
        roles: [],
        permissions:[]
    },
    fromRemote(admin) {
        admin.status = Boolean(admin.status);
        admin.roleNames = _.map(admin.roles,'name');
        admin.permissionNames = _.map(admin.permissions,'name');
        return admin;
    }
});

export default factory.make();

