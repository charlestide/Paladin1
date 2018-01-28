
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

    enableNamespace(isEnabled = true) {
        this.namespace = isEnabled;
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

    create(model,module) {

        let newModule = _.defaults({},model,module);

        this.enableNamespace(model.namespace);
        this.applyContract(model.contract,module,model.defaults);

        this.registerMix(model);
        this.registerMix(module);

        this.generateEmpty(newModule.prototype);
        this.executeInit(newModule,this.state.settings);

        return this.make();
    }

    /**
     * 运行初始化
     * @param object
     * @param settings
     */
    executeInit(object,settings) {
        if (_.has(object,'init')) {
            object.init.call(object,settings);
        }
    }

    /**
     * 应用约定,写入state.settings
     *
     * @param contract
     * @param data
     * @param defaults
     */
    applyContract(contract,data,defaults) {
        let settings = _.clone(contract);
        _.assignWith(settings,data,(type,value,key) => {

            //如果其值是一种类型，表示这是数据中的一个字段
            if (_.includes([String, Boolean, Number, Array, Object, Function], type)) {
                if (typeof value === type.name.toLowerCase()) {
                    return value;
                } else {
                    console.error(key + ' must be type ' + type.name);
                    return type();
                }
            } else if (type instanceof Array) { //如果其值是一个数组，表示必须是其中的值
                if (_.includes(type, value)) {
                    return value;
                } else {
                    console.error(key + ' must be value of ' + type);
                }
            } else {
                return value;
            }
        });

        _.assignWith(settings,defaults,(setting,defaultValue,key) => {
            if (_.includes([String, Boolean, Number, Array,Object,Function], setting)) {
                if (typeof defaultValue === setting.name.toLowerCase()) {
                    return defaultValue;
                } else {
                    return setting;
                }
            } else if (typeof setting === 'object') {
                let setting = _.assign(setting,defaultValue);
                if (_.includes(['get','save','create','delete','list'],key)) {
                    setting.url = setting.url.replace(':name',settings.name);
                }
                return setting;
            } else {
                return setting;
            }
        });

        this.state.settings = settings;
    }

    /**
     * 生成empty 写入state.empty
     * @param prototype
     */
    generateEmpty(prototype) {
        let empty = {};
        _.each(prototype,(value,key) => {
            if (_.includes([String,Boolean,Number,Array,Object,Function],value)) {
                empty[key] = value();
            } else {
                empty[key] = value;
            }
        });

        this.state.empty = empty;
    }
}