import Model from "../base/model";

export default class Role extends Model {

    get prototype() {
        return {
            id: Number,
            name: String,
            display_name: String,
            created_at: String,
            updated_at: String,
            permissions: Array,
            permissionNames: {
                get: function () {
                    return _.map(this.permissions, 'name');
                }
            }
        }
    }

    get name() {
        return 'role';
    }

    get namespace() {
        return true;
    }

    get restful() {
        return true;
    }


}