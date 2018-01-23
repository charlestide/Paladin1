<template>
    <footer id="components-loader" :v-show="show">
        <span>{{message}}</span>
    </footer>
</template>

<script>

    import {mapGetters,mapActions} from 'vuex';

    export default {
        name: "component-loader",
        props: {
            componentName: String
        },

        computed: {

            show() {
                return this.remain > 0 ? 'ok' : 'no';
            },
            message() {
                if (this.remain <= 0) {
                    return '全部加载完成 '+ this.count + '/' + this.count;
                } else {
                    return '正在加载：'+ this.loadingName + ' ' + (this.count - this.remain) +'/'+ this.count;
                }
            }
        },
    }
</script>

<style scoped lang="scss">

    @import "../../../sass/global/_variable.scss";

    #components-loader {
        line-height: 40px;
        background: $primary-color-bg;
        color: $primary-color-fg;
        display: block;
        width: 100%;
        height: 40px;
        position: absolute;
        bottom: 0px;
        text-align: center;
    }
</style>