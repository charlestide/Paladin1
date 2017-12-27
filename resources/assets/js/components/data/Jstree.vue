<template>
    <div class="jstree">
        <slot />
    </div>
</template>

<script>

    import RemoteLoader from '../../remoteLoader';
    export default {
        name: "pvc-jstree",
        data() {
            return {
                jstreeConfig: {
                    core: {
                        themes: {
                            dots: false
                        },
                        expand_selected_onload: true,
                        multiple: this.multiple
                    },
                    types :{
                        default: {
                            icon: 'fa fa-folder'
                        }
                    },
                    plugins: ['types']
                },
                jstree: null
            };
        },
        props: {
            data: [String,Object],
            multiple: {
                type: Boolean,
                default: false
            }
        },
        mounted: function () {
            let self = this;
            RemoteLoader.loadJs('https://cdn.bootcss.com/jstree/3.3.4/jstree.min.js',function () {
                $(function () {
                    self.jstree = $(self.$el).jstree(self.jstreeConfig);
                    self.jstree.jstree('open_all');
                });
            });
        }
    };
</script>

<style scoped>
    @import "https://cdn.bootcss.com/jstree/3.3.4/themes/default/style.min.css";

    .jstree {
        max-width: 100%;
        overflow: auto;
        padding: 10px;
        display: block;
        border: 1px solid #DDD;
    }
</style>