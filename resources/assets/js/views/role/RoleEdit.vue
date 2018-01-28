<template>
    <el-form :model="role" :rules="rules" label-position="top" ref="form">
        <el-card :header="'#'+role.id+' '+role.name">
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
                        <el-transfer filterable v-model="role.permissionNames" :titles="['可选择','已分配']"
                                     :data="permissions" :props="{key:'name',label:'name'}"/>
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
    import Definition from "../../store/definition";


    export default {
        name: "pvc-role-edit",
        data() {
            return {
                rules: {
                    name: [
                        {required: true, message: '请输入角色名称', trigger: 'blur'},
                        {min: 3, max: 30, message: '长度在 3 到 30 个字符', trigger: 'blur'}
                    ]
                }
            }
        },
        computed: {
            ...mapGetters('role',{current:Definition.STORE_GETTER_CURRENT}),
            ...mapGetters('permission',{allPermissions:'filtered',permissionQuery:'filteredQuery'}),
            permissions() {
                let permissionNames = _.map(this.role.permissions,'name');
                _.filter(this.allPermissions,item => {
                    return !_.includes(permissionNames,item.name);
                });
                return this.allPermissions;
            },
            role: {
                get() {
                    return this.current;
                },
                set(role) {
                    this.setCurrent(role);
                }
            }
        },
        methods: {
            ...mapActions('role',{get: Definition.STORE_ACTION_GET,save: Definition.STORE_ACTION_UPDATE}),
            ...mapActions('permission',{getPermissions: 'getFiltered'}),
            ...mapMutations('permission',{resetPermissions: 'resetFilteredQuery'}),
            onSubmit(event) {
                event.preventDefault();
                this.$refs.form.validate( valid => {
                    if (valid) {
                        this.save(this.role);
                    }
                });
            }
        },
        mounted() {
            this.get(this.$route.params.id);
            this.resetPermissions();
            this.getPermissions(true);
        },
        beforeRouteUpdate (to, from, next) {
            this.get(to.$route.params.id);
            this.resetPermissions();
            this.getPermissions();
            next();
        }
    }
</script>

<style scoped>

</style>