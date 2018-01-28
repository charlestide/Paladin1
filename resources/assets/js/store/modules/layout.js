
const PVC_LAST_PAGE = 'pvc-last-page';

import DataHelper from "../helper/data";
import RemoteHelper from "../helper/remote";

export default {
    namespaced: true,
    state: {
        sidebar: {
            active: 1,
            collapse: false
        },
        mainPage: {
            icon: '',
            title: '',
            summary: ''
        },
        breadcrumb: [],
        menus: []
    },
    getters: {
        sidebar: (state) => state.sidebar,
        mainPage: (state) => state.mainPage,
        lastPage: (state) => {
            return sessionStorage.getItem(PVC_LAST_PAGE);
        }

    },
    mutations: {
        collapseSideBar(state) {
            state.sidebar.collapse = true;
        },
        expandSideBar(state) {
            state.sidebar.collapse = false;
        },

        setMainPage(state,page) {
            state.mainPage = page;
        },

        saveLastPage(state,url) {
            if (! (url in {'/init':'','/login':'','/':''})) {
                sessionStorage.setItem(PVC_LAST_PAGE, url);
            }
        },

        setMenus(state,menus) {
            state.menus = DataHelper.getChildren(menus);;
        }
    },
    actions: {
        getMenus({commit}) {
            return new Promise(resolve => {
                this._vm.$axios.get('/layout/menu')
                    .then(response => {
                        if (response.data.status) {
                            commit('setMenus',response.data.data);
                        }
                        resolve(response.data.data);
                    })
                    .catch((error) => {
                        RemoteHelper.showRemoteError(this._vm,error,'获取菜单失败');
                    });
            });

        }
    }
};