<template>
    <!-- Start page header -->
    <div class="header-content">
        <h2>
            <i v-if="icon" :class="iconClass"></i>
             {{title}}
            <span>{{summary}}</span>
        </h2>
        <div class="breadcrumb-wrapper hidden-xs">
            <span class="label">You are here:</span>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="/">Dashboard</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <slot></slot>
            </ol>
        </div><!-- /.breadcrumb-wrapper -->
    </div><!-- /.header-content -->
    <!--/ End page header -->
</template>

<script>
    export default {
        name: "pvc-bread-crumb",
        props: {
            icon: String,
            title: String,
            summary: String
        },
        computed: {
            iconClass: function () {
                if (this.icon.indexOf('as-') === 0) {
                    return "as " + this.icon;
                } else {
                    return "fa fa-" + this.icon;
                }
            }
        }
    }
</script>

<style scoped>

</style>