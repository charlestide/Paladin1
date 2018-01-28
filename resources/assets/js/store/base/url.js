

export default class Url {

    constructor(url,method = 'get', error = '无法获得数据',variable = {}) {
        if (_.isObject(url)) {
            this.set(url);
        } else {
            this.set({
                url,
                method,
                error,
                variable
            })
        }
    }

    set({url,method,error,variable}) {
        this._url = url;
        this.method = this.validateMethod(method);
        this.error = this.validateError(error);
        this.setVariable(variable);
    }

    get url() {
        let url = this._url;
        _.each(this.variable,(value,key) => {
            url = url.replace(':' + key,value);
        });
        return url;
    }

    setVariable(variable) {
        if (_.isObject(variable)) {
            this.variable = variable;
        } else {
            throw 'variable must be an object';
        }
    }

    validateMethod(method) {
        if (_.includes(['get','post','put','patch','delete'],method)) {
            return method;
        } else {
            throw 'method is invalid';
        }
    }

    validateError(error) {
        return error ? error : '无法获得数据';
    }

    toObject() {
        return {
            url: this.url,
            method: this.method,
            error: this.error
        }
    }

}