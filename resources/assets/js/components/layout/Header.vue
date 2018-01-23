<template>
    <el-header id="header" height="50px">
        <div class="float-left" v-show="!sidebar.collapse">
            <button class="btn btn-outline-primary fixed-button" @click="collapseSideBar">
                <i class="fa fa-bars"></i>
            </button>
        </div>
        <div class="float-right">
            <el-dropdown class="dropdown">
                <span class="el-dropdown-link">
                    <i class="fa fa-user"></i>
                    {{admin.name}}
                    <i class="el-icon-arrow-down el-icon--right"></i>
                </span>
                <el-dropdown-menu slot="dropdown">
                    <el-dropdown-item>我的信息</el-dropdown-item>
                    <el-dropdown-item divided>退出</el-dropdown-item>
                </el-dropdown-menu>
            </el-dropdown>

            <button class="fixed-button btn btn-outline-primary">
                <i class="fa fa-gear fa-spin"></i>
            </button>
        </div>
    </el-header>
</template>

<script>
    import {mapGetters,mapMutations} from "vuex";


    export default {
        name: "pvc-header",
        computed: {
            ...mapGetters('auth',['admin']),
            ...mapGetters('layout',['sidebar'])
        },
        methods: {
            ...mapMutations('layout',['collapseSideBar'])
        }
    }
</script>

<style scoped lang="scss">
    @import "../../../sass/global/_variable.scss";

    #header {
        padding: 0;
        border-bottom: 1px solid;
        border-bottom-color: $main-color-bd;
        background: $white;
    }

    .fixed-button {
        border: none;
        width: 50px;
        height: 50px;
        border-radius: unset;
        font-size: 24px;

        &:last-child {
            border-left-width: 1px;
            border-left-color: $main-color-bd;
            border-left-style: solid;
        }

        &:first-child {
            border-right-width: 1px;
            border-right-color: $main-color-bd;
            border-right-style: solid;
        }
    }

    .dropdown {
        font-size: 16px;
        margin-right: 10px;
        color: $main-color-fg;
    }


</style>