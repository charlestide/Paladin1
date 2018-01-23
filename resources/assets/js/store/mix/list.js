
import TableQuery from "../../modules/table-query";
import RemoteHelper from "../helper/remote";
import DataHelper from "../helper/data";


export default {
    state: {
        /**
         * 存储一个二维数据
         */
        list: [],
        setting: {
            listUrl: '',
            listError: '无法获取列表数据',
            idKey: 'id',
            parentKey: 'parent_id'
        },
        perPage: 20,
        total: 0,
        currentPage: 1,
        query: null,
        loading: false
    },
    getters: {
        list: (state) => state.list,
        query: (state) => {
            if (!state.query) {
                state.query = new TableQuery(state.perPage)
            }
            return state.query;
        },
        perPage: (state) => state.perPage,
        total: (state) => state.total,
        loading: (state) => state.loading,
        currentPage: (state) => state.currentPage,
        tree(state) {
            return DataHelper.getChildren(
                state.list,
                null,
                state.setting.idKey,
                state.setting.parentKey
            )
        }
    },

    mutations: {

        /**
         * 将一组item加入list
         *
         * @param state
         * @param list
         */
        setList(state,list) {
            if (list && _.isArray(list)) {
                state.list = list;
            }
        },

        /**
         * 将一个item加入list
         *
         * @param state
         * @param item
         */
        set(state,item) {
            if (item &&_.isObject(item)) {
                state.list.push(item);
            }
        },

        /**
         * 根据id删除一个item
         * @param state
         * @param id
         */
        remove(state,id) {
            if (_.findKey(state.list,{id: id})) {
                _.remove(state.list, item => item.id === id);
            }
        },

        resetQuery(state,perPage) {
            state.query = new TableQuery(perPage);
        },

        startLoading(state) {
            state.loading = true;
        },

        endLoading(state) {
            state.loading = false;
        },
        setTotal(state,total) {
            state.total = total;
        },

        setCurrentPage(state,currentPage) {
            state.currentPage = currentPage;
        },


    },
    actions: {

        /**
         * 从远程获取一组数据
         *
         * @param commit
         * @param state
         * @param getters
         * @param page 页码
         */
        getList({commit,state,getters}) {
            return new Promise((resolve,reject) => {
                commit('startLoading');
                this._vm.$axios.get(
                    state.setting.listUrl,
                    {
                        params: getters.query.getQuery(state.currentPage)
                    })
                    .then(RemoteHelper.createThen(data => {
                        if (data.status) {
                            commit('setList', data.data);
                            commit('setTotal', data.total);
                            commit('add',_.clone(data.data));
                        }
                        commit('endLoading');

                        resolve();
                    }))
                    .catch(RemoteHelper.createCatch(this._vm,commit,state.setting.listError,() => {
                        commit('endLoading');
                        reject();
                    }));
            });


        }
    }
};