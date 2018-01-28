<template>
    <el-card>
        <div slot="header">
            <div class="float-left">
                <p>
                    #{{$route.params.id}} <b>{{permission.name}}</b>
                </p>
            </div>
            <div class="float-right">
                <i class="el-icon-time"></i> {{permission.updated_at}}
            </div>
            <br/>
        </div>
        <el-row>
            <el-col :span="8">
                <div style="min-height: 300px">
                    <h5 class="mb-lg-3">关联的管理员：</h5>
                    <ul  class="list-group">
                        <li v-for="admin in permission.admins" class="list-group-item w-75">
                            <div class="justify-content-between d-flex ">
                                <p class="title">{{admin.name}}</p>
                                <pvc-button type="primary" :url="'/admin/'+admin.id">查看</pvc-button>
                            </div>
                            <small>{{admin.description}}</small>
                        </li>
                    </ul>
                </div>
            </el-col>
            <el-col :span="8">
                <div style="min-height: 300px">
                    <h5 class="mb-lg-3">关联的角色：</h5>
                    <ul  class="list-group">
                        <li v-for="role in permission.roles" class="list-group-item w-75">
                            <div class="justify-content-between d-flex ">
                                <p class="title">{{role.name}}</p>
                                <pvc-button type="primary" :url="'/role/'+role.id">查看</pvc-button>
                            </div>
                            <small>{{role.description}}</small>
                        </li>
                    </ul>
                </div>
            </el-col>
            <el-col :span="8">
                <div style="min-height: 300px">
                    <h5 class="mb-lg-3">关联的权限：</h5>
                    <ul  class="list-group">
                        <li v-for="related in permission.related" class="list-group-item w-75">
                            <div class="justify-content-between d-flex ">
                                <p class="title">{{related.name}}</p>
                                <pvc-button type="primary" :url="'/permission/'+related.id">查看</pvc-button>
                            </div>
                            <small>{{related.description}}</small>
                        </li>
                    </ul>
                </div>
            </el-col>
        </el-row>
        <pvc-button type="primary" :url="'/permission/'+$route.params.id + '/edit'" icon="el-icon-edit" :autofocus="true">修改</pvc-button>
        <pvc-button type="primary" url="/permission" icon="fa fa-list">列表</pvc-button>

    </el-card>
</template>

<script>
    import {mapActions,mapGetters} from "vuex";
    import Definition from "../../store/definition";


    export default {
        name: "pvc-permission-show",
        computed: {
            ...mapGetters('permission',{permission:Definition.STORE_GETTER_CURRENT})

        },
        methods: {
            ...mapActions('permission',{get:Definition.STORE_ACTION_GET}),
        },
        mounted() {
            this.get(this.$route.params.id);

        },
        beforeRouteUpdate (to, from, next) {
            this.get(to.params.id);
            next();
        }
    }
</script>

<style scoped>

</style>