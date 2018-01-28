import auth from "./modules/auth";
import loader from "./modules/loader";
import layout from "./modules/layout";
// import admin from "./modules/admin";
import menu from "./modules/menu";
// import permission from "./modules/permission";
import form from "./modules/form";
import Role from "./model/role";
import Admin from "./model/admin";
import Permission from "./model/permission";
import common from "./modules/common";
// import permission from "./model/permission";


export default {
    modules: {
        auth,
        loader,
        layout,
        admin: new Admin(true),
        menu,
        permission: new Permission(true),
        role: new Role(true),
        form,
        common
    }
};