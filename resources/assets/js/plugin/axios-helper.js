
class AxiosHelper {

    constructor(router) {
        this.router = router;
    }

    static install(Vue,options = {}) {
        let axios = require('axios'),
            axiosHelper = new AxiosHelper(options.router);
        axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
        axios.defaults.headers.common['X-CSRF-TOKEN'] = options.csrf;
        // axios.defaults.headers.common['Authorization'] = 'Bearer ' + sessionStorage.getItem('access-token');
        // axios.defaults.headers.post['content-type'] = 'application/x-www-form-urlencoded';

        axios.interceptors.request.use(config => {
            if (config.url !== '/oauth/token') {
                config.headers['Authorization'] = 'Bearer ' + sessionStorage.getItem('access-token');
            }

            if(config.method  === 'post'){
                // JSON 转换为 FormData
                const formData = new FormData();
                Object.keys(config.data).forEach(key => formData.append(key, config.data[key]));
                config.data = formData
            }
            return config
        });

        axios.interceptors.response.use(
            response => {
                //如果token快过期了，就刷新token
                if (AxiosHelper.isTokenExpired()) {
                    axiosHelper.refreshToken(axios);
                }

                 return response;
            },error => {
                if (error.response) {
                    switch (error.response.status) {
                        case 400:
                        case 401:
                            axiosHelper.router.push('/login');
                            break;
                        case 405:
                            axiosHelper.notAllow();
                            break;
                    }
                } else {
                    // console.error(error.message);
                }

                return Promise.reject(error);
            }
        );
        Vue.prototype.$axios = axios;
    }

    refreshToken(axios) {
        let data = {
            grant_type: 'refresh_token',
            refresh_token: sessionStorage.getItem('refresh-token'),
            client_id: localStorage.getItem('client-id'),
            client_secret: localStorage.getItem('client-secret')
        };
        sessionStorage.removeItem('access-token');
        sessionStorage.removeItem('expires_at');
        sessionStorage.removeItem('refresh-token');

        axios.post('/oauth/token',data)
            .then(response => {
                sessionStorage.setItem('access-token',response.data.access_token);
                sessionStorage.setItem('refresh-token',response.data.refresh_token);
                sessionStorage.setItem('expires_at',(new Date()).getTime() + response.data.expires_in);
            }).catch(error => {
                console.error(error.response);
                this.router.push('/login');
            });
    }

    static isTokenExpired() {
        let expiresAt = sessionStorage.getItem('expires_at');
        if (expiresAt) {

            // let get = new Date();
            // get.setTime(expiresAt * 1000);
            // console.log('get expires at ' + get);

            // console.log('current ' + (new Date()));
            return expiresAt - (new Date).getTime() / 1000 <= 60;
        } else {
            return false;
        }
    }

    notAllow() {
        alert('您没有权限进行此操作');
    }
}

export default AxiosHelper;