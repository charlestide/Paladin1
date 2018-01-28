import _ from "lodash";

class PreLoader {
    constructor(componentMap, callback) {
        this.components = new Map();
        if (callback) {
            this.setCallback(callback);
        }
        this.loadMap(componentMap);
    }
    static getInstance(componentMap, callback) {
        if (!PreLoader.instance) {
            PreLoader.instance = new PreLoader(componentMap, callback);
        }
        if (componentMap) {
            PreLoader.instance.loadMap(componentMap);
        }
        if (callback) {
            PreLoader.instance.setCallback(callback);
        }
        return PreLoader.instance;
    }
    static install(Vue, options = {}) {
        let loader = PreLoader.getInstance(_.get(options, 'componentMap', {}), _.get(options, 'callback', null));
        Vue.prototype.$loader = loader;
        PreLoader.vue = Vue;
    }
    loadMap(componentMap) {
        _.forEach(componentMap, (com, name) => {
            if (_.isString(name) && _.isFunction(com)) {
                this.components.set(name, {
                    loader: com,
                    loaded: false,
                    name: name
                });
            }
        });
    }
    getComponents() {
        return this.components;
    }
    setCallback(callback) {
        this.loadedCallback = callback;
    }
    get(name) {
        let callback = this.loadedCallback;
        if (this.components && this.components.has(name)) {
            let item = this.components.get(name);
            if (!_.has(item, 'loader')) {
                console.error('module should have \"loader\" property');
            }
            let loaderFunction = _.get(item, 'loader');
            if (_.isFunction(callback)) {
                return () => loaderFunction().then(function (com) {
                    // callback(name);
                    return com;
                });
            }
            else {
                return () => loaderFunction();
            }
        }
        console.error('component not found: ' + name);
    }
    register(name) {
        try {
            let com = this.get(name);
            if (com) {
                PreLoader.vue.component(name, com);
            }
        }
        catch (e) {
            console.error('module "' + name + '" cannot register');
        }
    }
    registerAll() {
        for (let name of this.components.keys()) {
            this.register(name);
        }
    }
    loadAll() {
        for (let name of this.components.keys()) {
            this.get(name)();
        }
    }
}
export default PreLoader;
