<template>
    <div id="main">
        <el-card>
            <blockquote class="blockquote" slot="header">
                <em>#{{$route.params.id}}</em> {{permission.name}}
                <footer v-if="permission.description" class="blockquote-footer">{{permission.description}}</footer>
            </blockquote>
            <el-row style="min-height: 300px">
                <el-col :span="12">
                    <h5 class="mb-lg-3">关联的角色：</h5>
                    <ul  class="list-group">
                        <li v-for="role in permission.roles" class="list-group-item w-75">
                            <div class="justify-content-between d-flex ">
                                <p class="title">{{role.display_name}}({{role.name}})</p>
                                <pvc-button type="primary" :url="'/role/'+role.id">查看</pvc-button>
                            </div>
                            <small>{{role.description}}</small>
                        </li>
                    </ul>
                </el-col>
                <el-col :span="12">
                    <h5>关联的管理员：</h5>
                    <ul  class="list-group">
                        <li v-for="admin in permission.admins" class="list-group-item w-75">
                            <div class="justify-content-between d-flex ">
                                <p class="title">{{admin.name}}<{{admin.email}}></p>
                                <pvc-button type="primary" :url="'/admin/'+admin.id">查看</pvc-button>
                            </div>
                            <small>{{admin.description}}</small>
                        </li>
                    </ul>
                </el-col>
            </el-row>
            <pvc-button type="primary" :url="'/permission/'+$route.params.id+'/edit'" icon="el-icon-edit" :autofocus="true">修改</pvc-button>
            <pvc-button type="primary" url="/permission" icon="fa fa-list">列表</pvc-button>
        </el-card>
    </div>
</template>

<script>
    import {mapActions} from "vuex";

    export default {
        name: "pvc-permission-show",
        computed: {
            permission() {
                return this.$store.getters['permission/getById'](this.$route.params.id);
            }
        },
        methods: {
            ...mapActions('permission',['get']),
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