<template>
    <div id="main">
        <el-card :header="'#' + $route.params.id + ' 详细信息'">
            <el-form >
                <el-form-item label="名称">
                    <el-input v-model="role.name" :required="true" readonly/>
                </el-form-item>
                <el-form-item label="显示名称">
                    <el-input v-model="role.display_name" :required="true" readonly/>
                </el-form-item>
                <el-form-item>
                    <pvc-button type="primary" :url="'/role/'+$route.params.id+'/edit'" icon="el-icon-edit" :autofocus="true">修改</pvc-button>
                    <pvc-button type="primary" url="/role" icon="fa fa-list">列表</pvc-button>
                </el-form-item>
            </el-form>
        </el-card>
    </div>
</template>

<script>
    import {mapActions} from "vuex";

    export default {
        name: "pvc-role-show",
        computed: {
            role() {
                return this.$store.getters['role/getById'](this.$route.params.id);
            }
        },
        methods: {
            ...mapActions('role',['get']),

        },
        mounted() {
            this.get(this.$route.params.id);
        },
        beforeRouteUpdate (to, from, next) {
            this.get(this.$route.params.id);
            next();
        }
    }
</script>

<style scoped>

</style>