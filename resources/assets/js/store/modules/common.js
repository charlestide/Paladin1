import Definition from "../definition";

export default {
    namespace: false,
    state: {
        loading: false,

    },
    getters: {
        [Definition.COMMON_GETTER_LOADING]: (state) => state.loading,

    },
    mutations: {
        [Definition.COMMON_MUTATION_START_LOAD](state) {
            state.loading = true;
        },

        [Definition.COMMON_MUTATION_END_LOAD](state) {
            state.loading = false;
        },
    }
}