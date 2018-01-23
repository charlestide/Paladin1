<template>
    <el-card :header="'#'+menu.id+' 更新菜单的信息'" v-loading="menuLoading">
        <el-form v-model="menu" :rules="rules" label-position="top">
            <el-form-item label="菜单名称">
                <el-input v-model="menu.name" :required="true"/>
            </el-form-item>
            <el-form-item label="图标">
                <el-input v-model="menu.icon"/>
            </el-form-item>
            <el-form-item label="权限">
                <el-select v-model="menu.permission_id" value-key="id" default-first-option class="d-flex"
                           filterable remote :remote-method="searchPermission" :loading="permissionLoading" >
                    <el-option v-for="permission in permissions" :key="permission.id"
                               :label="permission.name" :value="permission.id">
                            <span class="float-left">{{permission.name}}</span>
                            <span class="float-right">{{permission.description}}</span>
                    </el-option>
                </el-select>
            </el-form-item>
            <el-form-item label="上层菜单">
                <el-cascader v-model="menu.parent_path" :props="menuProps" :options="menus" expand-trigger="hover"
                             change-on-select v-loading="menuLoading" class="d-flex" clearable placeholder="清空表示选择顶层菜单">
                </el-cascader>
            </el-form-item>
            <el-form-item>
                <pvc-button type="primary" @click="onSubmit" icon="fa fa-save" :autofocus="true">保存</pvc-button>
                <pvc-button type="primary" icon="fa fa-list" url="/menu">列表</pvc-button>
            </el-form-item>
        </el-form>
    </el-card>
</template>

<script>

    import {ElCascader} from "element-ui";

    import {mapGetters,mapMutations,mapActions,mapState} from "vuex";

    export default {
        name: "pvc-menu-edit",
        data() {
            return {
                rules: {
                    name: [
                        {required: true, message: '请输入菜单名称', trigger: 'blur'},
                        {min: 3, max: 30, message: '长度在 3 到 30 个字符', trigger: 'blur'}
                    ]
                },
                menuProps: {
                    label: 'name',
                    value: 'id',
                    children: 'children',
                },
            }
        },
        computed: {
            ...mapGetters('menu',{menus:'filteredTree',query:'filteredQuery',menuLoading: 'loading',menu:'current'}),
            ...mapGetters('permission',{permissions:'filtered',permissionQuery:'filteredQuery',permissionLoading: 'loading'}),

        },
        methods: {
            ...mapActions('menu',['get','save']),
            ...mapActions('menu',{getParent:'getFiltered'}),
            ...mapMutations('menu',{resetParent: 'resetFilteredQuery'}),
            ...mapActions('permission',{getPermissions: 'getFiltered'}),
            ...mapMutations('permission',{resetPermissions: 'resetFilteredQuery'}),

            onSubmit(event) {
                event.preventDefault();
                let menu = _.clone(this.menu);
                this.save(menu);
            },
            searchPermission(keyword) {
                this.permissionQuery.addSearch('name',keyword);
                this.resetPermissions();
                this.getPermissions();
            },

            init() {
                this.query.addExcept('id',this.$route.params.id);
                this.resetParent();
                this.resetPermissions();
                this.getPermissions();
                this.getParent();
                this.get(this.$route.params.id);
            },
        },
        created() {
            this.init();
        },
        beforeRouteUpdate (to, from, next) {
            this.init();
            next();
        }
    }
</script>

<style scoped>
</style>