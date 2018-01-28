<template>
    <el-aside :width="sidebarWidth" id="sidebar-left" class="bg-dark text-light" v-loading="menuLoading"
              element-loading-text="正在加载菜单" >
        <el-row class="text-algin">
            <div class="brand bg-primary text-center" v-show="!sidebar.collapse">
                <a href="/">
                    <img class="logo" src="/logo.png" alt="brand logo" width="150" height="45" />
                </a>
            </div>
            <button class="btn btn-outline-primary fixed-button" v-show="sidebar.collapse" @click="expandSideBar">
                <i class="fa fa-bars"></i>
            </button>
        </el-row>
        <el-row class="bg-dark">
            <div class="avatar-info" v-show="!sidebar.collapse">
                <h6 class="media-heading">
                    <div class="avatar fa fa-user" width="50"></div>
                       <span style="margin-left: 10px">欢迎, {{admin.name}}</span>
                </h6>
                <small><i class="fa fa-envelope" style="margin-right: 10px;"></i> {{admin.email}}</small>
            </div>
            <div class="avatar-info" v-show="sidebar.collapse">
                <div class="avatar fa fa-user"></div>
            </div>
        </el-row>
        <el-row id="menu-row" >
            <el-menu background-color="#2a2a2a" active-text-color="#fff" text-color="#999"
                     :unique-opened="true" default-active="1" :collapse="sidebar.collapse"
                     :router="true" :default-active="$route.path" :default-openeds="['']">
                <el-submenu v-for="(menu,menuIndex) in menus" :key="menu.id" :index="menu.url || String(menu.id)">
                    <template slot="title">
                            <i :class="['fa','fa-'+menu.icon,'icon']"></i>
                            <span class="text">{{menu.name}}</span>
                    </template>

                    <el-menu-item v-for="(submenu,submenuIndex) in menu.submenus" :index="submenu.url || String(menu.id)"
                                  :key="submenu.id">
                        <template slot="title">
                                <i :class="['fa','fa-'+submenu.icon,'icon']"></i>
                                <span>{{submenu.name}}</span>
                        </template>
                    </el-menu-item>
                </el-submenu>
            </el-menu>
        </el-row>
    </el-aside>
</template>

<script>
    import {mapGetters,mapMutations,mapActions,mapState} from "vuex";

    export default {
        name: "pvc-aside",
        data() {
            return {
                menuLoading: true

            }
        },
        computed: {
            ...mapGetters('auth',['admin']),
            ...mapGetters('layout',['sidebar']),
            ...mapState('layout',['menus']),
            sidebarWidth() {
                return this.sidebar.collapse ? '65px' : '200px';
            }
        },
        created() {
            this.getMenus()
                .then(() => {
                    this.menuLoading = false;
                })
        },

        methods: {
            ...mapMutations('layout',['expandSideBar']),
            ...mapActions('layout',['getMenus'])
        }
    }
</script>

<style scoped lang="scss">
    @import "../../../sass/global/_variable.scss";

    .brand {
        height: 50px;
        width: 100%;
        left: 0;
        display:block;
    }

    .avatar-info {
        padding: 15px 10px;

        .avatar {
            width: 50px;
            height: 50px;
            padding: 8px 13px;
            font-size: 30px;
            border: 1px solid $primary-color-bg;
            color: $primary-color-bg;
            border-radius: 50%;
        }
    }

    #sidebar-left {
        height:100%;
        min-height: 100%;
        color: $secondary-color-fg;
    }

    .el-menu {
        border-right: none;

    }

    .is-active {
        color: $secondary-color-fg;

        > .icon {
            background: $primary-color-bg;
        }
    }

    .icon {
        border:2px solid $secondary-color-fg;
        border-radius: 50%;
        text-align: center;
        padding: 5px;
        width: 30px;
        height: 30px;
    }

    .text {
        margin-left: 10px;
    }

    .fixed-button {
        border: none;
        width: 100%;
        height: 50px;
        border-radius: unset;
        font-size: 24px;
        margin: 0 auto;
    }


</style>