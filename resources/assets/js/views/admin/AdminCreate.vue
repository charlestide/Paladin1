<template>
    <el-form :model="admin" :rules="rules" ref="form" :status-icon="true">
        <el-card  v-loading="loading">
            <el-steps slot="header" :active="currentStep+1">
                <el-step title="基本信息" description="填写管理员的基本信息，如名称等" />
                <el-step title="分配角色" description="可以为管理员分配角色，每个角色拥有不同的权限"/>
                <el-step title="分配权限" description="您可以为管理员分配特别的权限"/>
            </el-steps>
            <el-tabs tab-position="right" :value="currentStep.toString()">
                <el-tab-pane label="基本信息" >
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
                    <el-form-item>
                        <el-button type="primary" @click="next()" icon="el-icon-arrow-right"
                                    :autofocus="true">下一步</el-button>
                    </el-form-item>
                </el-tab-pane>
                <el-tab-pane label="分配角色" >
                    <el-form-item>
                        <el-transfer filterable v-model="admin.roleNames" :titles="['可选择','已分配']"
                                     :data="roles" :props="{key:'name',label:'name'}"/>
                    </el-form-item>
                    <el-button type="primary" @click="prev()" icon="el-icon-arrow-left"
                               :autofocus="true">下一步</el-button>
                    <el-button type="primary" @click="next()" icon="el-icon-arrow-right"
                                :autofocus="true">下一步</el-button>
                </el-tab-pane>
                <el-tab-pane label="分配权限" >
                    <el-form-item>
                        <el-transfer filterable v-model="admin.permissionNames" :titles="['可选择','已分配']"
                                     :data="permissions" :props="{key:'name',label:'name'}"/>
                    </el-form-item>
                    <el-form-item>
                        <el-button type="primary" @click="prev()" icon="el-icon-arrow-left"
                                   :autofocus="true">下一步</el-button>
                        <pvc-button type="primary" @click="onSubmit" icon="fa fa-save" :autofocus="true">保存</pvc-button>
                        <pvc-button type="primary" icon="fa fa-list" url="/admin">列表</pvc-button>
                    </el-form-item>
                </el-tab-pane>
            </el-tabs>

        </el-card>
    </el-form>
</template>

<script>
    import {mapGetters,mapMutations,mapActions} from "vuex";
    import ElSteps from "element-ui/packages/steps/src/steps";

    export default {
        components: {ElSteps},
        name: "pvc-admin-create",
        data() {
            return {
                roleIds: [],
                permissionIds:[],
                currentStep: 0,
                adminData:null,
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
            ...mapGetters('admin',{empty:'empty'}),
            ...mapGetters('admin',['loading']),
            ...mapGetters('role',{roles:'filtered',roleQuery:'filteredQuery'}),
            ...mapGetters('permission',{permissions:'filtered',permissionQuery:'filteredQuery'}),
            admin: {
                get() {
                    if (!this.adminData) {
                        this.adminData = this.empty;
                    }
                    return this.adminData;
                },
                set(role) {
                    this.adminData = role;
                }
            }
        },
        methods: {
            ...mapActions('admin',['create']),
            ...mapActions('role',{getRoles: 'getFiltered'}),
            ...mapActions('permission',{getPermissions: 'getFiltered'}),
            ...mapMutations('role',{resetRoles: 'resetFilteredQuery'}),
            ...mapMutations('permission',{resetPermissions: 'resetFilteredQuery'}),
            onSubmit(event) {
                event.preventDefault();

                this.$refs.form.validate()
                    .then(valid => {
                        // this.admin.roleIds = this.roleIds;
                        // this.admin.permissionIds = this.permissionIds;
                        //判断验证结果
                        if (valid) {
                            //创建
                            this.create(this.admin)
                                //跳转
                                .then((admin) =>{
                                        this.$router.push('/admin/'+admin.id);
                                    }
                                )
                        } else {
                            this.$notify({
                                title: '检查',
                                message: '填写的信息有问题，请切换标签检查',
                                type: 'warning'
                            });
                        }
                    })

            },
            next() {
                this.currentStep++;
            },
            prev() {
                this.currentStep--;
            }
        },
        mounted() {
            this.resetRoles();
            this.getRoles();
            this.resetPermissions();
            this.getPermissions();
        },
    }
</script>

<style scoped>

</style>