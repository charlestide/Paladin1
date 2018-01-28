
const PVC_ADMIN = 'pvc-admin';

export default {
    namespaced: true,
    state: {
        admin: {
            id: 0,
            name: 'nobody'
        },
        clientId: 0,
        clientSecret: '',
    },
    getters: {
        admin: (state) => state.admin,
        accessToken: (state) => sessionStorage.getItem('access-token'),
        refreshToken: (state) => sessionStorage.getItem('refresh-token'),
        clientId: (state) => {
            if (!state.clientId) {
                state.clientId = sessionStorage.getItem('client-id');
            }
            return state.clientId;
        },
        clientSecret: (state) => {
            if (!state.clientSecret) {
                state.clientSecret = sessionStorage.getItem('client-secret');
            }
            return state.clientSecret;
        }
    },
    mutations: {
        login(state,admin) {
           state.admin =  admin;
           state.logined = true;
           sessionStorage.setItem(PVC_ADMIN, JSON.stringify(admin));
        },
        logout(state) {
            state.logined = false;
            state.admin =  {
                id: 0,
                name: 'nobody'
            };
            sessionStorage.removeItem(PVC_ADMIN);
            sessionStorage.removeItem('access-token');
            sessionStorage.removeItem('refresh-token');
            sessionStorage.removeItem('expires_at');
        },
        setToken(state,{access_token,refresh_token,expires_in}) {
            sessionStorage.setItem('access-token',access_token);
            sessionStorage.setItem('refresh-token',refresh_token);

            // console.log('expires in ' + expires_in);
            let currentTimestamp = (new Date()).getTime() / 1000;
            sessionStorage.setItem('expires_at', currentTimestamp + expires_in);

            // let exp = new Date();
            // exp.setTime(currentTimestamp * 1000);
            // console.log('expires at ' + exp );
        },
        setClient(state,{clientId,clientSecret}) {
            state.clientId = clientId;
            state.clientSecret = clientSecret;
            localStorage.setItem('client-id',clientId);
            localStorage.setItem('client-secret',clientSecret);
        },
    },
    actions: {
        getAdmin({commit,state}) {
            this._vm.$axios.get('/me')
                .then(response => {
                    if (_.has(response,'data') && _.isObject(response.data)) {
                        commit('login', response.data);
                    }
                })
                .catch(error => {
                    console.log(error);
                    return error;
                })
        }
    }
};