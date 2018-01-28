<template>
    <el-form :model="admin" :rules="rules" ref="form">
        <el-card :header="'#'+$route.params.id+' '+admin.name" v-loading="loading">
            <el-tabs>
                <el-tab-pane label="基本信息">
                    <el-form-item label="用户名" prop="name">
                        <el-input v-model="admin.name"/>
                    </el-form-item>
                    <el-form-item label="邮箱" prop="email">
                        <el-input v-model="admin.email"/>
                    </el-form-item>
                    <el-form-item label="密码" prop="password">
                        <el-input type="password" v-model="admin.password"/>
                    </el-form-item>
                    <el-form-item label="描述">
                        <el-input v-model="admin.description" type="textarea"/>
                    </el-form-item>
                    <el-form-item label="状态">
                        <el-switch v-model="admin.status"/>
                    </el-form-item>
                </el-tab-pane>
                <el-tab-pane label="分配角色">
                    <el-form-item>
                        <el-transfer filterable v-model="admin.roleNames" :titles="['可选择','已分配']"
                                     :data="roles" :props="{key:'name',label:'name'}"/>
                    </el-form-item>
                </el-tab-pane>
                <el-tab-pane label="分配权限">
                    <el-form-item>
                        <el-transfer filterable v-model="admin.permissionNames" :titles="['可选择','已分配']"
                                     :data="permissions" :props="{key:'name',label:'name'}"/>
                    </el-form-item>
                </el-tab-pane>
            </el-tabs>
            <el-form-item>
                <pvc-button type="primary" @click="onSubmit" icon="fa fa-save">保存</pvc-button>
                <pvc-button type="primary" icon="el-icon-view" :url="'/admin/'+$route.params.id">查看</pvc-button>
                <pvc-button type="primary" icon="fa fa-list" url="/admin">列表</pvc-button>
            </el-form-item>
        </el-card>
    </el-form>
</template>

<script>
    import {mapGetters,mapActions,mapMutations} from "vuex";
    import Definition from "../../store/definition";

    export default {
        name: "pvc-admin-edit",
        data() {
            return {
                roleIds: [],
                permissionIds:[],
                rules: {
                    name: [
                        {required: true, message: '请输入管理员用户名', trigger: 'blur'},
                        {min: 3, max: 30, message: '长度在 3 到 30 个字符', trigger: 'blur'}
                    ],
                    email: [
                        {required: true, message: '请输入邮箱', trigger: 'blur'},
                        {type: 'email', message: '邮箱的格式有误', trigger: 'blur'},
                    ]
                }
            }
        },
        computed: {
            ...mapGetters({loading:Definition.COMMON_GETTER_LOADING}),
            ...mapGetters('admin',{current:Definition.STORE_GETTER_CURRENT}),
            ...mapGetters('role',{allRoles:Definition.STORE_GETTER_LIST,roleQuery:Definition.STORE_GETTER_QUERY}),
            ...mapGetters('permission',{allPermissions:'filtered',permissionQuery:'filteredQuery'}),
            roles() {
                let roleNames = _.map(this.admin.roles,'name');
                _.filter(this.allRoles,item => {
                    return !_.includes(roleNames,item.name);
                });
                return this.allRoles;
            },
            permissions() {
                let permissionNames = _.map(this.admin.permissions,'name');
                _.filter(this.allPermissions,item => {
                    return !_.includes(permissionNames,item.name);
                });
                return this.allPermissions;
            },
            admin: {
                get() {
                    return this.current;
                },
                set(admin) {
                    this.setCurrent(admin);
                }
            }
        },
        methods: {
            ...mapActions('admin',{get:Definition.STORE_ACTION_GET,save: Definition.STORE_ACTION_UPDATE}),
            ...mapActions('role',{getRoles: Definition.STORE_GETTER_LIST}),
            ...mapActions('permission',{getPermissions: 'getFiltered'}),
            ...mapMutations('role',{resetRoles: Definition.STORE_MUTATION_RESET_QUERY}),
            ...mapMutations('permission',{resetPermissions: 'resetFilteredQuery'}),
            onSubmit(event) {
                event.preventDefault();
                this.$refs.form.validate()
                    .then( valid => {
                        if (valid) {
                            this.save(this.admin)
                                .then((admin) => {
                                    this.$router.push('/admin/' + admin.id);
                                })
                        }
                    });

            },
            init() {
                this.get(this.$route.params.id);
                this.resetRoles();
                this.getRoles();
                this.resetPermissions();
                this.getPermissions();
                this.$refs.form.resetFields();
            }
        },
        mounted() {
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