<template>
    <div class="fancytree fancytree-colorize-hover">
        <ul v-if="!this.table && this.$slots.default" style="display: none">
            <slot/>
        </ul>
        <table v-else-if="this.table" class="table table-theme">
            <thead>
                <tr>
                    <th v-for="column in this.columns">
                        {{column.title}}
                    </th>
                </tr>
            </thead>
            <tbody>
                <slot/>
            </tbody>
        </table>
    </div>
</template>

<script>
    import RemoteLoader from '../../remoteLoader';

    let _ = require('underscore');

    let defaultFancyConfig = {
        glyph: {
            preset: "bootstrap3",
            map: {}
        },
        selectMode: 1,
        toggleEffect: null,//{ effect: "drop", options: {direction: "left"}, duration: 400 },
        wide: {
            iconWidth: "1em",       // Adjust this if @fancy-icon-width != "16px"
            iconSpacing: "0.5em",   // Adjust this if @fancy-icon-spacing != "3px"
            labelSpacing: "0.1em",  // Adjust this if padding between icon and label != "3px"
            levelOfs: "1.5em"       // Adjust this if ul padding != "16px"
        },
        activeVisible: true,
        // autoCollapse: true,
        extensions: ["glyph","wide"],
    };

    export default {
        name: "pvc-fancytree",
        data() {
            return {
                fancy: null,
                childNodes: [],
            };
        },
        props: {
            data: [String,Object],
            multiple: {
                type: Boolean,
                default: false
            },

            /**
             * 是否使用table样式显示
             * 如果是，则可以传入数组或对象，每个元素表示一个列
             *
             *
             *
             * @exsamle
             *
             * 假设有数据：
             * [
             *      {
             *          title: '项目A',
             *          url: 'http://abc.php',
             *      },
             * ]
             *
             *
             * table的值为
             *    {
             *      title: '标题',
             *      url: '链接'
             *    }
             * 表示有2个列，
             *  第1列：其显示名称为 `标题` 值为 `项目A'
             *  第2列：其显示名称为 `链接` 值为 `http://abc.php'
             *
             *  注意！ key为title的列会显示图标和收起图标，如果设置了checkbox则也会在此列上显示复选框
             */
             table: {
                type:[Array,Boolean,Object],
                default: false
            },

            /**
             * 是否显示复选框
             */
            checkbox: {
                type: [Boolean,Number],
                default: false
            }
        },
        computed: {
            fancyConfig() {
                let config = defaultFancyConfig,
                    self = this;

                config.checkbox = this.checkbox;

                //数据
                config.source = this.data ? this.data : this.childNodes;

                //是否启用table模式，即调用table扩展
                if (!_.isEmpty(this.table)) {
                    config.extensions.push('table');

                    config.table = {
                        autofocusInput: true,
                        checkboxColumnIdx: this.checkbox && !_.isBoolean(this.checkbox)? this.checkbox : null
                    };

                    if (this.titleIndex > -1) {
                        config.table.nodeColumnIdx = this.titleIndex;
                    }

                    config.renderColumns = function (event,data) {
                        let node = data.node,
                            $tdList = $(node.tr).find(">td");
                        self.columns.forEach(function (column,index) {
                            if (index !== self.titleIndex) {
                                $tdList.eq(index).text(node.data[column.key]);
                            } else {
                            }
                        });

                        if (_.has(node.data,'$action')) {
                            node.data.$action.forEach(function (action) {
                                let columnIndex = action.column;
                                if (columnIndex >= 0 && columnIndex < self.columns.length) {
                                    $tdList.eq(columnIndex).append($('<span> </span>'));
                                    $tdList.eq(columnIndex).append($(action.el));
                                }
                            });
                        }
                    }
                }

                return config;
            },
            columns() {
                if (_.isArray(this.table)) {
                    let columns = [];
                    this.table.forEach(function (column) {
                        if (_.isObject(column)) {
                            columns.push({
                                title: column.title,
                                key: column.key
                            });
                        } else if (_.isString(column)) {
                            columns.push({
                                title: column,
                                key: column
                            })
                        }
                    });
                    return columns;
                } else {
                    return [];
                }
            },
            titleIndex() {
                if (_.isArray(this.table)) {
                    return _.findIndex(this.table,function (column) {
                        if (_.isObject(column)) {
                            return 'title' === column.key;
                        } else {
                            return 'title' === column;
                        }
                    })
                } else {
                    return 0;
                }
            }
        },
        mounted: function () {
            let self = this;
            RemoteLoader.loadJs([
                'https://cdn.bootcss.com/jqueryui/1.12.1/jquery-ui.min.js',
                'https://cdn.bootcss.com/jquery.fancytree/2.27.0/jquery.fancytree-all-deps.min.js',
            ],function () {
                $(function () {
                    if (self.table) {
                        self.fancy = $('table',self.$el).fancytree(self.fancyConfig);
                    } else {
                        self.fancy = $(self.$el).fancytree(self.fancyConfig);
                    }
                });
            });
        },
        methods: {
            addChild(child) {
                if (_.isObject(child) && !_.isEmpty(child)) {
                    this.childNodes.push(child);
                }
            }
        }
    };
</script>

<style scoped>
    @import "/paladin/js/3rd/fancytree/ui.fancytree.css";
</style>