<template>
    <el-header id="breadcrump" height="50px">
        <div class="float-left title-wrapper">
            <i v-if="mainPage.icon" :class="[iconClass,'icon']"></i>
            <span class="title">{{mainPage.title}}</span>
            <i class="summary text-muted">{{mainPage.summary}}</i>
        </div>
        <div class="float-right">
            <el-breadcrumb separator-class="el-icon-arrow-right" class="breadcrumb-wrapper float-right">
                <el-breadcrumb-item v-for="(breadcrumb,index) in mainPage.breadcrumb" :key="index" :to="breadcrumb.to">
                    {{breadcrumb.title}}
                </el-breadcrumb-item>
            </el-breadcrumb>
            <i class="float-right">您在这里：</i>
        </div>
    </el-header>
</template>

<script>
    import {mapGetters} from "vuex";

    export default {
        name: "pvc-bread-crumb",
        computed: {
            ...mapGetters('layout',['mainPage']),
            iconClass: function () {
                if (this.mainPage.icon.indexOf('as-') === 0) {
                    return "as " + this.mainPage.icon;
                } else if (this.mainPage.icon.indexOf('el-') === 0) {
                    return this.mainPage.icon;
                } else {
                    return "fa fa-" + this.mainPage.icon;
                }
            }
        }
    }
</script>

<style scoped lang="scss">
    @import "../../../sass/global/_variable.scss";

    #breadcrump {
        padding: 0;
        border-bottom: 1px solid;
        border-bottom-color: $main-color-bd;
        background: $white;

        line-height: 50px;
        height: 50px;

        .title-wrapper {

            margin-left: 10px;

            .icon {
                font-size: 22px;
                border-right: 1px dotted  $main-color-bd;
            }

            .title {
                font-size: 18px;
                font-weight: bold;
            }

            .summary {
                font-size: $main-font-size;
            }
        }
    }

    .breadcrumb-wrapper {
        height: 50px;
        line-height: 50px;
        margin-right: 20px;
    }

</style>