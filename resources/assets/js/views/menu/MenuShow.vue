<template>
    <div id="main">
        <el-card header="#">
            <el-form v-model="form" >
                <el-form-item label="用户名">
                    <el-input v-model="form.name" :required="true"/>
                </el-form-item>
                <el-form-item>
                    <el-button type="primary" @click="onEdit" icon="el-icon-edit" :autofocus="true">修改</el-button>
                    <el-button type="primary" @click="onList" icon="el-icon-list">列表</el-button>
                </el-form-item>
            </el-form>
        </el-card>
    </div>
</template>

<script>
    export default {
        name: "pvc-menu-show",
        data() {
            return {
                menu: {}
            }
        },
        props: {
            id: Number
        },
        mounted() {
            this.$axios.get('/menu/'+this.id)
                .then(response => {
                    if (response.data.status) {
                        this.menu = response.data;
                    }
                })
        },
        methods: {
            onEdit() {
                this.$router.push('/menu');
            }
        }
    }
</script>

<style scoped>

</style>