<template>
    <div id="main">
        <p class="lead text-right">
            <pvc-button type="primary" icon="el-icon-plus" url="/menu/create/0">添加</pvc-button>
        </p>
        <el-tree
                :data="menus"
                :props="defaultProps"
                node-key="id"
                default-expand-all
                :expand-on-click-node="false"
                :render-content="renderContent">
        </el-tree>
    </div>
</template>

<script>

    import {mapGetters,mapActions} from "vuex";

    export default {
        name: "pvc-menu-index",
        data() {
            return {
                defaultProps: {
                    label: 'name',
                    children: 'children',
                },
            }
        },
        computed: {
            ...mapGetters('menu',{menus:'tree'}),
        },
        mounted() {
            this.getList();
        },
        beforeRouteUpdate (to, from, next) {
            this.getList();
            next();
        },
        methods: {
            ...mapActions('menu',['getList','delete']),
            renderContent(h, { node, data, store }) {
                return (
                    <span style="flex: 1; display: flex; align-items: center; justify-content: space-between; padding-right: 8px">
                        <span>
                            <el-tooltip content={'点击跳转到 '+data.url}  placement="left">
                                <pvc-button type="plain" url="data.url" icon={'fa fa-'+data.icon} > {node.label} {data.url}</pvc-button>
                            </el-tooltip>
                            <el-tooltip content="点击查看权限 "  placement="right">
                                <pvc-button type="info" url={'/permission/'+data.permission_id} > 权限 {data.permission ? data.permission.name : ''}</pvc-button>
                            </el-tooltip>
                        </span>
                        <span>
                            <el-button-group>
                                <pvc-button  type="primary" icon="el-icon-plus" url={'/menu/create/' + data.id}>添加</pvc-button>
                                <pvc-button style="font-size: 12px;" type="primary" url={'/menu/'+data.id+'/edit'} icon="el-icon-edit">修改</pvc-button>
                                <el-button style="font-size: 12px;" type="primary" icon="el-icon-delete" on-click={ () => this.remove(node, data.id) }>删除</el-button>
                            </el-button-group>
                        </span>
                    </span>
                );
            },
            remove(node,id) {
                this.$confirm(
                    '确定要删除这个菜单吗？',
                    '提示', {
                        confirmButtonText: '确定',
                        cancelButtonText: '取消',
                        type: 'warning'
                    }).then(() => {
                        this.delete(id).then(() => {
                            this.getList();
                        })
                    }).catch(error => {
                        return error;
                    });
            }
        }
    }
</script>

<style>
    .el-tree-node__content {
        height: 50px;
    }
</style>