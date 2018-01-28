
import RemoteHelper from "../helper/remote";
import Database from "../database/database";
import Definition from "../definition";
import TableQuery from "../../modules/table-query";

const UrlMethods = ['get','put','delete','patch','post'];

export default {
    init(settings) {
        Database.registerTable(settings.name,settings.idKey);

        if (!settings.restful) {
            _.each(settings, (value, key) => {
                if (_.includes(['get', 'save', 'create', 'delete'], key)) {
                    value.url = value.url.replace(':name', settings.name);
                }
            });
        }
    },
    namespace: true,
    contract: {
        name: String,
        idKey: String,
        idKeyType: [String,Number],
        restful: Boolean,
        get: {
            url: String,
            method: UrlMethods,
            error: String
        },
        save: {
            url: String,
            method: UrlMethods,
            error: String
        },
        create: {
            url: String,
            method: UrlMethods,
            error: String
        },
        delete: {
            url: String,
            method: UrlMethods,
            error: String,
        },
        list: {
            url: String,
            method: UrlMethods,
            error: String
        },
        prototype: Object,
        getter: Function,
        setter: Function
    },

    defaults: {
        idKey: 'id',
        idKeyType: Number,
        restful: true,
        get: {
            url: '/:name/:id',
            method: 'get',
            error: '无法获取单个数据'
        },
        save: {
            url: '/:name/:id',
            method: 'put',
            error: '无法更新数据'
        },
        create: {
            url: '/:name',
            method: 'post',
            error: '无法创建数据'
        },
        delete: {
            url: '/:name/:id',
            method: UrlMethods,
            error: '无法删除数据',
        },
        list: {
            url: '/:name',
            method: UrlMethods,
            error: '无法获取数据列表',
        },
        setter(value) {
            return value;
        },
        getter(value) {
            return value;
        }
    },
    state: {
        id: 0,
        index: 0,
        empty: {},
        current: {},
        list: [],
        pageLength: 20,
        page: 1,
        total: 0
    },
    getters: {
        [Definition.STORE_GETTER_EMPTY] : (state) => _.clone(state.empty),
        [Definition.STORE_GETTER_CURRENT](state) {
            if (_.isEmpty(state.current)) {
                return _.clone(state.empty);
            } else {
                return state.current;
            }
        },
        [Definition.STORE_GETTER_LIST]: (state) => state.list,
        [Definition.STORE_GETTER_TOTAL]: (state) => state.total,
        [Definition.STORE_GETTER_PAGE_LENGTH]: (state) => state.pageLength,
        [Definition.STORE_GETTER_PAGE]: (state) => state.page,
        [Definition.STORE_GETTER_QUERY]: (state) => {
            if (!state.query) {
                state.query = new TableQuery(state.perPage)
            }
            return state.query;
        },
    },

    mutations: {
        /**
         * 设置current
         *
         * @param state
         * @param item
         */
        setCurrent(state,item) {
            if (item) {
                state.current = item;
            }
        },

        /**
         * 获取list
         *
         * @param state
         * @param items
         * @param total
         */
        setList(state,{items,total}) {
            state.list = items;
            state.total = total;
        },

        /**
         * 设定当前页码
         *
         * @param state
         * @param currentPage
         */
        [Definition.STORE_MUTATION_SET_PAGE](state,currentPage) {
            state.page = currentPage;
        },

        [Definition.STORE_MUTATION_RESET_QUERY](state) {
            state.query = new TableQuery(state.perPage)
        }
    },
    actions: {

        /**
         * 加入数据库
         *
         * @param state
         * @param commit
         * @param items
         */
        put({state,commit},items) {
            Database.put(state.settings.name,items);
        },

        /**
         * 从数据库中删除
         *
         * @param dispatch
         * @param id
         */
        delete({dispatch},id) {
            let table = Database.table(state.name);
            table.delete(id);
            dispatch('setCurrent',0);
        },

        [Definition.STORE_ACTION_GET]({state,commit,dispatch},id) {
            id = state.settings.idKeyType(id);

            Database.get(state.settings.name,id).then((item) => {
                if (item) {
                    commit('setCurrent', item);
                } else {
                    dispatch(Definition.STORE_ACTION_LOAD,id);
                }
            });
        },

        /**
         * 从远程获取一个数据
         *
         * @param commit
         * @param state
         * @param getters
         * @param dispatch
         * @param id
         */
        [Definition.STORE_ACTION_LOAD]({commit,state,getters,dispatch},id) {
            return new Promise((resolve,reject) => {
                commit(Definition.COMMON_MUTATION_START_LOAD,null,{root:true});

                //判断请求的item是否已经下载
                this._vm.$axios.get(state.settings.get.url.replace(':id',id))
                    .then(response => {

                        let item = state.settings.getter(response.data.data);

                        commit('setCurrent',_.clone(item));
                        dispatch('put',item);
                        commit(Definition.COMMON_MUTATION_END_LOAD,null,{root:true});
                        resolve(response.data.data);
                    })
                    .catch((error) => {
                        commit(Definition.COMMON_MUTATION_END_LOAD,null,{root:true});
                        reject(error);
                    });
            })
        },

        /**
         * 向远程保存一个item
         *
         * @param commit
         * @param state
         * @param dispatch
         * @param item
         */
        [Definition.STORE_ACTION_UPDATE]({commit,state,dispatch},item) {
            item = state.settings.setter(item);
            return new Promise((resolve,reject) => {
                this._vm.$axios.put(
                    state.settings.save.url.replace(':id',item.id),
                    item
                )
                    .then(response => {
                        let item = state.settings.getter(response.data.data);
                        dispatch('put',item);
                        commit('setCurrent',_.clone(item));

                        commit(Definition.COMMON_MUTATION_RESET_REMOTE_FORM_ERROR,null,{root:true});
                        commit(Definition.COMMON_MUTATION_END_LOAD,null,{root:true});

                        RemoteHelper.showRemoteMessage(this._vm,response);
                        resolve(item);
                    })
                    .catch((error) => {
                        commit(Definition.COMMON_MUTATION_END_LOAD,null,{root:true});

                        commit(Definition.COMMON_MUTATION_SET_REMOTE_FORM_ERROR ,error,{root:true});
                        RemoteHelper.showRemoteError(this._vm,error,state.settings.save.error);

                        return error.response;
                    });
            })

        },

        /**
         * 向远程创建一个item
         *
         * @param commit
         * @param state
         * @param dispatch
         * @param item
         */
        [Definition.STORE_ACTION_CREATE]({commit,state,dispatch},item) {

            item = state.settings.setter(item);

            return new Promise((resolve,reject) => {

                this._vm.$axios.post(state.settings.create.url,item)
                    .then(RemoteHelper.createThen(response => {
                        let item = state.settings.getter(response.data.data);

                        dispatch('put',item);
                        commit('setCurrent',_.clone(item));
                        commit(Definition.COMMON_MUTATION_RESET_REMOTE_FORM_ERROR,null,{root:true});

                        RemoteHelper.showRemoteMessage(this._vm,response);
                        resolve(data);

                    }))
                    .catch((error) => {
                        commit(Definition.COMMON_MUTATION_END_LOAD,null,{root:true});
                        commit(Definition.COMMON_MUTATION_SET_REMOTE_FORM_ERROR ,error,{root:true});

                        RemoteHelper.showRemoteError(this._vm,error,state.settings.create.error);
                        reject(error.response);
                    })
            })

        },

        /**
         * 向远程删除一个item
         *
         * @param commit
         * @param state
         * @param dispatch
         * @param id
         */
        [Definition.STORE_ACTION_DELETE]({commit,state,dispatch},id) {
            return new Promise((resolve,reject) => {
                this._vm.$axios.delete(state.settings.delete.url.replace(':id',id))
                    .then(response => {
                        dispatch('delete',id);

                        commit(Definition.COMMON_MUTATION_END_LOAD,null,{root:true});
                        RemoteHelper.showRemoteMessage(this._vm,data);
                        resolve(response);
                    })
                    .catch((error) => {
                        RemoteHelper.showRemoteError(this._vm,error,state.settings.delete.error);

                        commit(Definition.COMMON_MUTATION_END_LOAD,null,{root:true});
                        reject(error);
                    })
            });

        },

        /**
         * 远程获取列表
         *
         * @param commit
         * @param state
         * @param getters
         * @param dispatch
         * @returns {Promise<any>}
         */
        [Definition.STORE_ACTION_LIST]({commit,state,getters,dispatch}) {
            return new Promise((resolve,reject) => {
                commit(Definition.COMMON_MUTATION_START_LOAD,null,{root:true});
                this._vm.$axios.get(
                    state.settings.list.url,
                    {
                        params: getters[Definition.STORE_GETTER_QUERY].getQuery(state.page)
                    })
                    .then(response => {
                        let items = response.data.data;
                        commit('setList', {
                            items: items,
                            total: response.data.total
                        });
                        dispatch('put',_.clone(items));
                        commit(Definition.COMMON_MUTATION_END_LOAD,null,{root:true});
                        resolve(items);
                    })
                    .catch((error) => {
                        RemoteHelper.showRemoteError(this._vm,error,state.settings.list.error);
                        commit(Definition.COMMON_MUTATION_END_LOAD,null,{root:true});
                        reject(error);
                    });
            });
        }
    }
};