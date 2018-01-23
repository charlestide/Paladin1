

class TableQuery {

    constructor(perPage) {
        this.columns = {};
        this.perPage = perPage;
    }

    getQuery(page = 1) {
        return {
            page: page,
            perPage: this.perPage,
            _: Math.random(),
            columns: this.columns
        };
    }

    setPerPage(perPage) {
        this.perPage = perPage;
    }

    addSearch(name, value) {
        _.set(this.columns, name + '.search', value);
    }

    addExcept(name,value) {
        _.set(this.columns,name+'.except',value);
    }

    removeSearch(name) {
        _.unset(this.columns,name + '.search');
    }

    addSort(name, dir) {
        _.set(this.columns, name + '.order', dir.substr(0, 4));
    }
}

export default TableQuery;