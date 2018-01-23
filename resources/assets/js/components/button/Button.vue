<template>
    <el-button @click="handlerClick" v-bind="$attrs">
        <slot/>
    </el-button>
</template>

<script>

    export default {
        name: "pvc-button",
        props: {
            url: {
                type: String,
                default: ''
            },
            newPage: {
                type: Boolean,
                default: false
            },
            confirm: {
                type: String
            }
        },
        methods: {
            doClick: function (event) {
                if (this.url) {
                    this.$router.push(this.url);
                }
                this.$emit('click',event);
            },
            handlerClick(event) {
                if (this.confirm) {
                    this.showConfirm(event);
                } else {
                    this.doClick(event);
                }
            },
            showConfirm(event) {
                let self = this,
                    message = this.confirm;

                this.$confirm(
                    message ? message :'一般出现此对话框表示此操作不可还原，请谨慎选择',
                    '提示', {
                        confirmButtonText: '确定',
                        cancelButtonText: '取消',
                        type: 'warning'
                    }).then(() => {
                        self.doClick(event);
                }).catch(error => {
                    return error;
                });

            }
        }
    }
</script>

<style>
    .el-button [class*=fa-]+span {
        margin-left: 5px;
    }
</style>