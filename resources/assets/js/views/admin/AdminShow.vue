<template>
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
                        <h5 class="mb-lg-3">属于以下角色：</h5>
                        <ul  class="list-group">
                            <li v-for="role in admin.roles" class="list-group-item w-75">
                                <div class="justify-content-between d-flex ">
                                    <p class="title">{{role.name}}</p>
                                    <pvc-button type="primary" :url="'/role/'+role.id">查看</pvc-button>
                                </div>
                                <small>{{role.description}}</small>
                            </li>
                        </ul>
                    </div>
                </el-col>
                <el-col :span="12">
                    <div style="min-height: 300px">
                        <h5 class="mb-lg-3">拥有以下权限：</h5>
                        <ul  class="list-group">
                            <li v-for="permission in admin.permissions" class="list-group-item w-75">
                                <div class="justify-content-between d-flex ">
                                    <p class="title">{{permission.name}}</p>
                                    <pvc-button type="primary" :url="'/permission/'+permission.id">查看</pvc-button>
                                </div>
                                <small>{{permission.description}}</small>
                            </li>
                        </ul>
                    </div>
                </el-col>
            </el-row>
            <pvc-button type="primary" :url="'/admin/'+$route.params.id + '/edit'" icon="el-icon-edit" :autofocus="true">修改</pvc-button>
            <pvc-button type="primary" url="/admin" icon="fa fa-list">列表</pvc-button>

        </el-card>
</template>

<script>
    import {mapActions,mapGetters} from "vuex";

    export default {
        name: "pvc-admin-show",
        computed: {
            ...mapGetters('admin',{admin:'current'})
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