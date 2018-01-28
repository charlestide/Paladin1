<template>
    <el-card>
        <div slot="header">
            <div class="float-left">
                <p>
                    #{{$route.params.id}} <b>{{role.name}}</b>
                </p>
            </div>
            <div class="float-right">
                <i class="el-icon-time"></i> {{role.updated_at}}
            </div>
            <br/>
        </div>
        <el-row>
            <el-col :span="12">
                <div style="min-height: 300px">
                    <h5 class="mb-lg-3">拥有的管理员：</h5>
                    <ul  class="list-group">
                        <li v-for="admin in role.admins" class="list-group-item w-75">
                            <div class="justify-content-between d-flex ">
                                <p class="title">{{admin.name}}</p>
                                <pvc-button type="primary" :url="'/admin/'+admin.id">查看</pvc-button>
                            </div>
                            <small>{{admin.description}}</small>
                        </li>
                    </ul>
                </div>
            </el-col>
            <el-col :span="12">
                <div style="min-height: 300px">
                    <h5 class="mb-lg-3">拥有以下权限：</h5>
                    <ul  class="list-group">
                        <li v-for="permission in role.permissions" class="list-group-item w-75">
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
        <pvc-button type="primary" :url="'/role/'+$route.params.id + '/edit'" icon="el-icon-edit" :autofocus="true">修改</pvc-button>
        <pvc-button type="primary" url="/role" icon="fa fa-list">列表</pvc-button>

    </el-card>
</template>

<script>
    import {mapActions,mapGetters} from "vuex";
    import Definition from "../../store/definition";

    export default {
        name: "pvc-role-show",
        computed: {
            ...mapGetters('role',{role:Definition.STORE_GETTER_CURRENT})
        },
        methods: {
            ...mapActions('role',{get: Definition.STORE_ACTION_GET}),
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