
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// require('./bootstrap');

// window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


Vue.component('pvc-bread-crumb', require('./components/special/BreadCrumb.vue'));
Vue.component('pvc-bread-crumb-item', require('./components/special/BreadCrumbItem.vue'));
Vue.component('pvc-datatable', require('./components/data/DataTable.vue'));
Vue.component('pvc-data-column', require('./components/data/DataColumn.vue'));
Vue.component('pvc-data-column-action', require('./components/data/DataColumnAction.vue'));
Vue.component('pvc-button', require('./components/button/Button.vue'));
Vue.component('pvc-link-button', require('./components/button/LinkButton.vue'));
Vue.component('pvc-panel', require('./components/layout/Panel.vue'));
Vue.component('pvc-jstree', require('./components/data/Jstree.vue'));
Vue.component('pvc-fancytree', require('./components/data/Fancytree.vue'));
Vue.component('pvc-tree-node', require('./components/data/TreeNode.vue'));
Vue.component('pvc-item', require('./components/common/Item.vue'));




