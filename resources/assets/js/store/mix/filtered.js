
import TableQuery from "../../modules/table-query";
import RemoteHelper from "../helper/remote";
import FormattingHelper from "../helper/formatting";
import DataHelper from "../helper/data";

export default {
    state: {
        /**
         * 存储过滤后一个二维数据
         */
        filtered: [],
        setting: {
            listUrl: '',
            listError: '无法获取列表数据',
            idKey: 'id',
            parentKey: 'parent_id'
        },
        filteredLimit: 20,
        filteredQuery: null,
        loading: false,
        empty: {}
    },
    getters: {
        filtered: (state) => state.filtered,
        filteredQuery: (state) => {
            if (!state.filteredQuery) {
                state.filteredQuery = new TableQuery(state.filteredLimit)
            }
            return state.filteredQuery;
        },
        filteredLimit: (state) => state.filteredLimit,
        loading: (state) => state.loading,

        filteredTree(state) {
            if (state.filtered) {
                return DataHelper.getChildren(
                    state.filtered,
                    null,
                    state.setting.idKey,
                    state.setting.parentKey
                )
            }
        }
    },

    mutations: {

        /**
         * 将一组item加入filtered
         *
         * @param state
         * @param filtered
         */
        setFiltered(state,filtered) {
            if (filtered) {
                state.filtered = filtered;
            }
        },

        setFilteredOne(state,item) {
            if (item &&_.isObject(item)) {
                let index = 0, filtered = _.clone(state.filtered);
                if (index =_.findIndex(filtered,{id:item.id})) {
                    filtered[index] = item;
                    state.filtered = filtered;
                } else {
                    state.filtered.push(item);
                }
            }
        },

        /**
         * 根据id删除一个item
         * @param state
         * @param id
         */
        removeFiltered(state,id) {
            let filtered = _.clone(state.filtered);
            _.remove(filtered, item => item.id === id);

            if (filtered.length !== state.filtered.length) {
                state.filtered = filtered;
            }
        },

        resetFilteredQuery(state,limit) {
            state.filteredQuery = new TableQuery(limit);
        },

        startLoading(state) {
            state.loading = true;
        },

        endLoading(state) {
            state.loading = false;
        },
    },
    actions: {

        /**
         * 从远程获取一组数据
         *
         * @param commit
         * @param state
         * @param getters
         * @param limit 最多获取条数
         */
        getFiltered({commit,state,getters},limit) {
            return new Promise((resolve,reject) => {
                commit('startLoading');
                if (limit) {
                    state.filteredQuery.setPerPage(limit);
                }
                this._vm.$axios.get(
                    state.setting.listUrl,
                    {
                        params: getters.filteredQuery.getQuery()
                    })
                    .then(response => {
                        let data = response.data.data;
                        commit('setFiltered', data);
                        commit('add',_.clone(data));
                        commit('endLoading');

                        resolve(data);
                    })
                    .catch((error) => {
                        RemoteHelper.showRemoteError(this._vm,error,state.setting.listError);

                        commit('endLoading');
                        reject(error);
                    });
            })


        }
    }
};