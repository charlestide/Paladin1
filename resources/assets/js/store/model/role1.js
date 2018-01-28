
import Store from "./store";
import Factory from "../factory";

let factory = new Factory;

let model = factory.create(Store,{
    name: 'role',
    idKeyType: Number,
    prototype: {
        id: Number,
        name: String,
        display_name: String,
        created_at: String,
        updated_at: String,
    },
    getter: (roles) => {
        if (!_.isArray(roles)) {
            roles = [roles];
        }
        for (let role of roles) {
            role.permissionNames = _.map(role.permissions, 'name');
        }

        if (roles.length === 1) {
            return roles[0];
        } else {
            return roles;
        }
    },
});

export default model;

