<template>
    <div id="init">
        <h3>{{message}}</h3>
        <h5>
            <el-progress type="line" :stroke-width="20" :text-inside="true" :percentage="percent" class="text-algin"/>
        </h5>
        <h4>{{componentMessage}}</h4>
    </div>
</template>

<script>
    import {mapGetters,mapActions} from 'vuex';
    import Definition from "../../store/definition";

    export default {
        name: "pvc-init",
        data() {
            return {
                message: '正在检测用户状态...'
            }
        },
        computed: {
            ...mapGetters('auth',['admin','accessToken','clientId']),
            ...mapGetters('loader',['isInitialized','count','remain','loadingName']),
            ...mapGetters('layout',['lastPage']),
            percent() {
                if (this.remain <= 0) {
                    return 100;
                } else {
                    return Math.ceil((this.count - this.remain) / this.count * 100);
                }
            },
            componentMessage() {
                if (this.remain <= 0) {
                    this.complete();
                    return '组件加载完成 '+ this.count + '/' + this.count;
                } else {
                    return '加载组件：'+ this.loadingName + ' ' + (this.count - this.remain) +'/'+ this.count;
                }
            }
        },
        methods: {
            ...mapActions('auth',['getAdmin']),
            complete() {
                // if (this.remain <= 0) {
                    //如果登陆成功,则读取用户最后访问的页面，跳转之
                    if (this.lastPage && this.lastPage.toLowerCase() !== '/init') {
                        this.$router.push(this.lastPage);
                    } else {
                        this.$router.push('/');
                    }
                // }
            }
        },
        mounted() {
            if (this.accessToken) {
                this.getAdmin();
                this.complete();
            } else {
                this.$router.push('/login');
            }
        }
    }
</script>

<style scoped>
    #init {
        height:100%;
        width:100%;
        text-align: center;
        vertical-align: middle;
        margin-top: 30%;
        padding: 20%;
        padding-top: 0;
    }
</style>