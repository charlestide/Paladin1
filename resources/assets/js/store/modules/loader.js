import _ from 'lodash';


export default {
    namespaced: true,
    state: {
        compenents: {},
        remainCount: 0,
        initialized: false
    },

    getters: {
        count(state) {
            return _.size(state.compenents);
        },

        remain(state) {
            return state.remainCount;
        },

        loadingName(state) {
            let remain = null;
            state.compenents.forEach((item) => {
                if (item.loaded === false) {
                    remain = item;
                }
            });

            if (remain) {
                return remain.name;
            } else {
                return '';
            }
        }
    },
    mutations: {
        complete(state,name) {
            if (state.compenents.has(name)) {
                state.compenents.get(name).loaded = true;
                state.remainCount --;
            }
        },
        init(state,componentMap) {
            if (componentMap) {
                state.compenents = componentMap;
                state.remainCount = componentMap.size;
            }
        }
    }
};