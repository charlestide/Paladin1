import Model from "../base/model";


export default class Admin extends Model {

    get prototype() {
        return {
            id: Number,
            name: String,
            email: String,
            password: String,
            description: String,
            status: Boolean
        }
    }

    get name() {
        return 'admin';
    }

    get namespace() {
        return true;
    }

    get restful() {
        return true;
    }
}