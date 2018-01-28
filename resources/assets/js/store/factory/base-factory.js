
export default class BaseFactory {

    constructor(namespace = false) {
        this.state = {
            settings: {}
        };
        this.getters = {};
        this.mutations = {};
        this.actions = {};
        this.namespaced = namespace;
    }

    /**
     * 注册State
     * @param state
     */
    registerState(state) {
       _.defaultsDeep(this.state,state);
    }

    /**
     * 注册Getters
     * @param getters
     */
    registerGetters(getters) {
        _.defaultsDeep(this.getters,getters);
    }
    registerMutations(mutations) {
        _.defaultsDeep(this.mutations,mutations);
    }
    registerActions(actions) {
        _.defaultsDeep(this.actions,actions);
    }

    registerMix(mix) {
        this.registerState(mix.state);
        this.registerGetters(mix.getters);
        this.registerMutations(mix.mutations);
        this.registerActions(mix.actions);
    }

    make() {
        return {
            namespaced: this.namespaced,
            state: this.state,
            getters: this.getters,
            mutations: this.mutations,
            actions: this.actions,
        }
    }

    /**
     * 添加一个State
     *
     * @param name 名称
     * @param state
     */
    addState(name,state) {
        this.state[name] = state;
    }

    addSetting(name,setting) {
        this.state.settings[name] = setting;
    }

    get settings() {
        return this.state.settings;
    }

    /**
     * 添加一个Getter
     *
     * @param name
     * @param getter
     */
    addGetter(name,getter) {
        this.getters[name] = getter;
    }

    /**
     * 添加一个Mutation
     * @param name
     * @param mutation
     */
    addMutations(name,mutation) {
        this.mutations[name] = mutation;
    }

    /**
     * 添加一个Action
     *
     * @param name
     * @param action
     */
    addAction(name,action) {
        this.actions[name] = action;
    }

    enableNamespace(isEnabled = true) {
        this.namespace = isEnabled;
    }

    importSettings(names) {
        if (!_.isArray(names)) {
            names = [names];
        }

        for (let name of names) {
            this.addSetting(name,this[name]);
        }
    }

    get settings() {
        return this.state.settings;
    }
}