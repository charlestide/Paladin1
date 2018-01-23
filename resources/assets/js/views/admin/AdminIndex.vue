<template>
    <div id="main">
        <p class="lead text-right">
            <pvc-button type="primary" icon="el-icon-plus" url="/admin/create">添加</pvc-button>
        </p>
        <pvc-datatable store="admin" :process="true" :perPage="perPage">
            <el-table-column prop="id" header-align="center" label="ID" :search-bar="true"/>
            <el-table-column prop="name" :sortable="true" label="名称"/>
            <el-table-column prop="email" label="Email"/>
            <el-table-column prop="updated_at" label="更新于"/>
            <el-table-column prop="action" label="操作">
                <template slot-scope="scope">
                    <el-button-group>
                        <pvc-button type="primary" :url="'/admin/' + scope.row.id" icon="el-icon-info">详情</pvc-button>
                        <pvc-button type="primary" :url="'/admin/'+scope.row.id+'/edit'" icon="el-icon-edit">修改</pvc-button>
                        <pvc-button type="primary" confirm="删除管理员是不可恢复的，你真的知道自己在做什么吗？"
                                    @click="handlerDelete(scope.$index, scope.row)" icon="el-icon-delete">删除</pvc-button>
                    </el-button-group>
                </template>
            </el-table-column>
        </pvc-datatable>
    </div>
</template>

<script>
    import {mapGetters,mapActions} from "vuex";

    export default {
        name: "pvc-admin-index",
        computed: {
            ...mapGetters('admin',['perPage']),
        },
        methods: {
            ...mapActions('admin',['delete']),
            handlerDelete(index,row) {
                this.delete(row.id);
            }
        }
    }
</script>

<style scoped>

</style>