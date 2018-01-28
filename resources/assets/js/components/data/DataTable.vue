<template>
    <div class="datatable">
        <el-table :data="list" v-bind="$attrs" :stripe="stripe" v-loading="loading" @sort-change="handleSort" ref="el_table">
            <slot/>
        </el-table>
        <tr role="searchBar">
            <th v-for="(column,index) in columns" :key="index" >
                <el-input v-model="columns[index].search" :placeholder="'搜索'+column.label" @input.native="searchInput"
                          :name="column.name" v-if="column.searchable">
                    <i slot="prefix" class="el-input__icon el-icon-search" style="margin-left: 5px;"></i>
                </el-input>
            </th>
        </tr>
        <br />
        <p class="text-center lead">
            <el-pagination background layout="prev, pager, next" :current-page.sync="currentPage"
                           :total="total" @current-change="pageChange" :page-size="perPage"/>
        </p>
    </div>
</template>

<script>
    import Definition from "../../store/definition";

    export default {
        name: "pvc-table",
        props: {
            perPage: {
                type: Number,
                default: 20
            },
            searchBar: {
                type: Boolean,
                default: true
            },
            store: {
                type: String,
                required: true
            },
            stripe: {
                type: Boolean,
                default: true
            }
        },
        data() {
            return {
                tableData: null,
                lastSearchInput: 0,
                page: 1,
                searchValue: [],
                columns: []
            }
        },
        computed:  {
            query() {
                return this.$store.getters[this.store + '/' + Definition.STORE_GETTER_QUERY];
            },
            total() {
                return this.$store.getters[this.store + '/' + Definition.STORE_GETTER_TOTAL];
            },
            list() {
                return this.$store.getters[this.store + '/' + Definition.STORE_GETTER_LIST];
            },
            loading() {
                return this.$store.getters[Definition.COMMON_GETTER_LOADING];
            },
            currentPage: {
                get() {
                    return this.$store.getters[this.store + '/' + Definition.STORE_GETTER_PAGE];
                },
                set(value) {
                    this.$store.commit(this.store + '/' + Definition.STORE_MUTATION_SET_PAGE,value);
                }
            }
        },
        methods: {
            loadList() {
                this.$store.dispatch(this.store+'/' + Definition.STORE_ACTION_LIST)
                    .then(this.applyAlign);
            },

            handleSort({ column, prop, order }) {
                this.query.addSort(prop,order);
                this.loadList(this.currentPage);
                return false;
            },
            renderSearchBar() {
                if (this.columns.length) {
                    let searchableColumns = _.filter(this.columns,{searchable: true});
                    this.searchValue = new Array(searchableColumns.length);
                    this.$el.querySelector('thead').appendChild(
                        this.$el.querySelector('[role=searchBar]')
                    );
                }
            },
            pageChange() {
                this.loadList();
            },

            applyAlign() {
                let nodeList = null;
                _.each(this.columns,(column,index) => {
                    if (column.align !== 'left') {
                        nodeList = this.$el.querySelectorAll('td.el-table_1_column_' + (index + 1));
                        if (nodeList && nodeList.length) {
                            Array.prototype.forEach.call(nodeList,(td) => {
                                td.classList.add('text-'+column.align);
                            })
                        }
                    }
                });
            },
            /**
             * 启动搜索的延迟函数
             */
            search: _.debounce((value,name,self) => {
                if (value) {
                    self.query.addSearch(name, value);
                } else {
                    self.query.removeSearch(name);
                }

                self.loadList();
            },500),

            /**
             * 给子组件调用的，用于通知自己，有新的列加入
             * @param column
             */
            addColumn(column) {
                this.columns.push(column);
            },

            searchInput(event) {
                let value = event.target.value,
                    name = event.target.name;
                    this.search(value,name,this);
            }

        },
        created() {
            this.loadList();
        },
        mounted: function () {
            this.renderSearchBar();
            this.$nextTick(this.applyAlign);
        },
        beforeRouteUpdate (to, from, next) {
            this.loadList();
            next();
        }
    }
</script>

<style scoped lang="scss">
    @import "../../../sass/global/_variable.scss";

    .theme-head {
        background: $primary-color-bg;
    }
</style>