import Vue from "vue";
import Vuex from "vuex";

import auth from "./modules/auth";
import loader from "./modules/loader";
import layout from "./modules/layout";
import admin from "./modules/admin";
import menu from "./modules/menu";
import permission from "./modules/permission";
import role from "./modules/role";

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        auth,
        loader,
        layout,
        admin,
        menu,
        permission,
        role
    }
});