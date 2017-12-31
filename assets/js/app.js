/**
 * @file 注册通用的Vue组件
 */


import paladin from "./components/plugins/paladin";
Vue.use(paladin);


Vue.component('pvc-bread-crumb', require('./components/special/BreadCrumb.vue'));
Vue.component('pvc-bread-crumb-item', require('./components/special/BreadCrumbItem.vue'));
Vue.component('pvc-link-button', require('./components/button/LinkButton.vue'));
Vue.component('pvc-panel', require('./components/layout/Panel.vue'));
Vue.component('pvc-button',require('./components/button/Button'));





