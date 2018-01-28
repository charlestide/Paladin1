<template>
    <div id="main">
        <p class="lead text-right">
            <pvc-button type="primary" icon="el-icon-plus" url="/role/create">添加</pvc-button>
        </p>
        <pvc-table store="role" :process="true" :perPage="perPage">
            <pvc-table-column prop="id" align="center" label="ID"/>
            <pvc-table-column prop="name" :sortable="true" label="名称"/>
            <pvc-table-column prop="display_name" :sortable="true" label="显示名称"/>
            <pvc-table-column prop="updated_at" algin="center" label="更新于"/>
            <el-table-column prop="action" label="操作">
                <template slot-scope="scope">
                    <el-button-group>
                        <pvc-button type="primary" :url="'/role/' + scope.row.id" icon="el-icon-info">详情</pvc-button>
                        <pvc-button type="primary" :url="'/role/'+scope.row.id+'/edit'" icon="el-icon-edit">修改</pvc-button>
                        <pvc-button type="primary" confirm="删除角色是不可恢复的，你真的知道自己在做什么吗？" @click="handlerDelete(scope.$index, scope.row)" icon="el-icon-delete">删除</pvc-button>
                    </el-button-group>
                </template>
            </el-table-column>
        </pvc-table>
    </div>
</template>

<script>
    import {mapGetters,mapActions} from "vuex";
    import Definition from "../../store/definition";

    export default {
        name: "pvc-role-index",
        computed: {
            ...mapGetters('role',{perPage: Definition.STORE_GETTER_PAGE_LENGTH})
        },
        methods: {
            ...mapActions('role',{delete: Definition.STORE_ACTION_DELETE}),
            handlerDelete(index,row) {
                this.delete(row.id);
            }
        }
    }
</script>

<style scoped>

</style>