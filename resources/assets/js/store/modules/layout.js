
const PVC_LAST_PAGE = 'pvc-last-page';

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
        breadcrumb: []
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
        }
    }
};