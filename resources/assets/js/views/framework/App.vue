<template>
    <el-container>
        <pvc-aside ></pvc-aside>
        <el-container>
            <pvc-header></pvc-header>
            <pvc-bread-crumb></pvc-bread-crumb>
            <el-main>
                <router-view></router-view>
            </el-main>
            <el-footer id="footer" height="50px">
                <div class="float-left" >
                    2014 - {{thisYear}} <b class="text-primary">©</b> Paladin Admin. Created by
                    <a href="mailto:charlestide@vip.163.com"><i>Charlestide.Tide</i></a>
                </div>
                <div class="float-right" >
                    {{(new Date()).toDateString()}}
                </div>
            </el-footer>
        </el-container>
    </el-container>
</template>
<script>
    export default {
        name: "pvc-app",
        data() {
            return {
                thisYear: (new Date).getFullYear()
            }
        }
    }
</script>

<style lang="scss">
    @import "../../../sass/global/_variable.scss";

    #footer {
        background: #fff;
        border-style: solid;
        border-color: $main-color-bd;
        border-bottom: 1px;
        border-top: 1px;
        line-height: 50px;
    }

    /*body > .el-container {*/
        /*margin-bottom: 40px;*/
    /*}*/

    /*.el-container:nth-child(5) .el-aside,*/
    /*.el-container:nth-child(6) .el-aside {*/
        /*line-height: 260px;*/
    /*}*/

    /*.el-container:nth-child(7) .el-aside {*/
        /*line-height: 320px;*/
    /*}*/
</style>