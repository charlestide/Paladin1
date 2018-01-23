
export default class StoreFactory {

    constructor() {
        this.state = {};
        this.getters = {};
        this.mutations = {};
        this.actions = {};
        this.namespace = false;
    }

    /**
     * 注册State
     * @param state
     */
    registerState(state) {
        this.state = _.defaultsDeep(state,this.state);
    }

    /**
     * 注册Getters
     * @param getters
     */
    registerGetters(getters) {
        this.getters = _.defaultsDeep(getters,this.getters,);
    }
    registerMutations(mutations) {
        this.mutations =_.defaultsDeep(mutations,this.mutations);
    }
    registerActions(actions) {
        this.actions =_.defaultsDeep(actions,this.actions);
    }

    registerMix(mix) {
        this.registerState(mix.state);
        this.registerGetters(mix.getters);
        this.registerMutations(mix.mutations);
        this.registerActions(mix.actions);
    }

    enableNamespace() {
        this.namespace = true;
    }

    make() {
        return {
            namespaced: this.namespace,
            state: this.state,
            getters: this.getters,
            mutations: this.mutations,
            actions: this.actions,
        }
    }


}