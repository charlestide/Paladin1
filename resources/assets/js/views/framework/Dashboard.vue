<template>
    <div id="main">
        <el-table :data="tableData" v-loading="loading">
            <el-table-column prop="method" label="方法"/>
            <el-table-column prop="uri" label="URI"/>
            <el-table-column prop="name" label="名称"/>
            <el-table-column prop="action" label="动作"/>
            <el-table-column prop="middleware" label="中间件"/>
        </el-table>
        <p class="text-center lead">
            <el-pagination background layout="prev, pager, next" :current-page.sync="currentPage" :total="total"/>
        </p>
    </div>
</template>

<script>
    export default {
        name: "pvc-dashboard",
        data() {
            return {
                tableData: [],
                total: 0,
                currentPage: 1,
                loading: true
            };
        },
        created() {
            this.loading = true;
            this.$axios.get('/dashboard/routes')
                .then(response => {
                    this.tableData = response.data.data;
                    this.total = response.data.recordsTotal;
                    this.loading = false;
                })
        }
    }
</script>

<style scoped>

</style>