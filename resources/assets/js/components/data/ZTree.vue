<template>
    <div class="jstree">
        <slot />
    </div>
</template>

<script>

    import RemoteLoader from '../../remoteLoader';
    export default {
        name: "pvc-ztree",
        data() {
            return {
                fancyConfig: {
                    glyph: {
                        preset: "awesome4",
                        map: {}
                    },
                    extensions: ["glyph"]
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
            RemoteLoader.loadJs([
                'https://cdn.bootcss.com/jqueryui/1.12.1/jquery-ui.min.js',
                'https://cdn.bootcss.com/jquery.fancytree/2.27.0/jquery.fancytree-all-deps.min.js',
            ],function () {
                $(function () {
                    self.jstree = $(self.$el).fancytree();
                    // self.jstree.jstree('open_all');
                });
            });
        }
    };
</script>

<style scoped>
    @import "https://cdn.bootcss.com/jqueryui/1.12.1/jquery-ui.min.css";
    @import "https://cdn.bootcss.com/jquery.fancytree/2.27.0/skin-awesome/ui.fancytree.min.css";

    .jstree {
        max-width: 100%;
        overflow: auto;
        padding: 10px;
        display: block;
        border: 1px solid #DDD;
    }
</style>