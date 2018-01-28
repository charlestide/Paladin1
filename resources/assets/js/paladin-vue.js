/**
 * @file 注册通用的Vue组件
 */


import VueBooter from "./bootstrap/vue-booter";

let vueBooter = new VueBooter(window);
window.app = vueBooter.boot().$mount('#app');




