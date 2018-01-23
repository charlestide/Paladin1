export default [
    { path: '/init', componentNames: {app: 'pvc-init' }},
    { path: '/login', componentNames: {app: 'pvc-login' }},
    { path: '/', componentNames: {app: 'pvc-app'},
        children: [
            { path: '', componentName: 'pvc-dashboard'},

            //管理员
            { path: 'admin',componentName: 'pvc-admin-index',
                meta: {breadcrumb: {title: '管理员',icon: 'user', summary: '在这里可以对管理员进行管理'}},
            },
            { path: 'admin/create',componentName: 'pvc-admin-create',
                meta: {breadcrumb: {title: '创建管理员',icon: 'user', summary: '在这里可以创建一个新的管理员'}},
            },
            { path: 'admin/:id',componentName: 'pvc-admin-show',
                meta: {breadcrumb: {title: '详情管理员',icon: 'detail', summary: '查看管理员的详细信息'}},
            },
            { path: 'admin/:id/edit',componentName: 'pvc-admin-edit',
                meta: {breadcrumb: {title: '管理员详情',icon: 'edit', summary: '查看管理员的详细信息'}},
            },

            //权限
            { path: 'permission',componentName: 'pvc-permission-index',
                meta: {breadcrumb: {title: '权限',icon: 'user', summary: '在这里可以对权限进行管理'}},
            },
            { path: 'permission/create',componentName: 'pvc-permission-create',
                meta: {breadcrumb: {title: '创建权限',icon: 'user', summary: '在这里可以创建一个新的权限'}},
            },
            { path: 'permission/:id',componentName: 'pvc-permission-show',
                meta: {breadcrumb: {title: '权限详情',icon: 'detail', summary: '您可以查看权限的详细信息'}},
            },
            { path: 'permission/:id/edit',componentName: 'pvc-permission-edit',
                meta: {breadcrumb: {title: '修改权限',icon: 'edit', summary: '您可以修改一个权限的信息'}},
            },

            //菜单
            { path: 'menu',componentName: 'pvc-menu-index',
                meta: {breadcrumb: {title: '菜单',icon: 'user', summary: '在这里可以对菜单进行管理'}},
            },
            { path: 'menu/create/:parent',componentName: 'pvc-menu-create',
                meta: {breadcrumb: {title: '创建菜单',icon: 'user', summary: '在这里可以创建一个新的菜单'}},
            },
            { path: 'menu/:id',componentName: 'pvc-menu-show',
                meta: {breadcrumb: {title: '菜单详情',icon: 'detail', summary: '您可以查看菜单的详细信息'}},
            },
            { path: 'menu/:id/edit',componentName: 'pvc-menu-edit',
                meta: {breadcrumb: {title: '修改菜单',icon: 'edit', summary: '您可以修改一个菜单的信息'}},
            },

            //角色
            { path: 'role',componentName: 'pvc-role-index',
                meta: {breadcrumb: {title: '角色',icon: 'user', summary: '在这里可以对角色进行管理'}},
            },
            { path: 'role/create',componentName: 'pvc-role-create',
                meta: {breadcrumb: {title: '创建角色',icon: 'user', summary: '在这里可以创建一个新的角色'}},
            },
            { path: 'role/:id',componentName: 'pvc-role-show',
                meta: {breadcrumb: {title: '角色详情',icon: 'detail', summary: '您可以查看角色的详细信息'}},
            },
            { path: 'role/:id/edit',componentName: 'pvc-role-edit',
                meta: {breadcrumb: {title: '角色菜单',icon: 'edit', summary: '您可以修改一个角色的信息'}},
            },
        ],
        meta: {breadcrumb: {title: '首页',icon: 'home', summary: '这里能够查看后台总览'}}
    }
];
