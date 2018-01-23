
import collect from "collect.js";
import Vue from 'vue';

class Loader {

    constructor (componentMap) {
        this.components = this.loadMap(componentMap);
        this.loadedCallback = null;
    }

    static getInstance(componentMap) {
        if (!Loader.instance) {
            Loader.instance = new Loader(componentMap);
        }
        return Loader.instance;
    }


    /**
     * 载入组件映射
     * @param componentMap
     */
    loadMap(componentMap) {
        componentMap = collect(componentMap);
        let validComponents = collect({});

        componentMap.each((com,name) => {
            if (typeof com === 'function') {
                validComponents.prepend({
                    loader: com,
                    loaded: false,
                    name: name
                },name);
            }
        });

        return validComponents;
    }

    /**
     * 作为插件安装
     * @param Vue
     * @param options
     */
    static install(Vue,options) {
        if (options && options.hasOwnProperty('componentMap')) {
            let loader = Loader.getInstance(options.componentMap);

            loader.vue = Vue;
            if (options.hasOwnProperty('callback')) {
                loader.setCallback(options.callback);
            }

            Vue.prototype.$loader = loader;
        } else {
            console.error('invalid componentMap');
        }
    }

    /**
     * 设置加载完成后的callback
     * @param callback
     */
    setCallback(callback) {
        this.loadedCallback = callback;
    }

    get(name) {
        return () => this.load(name);
    }

    /**
     *  加载一个组件
     * @param name 组件名
     * @param callback 加载完成后的callback
     */
    load(name) {
        let self = this,
            callback = this.loadedCallback;

        if (this.components && this.components.has(name)) {
            let item = this.components.get(name);

            if (typeof (item) !== 'object') {
                console.error('module in make-loader-map should be object');
            }
            if (!item.hasOwnProperty('loader')) {
                console.error('module should have \"loader\" property');
            }

            let loaderFunction = item.loader;

            if (typeof (callback) === 'function') {
                return loaderFunction().then(function (com) {
                    callback(name);
                    return com;
                });
            } else {
                return loaderFunction();
            }

        }
        console.error('component not found: ' + name);
    }

    loadAll() {
        let self = this;
        console.log('loadAll');
        this.components.each(function (item,name) {
            self.get(name)();
            console.log(name);
        })
    }

    /**
     * 将组件用vue.component方法注册
     * @param name vue组件名称
     */
    register(name) {
        try {
            let com = this.get(name);
            Vue.component(name,com);
        } catch (e) {
            console.error('module "'+name+'" cannot register');
        }
    }

    registerAll() {
        let self = this;
        this.components.each(function (item,name) {
            self.register(name);
        })
    }
}

Loader.instance = null;


export default Loader;