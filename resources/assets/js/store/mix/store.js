
import Vue from "vue";
import RemoteHelper from "../helper/remote";

export default {
    state: {
        /**
         * 存储一个二维数据
         */
        store: {},

        setting: {
            getUrl: '',
            getError: '无法获取单个数据',
            saveUrl: '',
            saveError: '无法更新数据',
            createUrl: '',
            createError: '无法创建数据',
            deleteUrl: '',
            deleteError: '无法删除数据',
        },
        loading: false,
        index: 0,
        current: {}
    },
    getters: {
        store: (state) => state.store,
        empty: (state) => _.clone(state.empty),
        getById: (state) => (id) => {
            if (_.has(state.store,id)) {
                return _.get(state.store, id);
            } else if (_.has(state,'list') && _.findIndex(state.list,{id: id})) {
                return _.find(state.list,{id:id});
            } else if (_.has(state,'filtered') && _.findIndex(state.filtered,{id: id})) {
                return _.find(state.filtered,{id:id});
            } else {
                return state.empty;
            }
        },
        loading: (state) => state.loading,
        path: (state) => {
            if (state.store[state.index] && _.has(state.store[state.index],'path')) {
                return state.store[state.index].path;
            } else {
                return _.clone(state.empty).path;
            }
        },
        current(state) {
            if (_.isEmpty(state.current)) {
                return _.clone(state.empty);
            } else {
                return state.current;
            }
        },
        has: (state) => (id) => {
            if (_.has(state.store,id)) {
                return true;
            } else if (_.has(state,'list') && _.findIndex(state.list,{id: id})) {
                return true;
            } else if (_.has(state,'filtered') && _.findIndex(state.filtered,{id:id})) {
                return true;
            } else {
                return false;
            }
        }
    },

    mutations: {

        /**
         * 将一组item加入list
         *
         * @param state
         * @param items
         */
        add(state,items) {
            if (!_.isArray(items)) {
                items = [items];
            }
            if (items) {
                for (let item of items) {
                    if (!_.has(state.store, item.id)) {
                        //加入列表中
                        Vue.set(state.store, item.id, item);
                    }
                }
            }
        },

        /**
         * 删除一个item
         *
         * @param state
         * @param id
         */
        delete(state,id) {
            if (_.has(state.store,id)) {
                Vue.delete(state.store,id);
            }
        },

        /**
         * 更新一个item
         *
         * @param state
         * @param item
         */
        update(state,item) {
            if (_.has(state.store,item.id)) {
                if (_.has(state,'formatting')) {
                    item = state.formatting(item);
                }
                Vue.set(state.store,item.id,item);
            }
        },

        startLoading(state) {
            state.loading = true;
        },

        endLoading(state) {
            state.loading = false;
        },

        setCurrent(state,item) {
            //格式化
            if (_.has(state,'fromRemote')) {
                item = state.fromRemote(item);
            }

            state.current = item;
        }

    },
    actions: {

        /**
         * 从远程获取一个数据
         *
         * @param commit
         * @param state
         * @param getters
         * @param id
         */
        get({commit,state,getters},id) {
            return new Promise((resolve,reject) => {
                commit('startLoading');

                //判断请求的item是否已经下载
                if (id > 0 && getters.has(id)) {
                    this._vm.$axios.get(state.setting.getUrl.replace(':id',id))
                        .then(response => {
                            commit('setCurrent',_.clone(response.data.data));
                            commit('endLoading');
                            resolve(response.data.data);
                        })
                        .catch((error) => {
                            commit('endLoading');
                            reject(error);
                        });
                } else {
                    commit('setCurrent',getters.getById(id));
                    resolve();
                }
            })


        },

        /**
         * 向远程保存一个item
         *
         * @param commit
         * @param state
         * @param item
         */
        save({commit,state},item) {
            return new Promise((resolve,reject) => {
                if (_.has(state,'toRemote')) {
                    item = state.toRemote(item);
                }

                this._vm.$axios.put(
                    state.setting.saveUrl.replace(':id',item.id),
                    item
                )
                    .then(response => {
                        let data = response.data.data;
                        commit('update',data);
                        commit('set',data);
                        commit('setCurrent',_.clone(data));
                        commit('resetFormError',null,{root:true});
                        RemoteHelper.showRemoteMessage(this._vm,response);
                        resolve(data);
                    })
                    .catch((error) => {
                        commit('endLoading');
                        commit('setFormError',error,{root:true});
                        RemoteHelper.showRemoteError(this._vm,error,state.setting.saveError);

                        return error.response;
                    });
            })

        },

        /**
         * 向远程创建一个item
         *
         * @param commit
         * @param state
         * @param item
         */
        create({commit,state},item) {
            return new Promise((resolve,reject) => {
                if (_.has(state,'toRemote')) {
                    item = state.toRemote(item);
                }

                this._vm.$axios.post(state.setting.createUrl,item)
                    .then(RemoteHelper.createThen(response => {
                        let data = response.data.data;
                        commit('add',data);
                        commit('set',data);
                        commit('setCurrent',_.clone(data));

                        RemoteHelper.showRemoteMessage(this._vm,response);
                        resolve(data);

                    }))
                    .catch((error) => {
                        commit('endLoading');
                        RemoteHelper.showRemoteError(vm,error,state.setting.createError);
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
        delete({commit,state,dispatch},id) {
            return new Promise((resolve,reject) => {
                this._vm.$axios.delete(state.setting.deleteUrl.replace(':id',id))
                    .then(response => {
                        commit('delete',id);
                        commit('remove',id);
                        commit('removeFiltered',id);

                        RemoteHelper.showRemoteMessage(this._vm,data);
                        resolve(response);
                    })
                    .catch((error) => {
                        RemoteHelper.showRemoteError(vm,error,state.setting.deleteError);

                        commit('endLoading');
                        reject(error);
                    })
            });

        }
    }
};