<template>
    <div id="main">
        <el-card header="创建一个新的菜单">
            <el-form v-model="menu" :rules="rules" label-position="top">
                <el-form-item label="菜单名称">
                    <el-input v-model="menu.name" :required="true"/>
                </el-form-item>
                <el-form-item label="图标">
                    <el-input v-model="menu.icon"/>
                </el-form-item>
                <el-form-item label="权限">
                    <el-select v-model="menu.permission_id" value-key="id" default-first-option class="d-flex"
                               filterable remote :remote-method="searchPermission" :loading="permissionLoading">
                        <el-option v-for="permission in permissions" :key="permission.id"
                                   :label="permission.name" :value="permission.id">
                            <span class="float-left">{{permission.name}}</span>
                            <span class="float-right">{{permission.description}}</span>
                        </el-option>
                    </el-select>
                </el-form-item>
                <el-form-item label="上层菜单">
                    <el-cascader v-model="menu.parent_path" :props="menuProps" :options="menus" expand-trigger="hover"
                                 change-on-select :loading="menuLoading" class="d-flex" clearable placeholder="清空表示选择顶层菜单">
                    </el-cascader>
                </el-form-item>
                <el-form-item>
                    <el-button type="primary" @click="onSubmit" icon="fa fa-save" :autofocus="true">保存</el-button>
                    <pvc-button type="primary" url="/menu" icon="fa fa-list">列表</pvc-button>
                </el-form-item>
            </el-form>
        </el-card>
    </div>
</template>

<script>

    import {mapGetters,mapMutations,mapActions} from "vuex";

    export default {
        name: "pvc-menu-create",
        data() {
            return {
                menu: {
                    id: 0,
                    name: '',
                    icon: '',
                    url: '',
                    parent_id: 0,
                    permission_id: 0,
                    created_at: '',
                    updated_at: ''
                },
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
            ...mapGetters('permission',['current']),
            ...mapGetters('permission',{permissions:'filtered',permissionQuery:'filteredQuery',permissionLoading: 'loading'}),
            ...mapGetters('menu',{menus:'filteredTree',query:'filteredQuery',menuLoading: 'loading',empty: 'empty'}),
            parents() {
                let self = this;
                return _.filter(this.searches,menu => menu.id !== self.menu.id);
            },
            parentIds: {
                get() {
                    if (this.menu) {
                        return this.menu.path;
                    } else {
                        return [];
                    }
                },
                set(ids) {
                    if (ids.length) {
                        this.menu.parent_id = ids[ids.length-1];
                        this.menu.path = ids;
                    }
                    return ids;
                }
            },
            permissionId: {
                get() {
                    return this.menu.parent_id;
                },
                set(id) {
                    this.menu.parent_id = id;
                }
            }
        },
        methods: {
            ...mapActions('menu',['get','create']),
            ...mapActions('menu',{getParent:'getFiltered'}),
            ...mapMutations('menu',{resetParent: 'resetFilteredQuery'}),
            ...mapActions('permission',{getPermissions: 'getFiltered'}),
            ...mapMutations('permission',{resetPermissions: 'resetFilteredQuery'}),

            onSubmit(event) {
                event.preventDefault();
                this.create(this.menu)
                    .then(() => this.$router.push('/menu/'+this.current.id));
            },

            searchPermission(keyword) {
                this.permissionQuery.addSearch('name',keyword);
                this.resetPermissions();
                this.getPermissions();
            }
        },
        mounted() {
            this.menu.parent_id = this.$route.params.parent;
            if (this.menu.parent_id ) {
                this.get(this.menu.parent_id);
            }
            this.menu.permission_id = null;

            this.resetParent();
            this.getParent();
            this.resetPermissions();
            this.getPermissions();
        },
        beforeRouteUpdate (to, from, next) {
            this.menu.parent_id = this.$route.params.parent;
            this.get(this.$route.params.parent);
            if (this.menu.parent_id ) {
                this.get(this.menu.parent_id);
            }
            this.resetParent();
            this.getParent();
            this.resetPermissions();
            this.getPermissions();
            next();
        }
    }
</script>

<style scoped>

</style>