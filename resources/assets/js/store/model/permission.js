
import Model from "../base/model";

export default class Permission extends Model {

    get prototype() {
        return {
            id: Number,
            name: String,
            description: String,
            created_at: String,
            updated_at: String,
        }
    }

    get name() {
        return 'permission';
    }

    get namespace() {
        return true;
    }

    get restful() {
        return true;
    }
};