<template>
    <li :data-icon="iconClass">{{title}}
        <ul v-if="this.$slots.default">
            <slot />
        </ul>
        <slot name="action"/>
    </li>
</template>

<script>
    import {IconMixin} from '../common/IconMixin';
    export default {
        name: "pvc-tree-node",
        mixins: [IconMixin],
        props: {
            icon: String,
            expanded: {
                type: Boolean,
                default: false
            },
            title: String,
        },
        data() {
            return {
                childNodes: [],
            }
        },
        computed: {
            className() {
                let result = '';

                if (this.icon) {
                    result += ' '+this.iconClass;
                }

                if (this.expanded) {
                    result += ' '+this.expanded;
                }
            },
            columns() {
                return this.$parent.columns;
            }
        },
        mounted() {
            if (_.has(this.$parent,'addChild') && _.isFunction(this.$parent.addChild)) {
                let node = {
                    title: this.title,
                    icon: this.iconClass,
                    expanded: this.expanded,
                    children: this.childNodes
                },
                self = this,
                el = $(self.$el);

                //将其余添加在<pvc-tree-node>上的属性，增加到node对象中，一起传给父组件
                if (!_.isEmpty(this.$parent.columns)) {
                    this.$parent.columns.forEach(function (column) {
                        let attr = el.attr(column.key);
                        if (attr) {
                            node[column.key] = attr;
                        }
                    });
                }

                if (this.$slots.action) {
                    let actionSlot = this.$slots.action;
                    node.$action = [];
                    for(let i=0; i < actionSlot.length; i++) {
                        node.$action.push({
                            el: actionSlot[i].elm,
                            column: actionSlot[i].elm.attributes.column ? $(actionSlot[i].elm).attr('column') : 0
                        });
                    }

                    console.log(this.title,node);
                }

                this.$parent.addChild(node);
            }
        },
        methods: {
            addChild(child) {
                if (_.isObject(child) && !_.isEmpty(child)) {
                    this.childNodes.push(child);
                }
            }
        }
    }
</script>

<style scoped>

</style>