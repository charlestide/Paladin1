let PreLoaderMapping = { 
"pvc-button": () => import(/* webpackChunkName: "pvc-button" */ "./resources/assets/js/components/button/Button.vue"), 
"pvc-echart-line": () => import(/* webpackChunkName: "pvc-echart-line" */ "./resources/assets/js/components/chart/EChartLine.vue"), 
"pvc-datatable": () => import(/* webpackChunkName: "pvc-datatable" */ "./resources/assets/js/components/data/DataTable.vue"), 
"pvc-table-column": () => import(/* webpackChunkName: "pvc-table-column" */ "./resources/assets/js/components/data/TableColumn.vue"), 
"pvc-aside": () => import(/* webpackChunkName: "pvc-aside" */ "./resources/assets/js/components/layout/Aside.vue"), 
"pvc-bread-crumb": () => import(/* webpackChunkName: "pvc-bread-crumb" */ "./resources/assets/js/components/layout/BreadCrumb.vue"), 
"pvc-footer": () => import(/* webpackChunkName: "pvc-footer" */ "./resources/assets/js/components/layout/Footer.vue"), 
"pvc-header": () => import(/* webpackChunkName: "pvc-header" */ "./resources/assets/js/components/layout/Header.vue"), 
"pvc-panel": () => import(/* webpackChunkName: "pvc-panel" */ "./resources/assets/js/components/layout/Panel.vue"), 
"AuthorizedClients": () => import(/* webpackChunkName: "AuthorizedClients" */ "./resources/assets/js/components/passport/AuthorizedClients.vue"), 
"Clients": () => import(/* webpackChunkName: "Clients" */ "./resources/assets/js/components/passport/Clients.vue"), 
"PersonalAccessTokens": () => import(/* webpackChunkName: "PersonalAccessTokens" */ "./resources/assets/js/components/passport/PersonalAccessTokens.vue"), 
"pvc-admin-create": () => import(/* webpackChunkName: "pvc-admin-create" */ "./resources/assets/js/views/admin/AdminCreate.vue"), 
"pvc-admin-edit": () => import(/* webpackChunkName: "pvc-admin-edit" */ "./resources/assets/js/views/admin/AdminEdit.vue"), 
"pvc-admin-index": () => import(/* webpackChunkName: "pvc-admin-index" */ "./resources/assets/js/views/admin/AdminIndex.vue"), 
"pvc-admin-show": () => import(/* webpackChunkName: "pvc-admin-show" */ "./resources/assets/js/views/admin/AdminShow.vue"), 
"pvc-login": () => import(/* webpackChunkName: "pvc-login" */ "./resources/assets/js/views/auth/Login.vue"), 
"pvc-app": () => import(/* webpackChunkName: "pvc-app" */ "./resources/assets/js/views/framework/App.vue"), 
"component-loader": () => import(/* webpackChunkName: "component-loader" */ "./resources/assets/js/views/framework/ComponentLoader.vue"), 
"pvc-dashboard": () => import(/* webpackChunkName: "pvc-dashboard" */ "./resources/assets/js/views/framework/Dashboard.vue"), 
"pvc-init": () => import(/* webpackChunkName: "pvc-init" */ "./resources/assets/js/views/framework/Init.vue"), 
"pvc-menu-create": () => import(/* webpackChunkName: "pvc-menu-create" */ "./resources/assets/js/views/menu/MenuCreate.vue"), 
"pvc-menu-edit": () => import(/* webpackChunkName: "pvc-menu-edit" */ "./resources/assets/js/views/menu/MenuEdit.vue"), 
"pvc-menu-index": () => import(/* webpackChunkName: "pvc-menu-index" */ "./resources/assets/js/views/menu/MenuIndex.vue"), 
"pvc-menu-show": () => import(/* webpackChunkName: "pvc-menu-show" */ "./resources/assets/js/views/menu/MenuShow.vue"), 
"pvc-permission-create": () => import(/* webpackChunkName: "pvc-permission-create" */ "./resources/assets/js/views/permission/PermissionCreate.vue"), 
"pvc-permission-edit": () => import(/* webpackChunkName: "pvc-permission-edit" */ "./resources/assets/js/views/permission/PermissionEdit.vue"), 
"pvc-permission-index": () => import(/* webpackChunkName: "pvc-permission-index" */ "./resources/assets/js/views/permission/PermissionIndex.vue"), 
"pvc-permission-show": () => import(/* webpackChunkName: "pvc-permission-show" */ "./resources/assets/js/views/permission/PermissionShow.vue"), 
"pvc-role-create": () => import(/* webpackChunkName: "pvc-role-create" */ "./resources/assets/js/views/role/RoleCreate.vue"), 
"pvc-role-edit": () => import(/* webpackChunkName: "pvc-role-edit" */ "./resources/assets/js/views/role/RoleEdit.vue"), 
"pvc-role-index": () => import(/* webpackChunkName: "pvc-role-index" */ "./resources/assets/js/views/role/RoleIndex.vue"), 
"pvc-role-show": () => import(/* webpackChunkName: "pvc-role-show" */ "./resources/assets/js/views/role/RoleShow.vue"), 
};
export default PreLoaderMapping; 
module.exports = PreLoaderMapping; 
