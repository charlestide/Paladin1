<template>
    <el-container fluid id="login" align-h="center" align-v="center">
            <el-row align-h="center"><img src="/logo.png" /></el-row>
            <br/>
            <br/>
            <el-form v-model="form">
                <el-form-item>
                        <el-input type="text" id="username" name="username" :state="validation.username.state"
                                      :required="true" v-model="form.username" placeholder="请输入用户名或邮箱" />
                        <div class="form-invalid-feedback" id="username-invalid">
                            {{validation.username.error}}
                        </div>
                </el-form-item>
                <el-form-item>
                    <el-input type="password" id="password" :state="validation.password.state"
                                  name="password" v-model="form.password" :required="true"
                                  placeholder="请输入密码"/>
                    <div class="form-invalid-feedback" id="password-invalid">
                        {{validation.password.error}}
                    </div>
                </el-form-item>
                <el-form-item v-show="message">
                    <p>{{message}}</p>
                </el-form-item>
                <el-form-item>
                    <el-button type="primary" @click="onSubmit" :autofocus="true">登陆</el-button>
                </el-form-item>
            </el-form>
    </el-container>
</template>

<script>

    import {mapMutations,mapGetters,mapActions} from "vuex";

    export default {
        name: "pvc-login",
        data() {
            return {
                form: {
                    username: '',
                    password: '',
                },
                validation: {
                    username: {
                        state: true,
                        error: ''
                    },
                    password: {
                        state: true,
                        error: ''
                    }
                },
                message: ''
            }
        },
        computed: {
            ...mapGetters('layout',['lastPage']),
            ...mapGetters('auth',['clientId','clientSecret'])
        },
        methods: {
            ...mapMutations('auth',['setToken','setClient']),
            ...mapActions('auth',['getAdmin']),

            onSubmit(event) {
                event.preventDefault();
                if (this.clientId) {
                    this.getToken();
                } else {
                    this.getClient(this.getToken);
                }
            },
            getClient(callback) {
                this.$axios.post('/auth/client',this.form)
                    .then(response => {
                        this.setClient({
                            clientId: response.data.data.id,
                            clientSecret: response.data.data.secret
                        });
                        callback();
                    })
                    .catch(error => {
                        this.message = error.response.data.message;
                    })
            },
            getToken() {
                this.$axios.post('/oauth/token',{
                        client_id: this.clientId,
                        client_secret: this.clientSecret,
                        grant_type: 'password',
                        username: this.form.username,
                        password: this.form.password,
                        guard: 'admin'
                    })
                    .then((response) => {
                        if (_.has(response,'data.access_token') && _.has(response,'data.refresh_token')) {
                            this.setToken(response.data);
                            this.getAdmin();

                            if (this.lastPage) {
                                this.$router.push(this.lastPage);
                            } else {
                                this.$router.push('/');
                            }
                        }
                        return response;
                    }).catch((error) => {
                    if (error.response && error.response.data) {
                        let data = error.response.data;
                        if (_.has(data,'errors.password')) {
                            this.validation.password.state = false;
                            this.validation.password.error = _.get(data,'errors.password[0]');
                        }
                    }
                    return Promise.reject(error.response)
                });
            }
        }
    }
</script>

<style scoped>
    #login {
        padding: 25%;
        height:100%;
        min-height: 100%;
    }
</style>