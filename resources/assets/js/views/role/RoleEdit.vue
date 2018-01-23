<template>
    <el-form v-model="role" :rules="rules" label-position="top">
        <el-card :header="'#'+role.id+' 更新角色的信息'">
            <el-tabs>
                <el-tab-pane label="基本信息">
                    <el-form-item label="名称" prop="name">
                        <el-input v-model="role.name"/>
                    </el-form-item>
                    <el-form-item label="显示名称" prop="display_name">
                        <el-input v-model="role.display_name"/>
                    </el-form-item>

                </el-tab-pane>
                <el-tab-pane label="分配权限" prop="permission">
                    <el-form-item>
                        <el-transfer filterable v-model="permissionIds" :titles="['可选择','已分配']"
                                     :data="permissions" :props="{key:'id',label:'name'}"/>
                    </el-form-item>
                </el-tab-pane>
            </el-tabs>
            <el-form-item>
                <pvc-button type="primary" @click="onSubmit" icon="fa fa-save" :autofocus="true">保存</pvc-button>
                <pvc-button type="primary" icon="fa fa-list" url="/role">列表</pvc-button>
            </el-form-item>
        </el-card>
    </el-form>
</template>

<script>

    import {mapActions,mapMutations,mapGetters} from "vuex";
    import ElTabPane from "element-ui/packages/tabs/src/tab-pane";

    export default {
        components: {ElTabPane},
        name: "pvc-role-edit",
        data() {
            return {
                permissionIds:[],
                rules: {
                    name: [
                        {required: true, message: '请输入角色名称', trigger: 'blur'},
                        {min: 3, max: 30, message: '长度在 3 到 30 个字符', trigger: 'blur'}
                    ]
                }
            }
        },
        computed: {
            ...mapGetters('permission',{allPermissions:'filtered',permissionQuery:'filteredQuery'}),
            permissions() {
                let self = this;
                _.filter(this.allPermissions,item => {
                    return !_.includes(self.permissionIds,item.id);
                });
                return this.allPermissions;
            },
            role() {
                let role = this.$store.getters['role/getById'](this.$route.params.id);
                //获取已分配的permission.id
                if (_.isArray(role.permissions) && role.permissions.length) {
                    this.permissionIds = _.map(role.permissions, 'id');
                }
                return role;
            }
        },
        methods: {
            ...mapActions('role',['get','save']),
            ...mapActions('permission',{getPermissions: 'getFiltered'}),
            ...mapMutations('permission',{resetPermissions: 'resetFilteredQuery'}),

            onSubmit(event) {
                event.preventDefault();
                let self = this;
                this.$refs.form.validate( valid => {
                    this.role.permissionIds = this.permissionIds;
                    if (valid) {
                        self.save(self.role);
                    }
                });
            }
        },
        mounted() {
            this.get(this.$route.params.id);
            this.resetPermissions();
            this.getPermissions();
        },
        beforeRouteUpdate (to, from, next) {
            this.get(this.$route.params.id);
            this.resetPermissions();
            this.getPermissions();
            next();
        }
    }
</script>

<style scoped>

</style>