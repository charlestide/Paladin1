<template>
    <div id="main">
        <el-card>
            <div slot="header">
                <div class="float-left">
                    <p>
                        #{{$route.params.id}} <b>{{admin.name}}</b>
                        <small><i class="fa fa-envelope"></i> <i>{{admin.email}}</i></small>
                    </p>
                </div>
                <div class="float-right">
                    <i class="el-icon-time"></i> {{admin.updated_at}}
                </div>
                <br/>
            </div>
            <el-row>
                <el-col :span="12">
                    <div style="min-height: 300px">
                        <h5>属于以下角色：</h5>
                        <ul v-if="admin.roles">
                           <li v-for="role in admin.roles">{{role.name}}</li>
                        </ul>
                    </div>
                </el-col>
                <el-col :span="12">
                    <div style="min-height: 50%">
                        <h5>拥有以下权限：</h5>
                        <ul v-if="admin.permissions">
                            <li v-for="permission in admin.permissions">{{permission.name}}</li>
                        </ul>
                    </div>
                </el-col>
            </el-row>
            <pvc-button type="primary" :url="'/admin/'+$route.params.id + '/edit'" icon="el-icon-edit" :autofocus="true">修改</pvc-button>
            <pvc-button type="primary" url="/admin" icon="fa fa-list">列表</pvc-button>

        </el-card>
    </div>
</template>

<script>
    import {mapActions} from "vuex";

    export default {
        name: "pvc-admin-show",
        computed: {
            admin() {
                return this.$store.getters['admin/getById'](this.$route.params.id);
            }
        },
        methods: {
            ...mapActions('admin',['get']),
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