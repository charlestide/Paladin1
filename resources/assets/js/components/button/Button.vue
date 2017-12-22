<template>
    <button class="btn rounded" :class="['btn-'+size,'input-group-'+size]" data-container="body">
        <i v-if="icon" class="fa" :class="['fa-'+icon]"></i> {{title}}
    </button>
</template>

<script>
    export default {
        name: "pvc-button",
        props: {
            action: [Function,String],
            size: {
                type: String,
                default: "xs",
                validator: function (value) {
                    return value in {lg:'',sm:'',xs:''};
                }
            },
            target: {
                type: String,
                default: '_self',
                validator: function (value) {
                    return value in {_self:'',_blank:''};
                }
            },
            url: String,
            title: String,
            icon: String,
        },
        mounted: function () {
            if (this.$parent.addButtonData) {
                let button = {
                    target: this.target,
                    action: this.action,
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