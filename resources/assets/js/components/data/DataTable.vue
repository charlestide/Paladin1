<template>
    <div class="datatable">
        <el-table :data="list" v-bind="$attrs" :stripe="stripe" v-loading="loading" @sort-change="handleSort" ref="el_table">
            <slot/>
        </el-table>
        <tr role="searchBar">
            <th v-for="(column,index) in columns" :key="index" v-if="column.searchable">
                <el-input v-model="columns[index].search" :placeholder="'搜索'+column.label" @input="searchInput" >
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
    export default {
        name: "pvc-datatable",
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
                query: null,
                searchValue: [],
                columns: []
            }
        },
        computed:  {
            total() {
                return this.$store.getters[this.store + '/total'];
            },
            list() {
                return this.$store.getters[this.store + '/list'];
            },
            loading() {
                return this.$store.getters[this.store + '/loading'];
            },
            currentPage: {
                get() {
                    return this.$store.getters[this.store + '/currentPage'];
                },
                set(value) {
                    this.$store.commit(this.store + '/setCurrentPage',value);
                }
            }
        },
        methods: {
            loadList() {
                this.$store.dispatch(this.store+'/getList');
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

            searchInput(value) {
                let inputColumns = _.filter(this.columns,{search:value});
                for (let inputColumn of inputColumns) {
                    this.search(value,inputColumn.name,this);
                }
            }

        },
        created() {
            this.loadList();
            this.query = this.$store.getters[this.store + '/query'];
        },
        mounted: function () {
            this.renderSearchBar();
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