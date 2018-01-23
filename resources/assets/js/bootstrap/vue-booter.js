import routeMap from "./routes";
import Vue from "vue";
import VueRouter from "vue-router";
import store from "../store";
import componentMap from "../../../../preloader.mapping";
import PreLoader from "../modules/preloader";
import AxiosHelper from "../plugin/axios-helper";
import ElementUI from 'element-ui'


class VueBooter {

    constructor(document) {
        this.vueConfig = {};
        this.init();
        this.document = document;
    }

    init() {
        Vue.use(VueRouter);
        this._initLoader();
        // this._initElementUI();
        Vue.use(ElementUI,{ size: 'small' });

    }

    _initLoader() {
        Vue.use(PreLoader, {
            componentMap: componentMap,
            callback: function (name) {
                store.commit('loader/complete', name)
            }
        });
    }

    boot() {
        this._setRoute();
        this._setStore();
        this._setAxios();
        return new Vue(_.defaults(this.vueConfig,{
            created() {
                let self = this;

                //将待加载组件读入store
                this.$store.commit('loader/init',PreLoader.getInstance().getComponents());

                //注册组件，但虽然注册了，但其实所有组件都是异步加载的，所以只有用到的组件才会加载
                this.$loader.registerAll();

                //跳到初始页，加载组件
                this.$router.push('/init');

                window.onload = function () {
                    //在页面加载完成后，主动加载所有组件
                    self.$loader.loadAll();
                };

                //注册钩子函数，在路由完成后调用
                this.$router.afterEach((to,from) => {
                    let page = {title: '', summary: '', icon: '', breadcrumb: []},
                        breadcrumb = {};

                    //路由注入，生成breadcrumb
                    _.eachRight(to.matched,(route) => {
                        if (breadcrumb = _.get(route,'meta.breadcrumb')
                        ) {
                            page.title = breadcrumb.title;
                            page.icon = breadcrumb.icon;
                            page.summary = breadcrumb.summary;
                            page.breadcrumb.unshift({
                                title: _.get(breadcrumb,'title'),
                                to: route.path,
                            });
                        }
                    });

                    //将获取的当成页面（包括breadcrumb）保存到store
                    if (page.title) {
                        self.$store.commit('layout/setMainPage', page);
                    }

                    //将访问的页面保存到sessionStorage中
                    self.$store.commit('layout/saveLastPage', to.path);
                });
            },

        }));
    }

    _setAxios() {
        let token = VueBooter._getMeta('csrf-token');
        if (!token) {
            console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
        }

        Vue.use(AxiosHelper,{
            router: this.vueConfig.router,
            csrf: token,
        });
    }

    _setRoute() {
        let loader = PreLoader.getInstance(),
            routes = this._parseRoute(routeMap,loader);
        this.vueConfig.router = new VueRouter({
            routes
        });
    }

    _parseRoute(routesList,loader) {
        let self = this;
        _.map(routesList,(route) => {
            if (_.has(route,'componentName')) {
                route.component = loader.get(route.componentName);
            } else if (_.has(route,'componentNames') && _.isObject(route.componentNames)){
                _.forEach(route.componentNames,(value,key) => {
                    _.set(route,'components.'+key,loader.get(value));
                });
            }

            if (_.has(route,'children')) {
                route.children = self._parseRoute(route.children,loader);
            }
        });

        return routesList;
    }

    _setStore() {
        // let clientInfo = {
        //     clientId: VueBooter._getMeta('client-id'),
        //     clientSecret: VueBooter._getMeta('client-secret')
        // };
        //
        // if (!clientInfo.clientId || !clientInfo.clientSecret) {
        //     console.error('client-id or client-secret not found, please check whether they are in meta tag of html page');
        // } else {
        //     store.commit('auth/setClient',clientInfo);
        // }

        this.vueConfig.store = store;
    }

    static _getMeta(key) {
        let meta = document.head.querySelector('meta[name='+key+']');
        if (meta) {
            return meta.content;
        } else {
            return '';
        }
    }
}

export default VueBooter;