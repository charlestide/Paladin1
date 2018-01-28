
import Definition from "../definition";

export default {
    state: {
        formError: {}
    },

    getters: {
        [Definition.COMMON_GETTER_REMOTE_FORM_ERROR](state) {
            return state.formError;
        }
    },

    mutations: {
        [Definition.COMMON_MUTATION_SET_REMOTE_FORM_ERROR](state,error) {
            if (_.has(error,'response.data.errors')) {
                state.formError = error.response.data.errors;
            } else {
                state.formError = error;
            }
        },

        [Definition.COMMON_MUTATION_RESET_REMOTE_FORM_ERROR](state) {
            state.formError = {}
        }
    },
}