<template>
    <a class="btn rounded" :class="['btn-'+size,'input-group-'+size]" data-container="body" :href="href">
        <i v-if="icon" :class="iconClass"></i> {{title}}
    </a>
</template>

<script>
    import {IconMixin} from "../common/IconMixin";

    export default {
        name: "pvc-link-button",
        mixins: [IconMixin],
        props: {
            size: {
                type: String,
                default: "xs",
                validator: function (value) {
                    return value in {lg:'',sm:'',xs:''};
                }
            },
            target: String,
            href: String,
            title: String,
            icon: String,
        },
        mounted: function () {
            if (this.$parent.addButtonData) {
                let button = {
                    target: this.target,
                    action: this.href,
                    title: this.title,
                    size: this.size,
                    icon: this.icon
                };

                this.$parent.addButtonData(button);
            }
        }
    }
</script>

<style scoped>

</style>