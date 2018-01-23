<template>
    <el-form v-model="admin" :rules="rules" ref="form">
        <el-card :header="'#'+$route.params.id+' 更新管理员的信息'" v-loading="loading">
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
                        <el-transfer filterable v-model="roleIds" :titles="['可选择','已分配']"
                                     :data="roles" :props="{key:'id',label:'name'}"/>
                    </el-form-item>
                </el-tab-pane>
                <el-tab-pane label="分配权限">
                    <el-form-item>
                        <el-transfer filterable v-model="permissionIds" :titles="['可选择','已分配']"
                                     :data="permissions" :props="{key:'id',label:'name'}"/>
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
    import ElTabPane from "element-ui/packages/tabs/src/tab-pane";

    export default {
        components: {ElTabPane},
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
                    ],
                    password: [
                        {required: true, message: '必须输入密码', trigger: 'blur'},
                    ]
                }
            }
        },
        computed: {
            ...mapGetters('admin',['loading']),
            ...mapGetters('role',{allRoles:'filtered',roleQuery:'filteredQuery'}),
            ...mapGetters('permission',{allPermissions:'filtered',permissionQuery:'filteredQuery'}),
            roles() {
                let self = this;
                 _.filter(this.allRoles,item => {
                    return !_.includes(self.roleIds,item.id);
                });
                return this.allRoles;
            },
            permissions() {
                let self = this;
                 _.filter(this.allPermissions,item => {
                    return !_.includes(self.permissionIds,item.id);
                });
                return this.allPermissions;
            },
            admin() {
                let admin = this.$store.getters['admin/getById'](this.$route.params.id);
                //获取已分配的role.id
                if (_.isArray(admin.roles) && admin.roles.length) {
                    this.roleIds = _.map(admin.roles, 'id');
                }
                //获取已分配的permission.id
                if (_.isArray(admin.permissions) && admin.permissions.length) {
                    this.permissionIds = _.map(admin.permissions, 'id');
                }
                return admin;
            }
        },
        methods: {
            ...mapActions('admin',['get','save']),
            ...mapActions('role',{getRoles: 'getFiltered'}),
            ...mapActions('permission',{getPermissions: 'getFiltered'}),
            ...mapMutations('role',{resetRoles: 'resetFilteredQuery'}),
            ...mapMutations('permission',{resetPermissions: 'resetFilteredQuery'}),
            onSubmit(event) {
                event.preventDefault();
                let self = this;
                this.$refs.form.validate( valid => {
                    self.admin.roleIds = this.roleIds;
                    self.admin.permissionIds = this.permissionIds;
                    if (valid) {
                        self.save(self.admin);
                    }
                });

            }
        },
        created() {
            this.get(this.$route.params.id);
            this.resetRoles();
            this.getRoles();
            this.resetPermissions();
            this.getPermissions();
        },
        mounted() {
            this.$refs.form.resetFields();
        },
        beforeRouteUpdate (to, from, next) {
            this.get(this.$route.params.id);
            this.resetRoles();
            this.getRoles();
            this.resetPermissions();
            this.getPermissions();
            next();
        }
    }
</script>

<style scoped>

</style>