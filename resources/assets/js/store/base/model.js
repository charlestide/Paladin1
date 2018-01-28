import Url from "./url";
import BaseFactory from "../factory/base-factory";
import Store from "./store";
import Database from "../database/database";


export default class Model extends BaseFactory {

    get prototype() {
        throw exception('must specify Model.prototype');
    }

    get name() {
        throw exception('must specify Model.name');
    }

    get idKey() {
        return 'id';
    }

    get namespace() {
        return false;
    }

    get getUrl() {
        return new Url('/:name/:id');
    }

    get updateUrl() {
        return new Url('/:name/:id','put');
    }

    get createUrl() {
        return new Url('/:name','post');
    }

    get deleteUrl() {
        return new Url('/:name/:id','delete');
    }

    get listUrl() {
        return new Url('/:name');
    }

    get setter() {
        return (item) => item;
    }

    get getter() {
        return (item) => item;
    }

    get restful() {
        return true;
    }

    get init() {
        return () => {}
    }

    constructor(namespace = true) {
        super(namespace);

        this.importCommon();
        Database.registerTable(this.name,this.idKey);

        this.importUrl();
        this.importPrototype();
        this.registerMix(Store);
    }

    importCommon() {
        this.importSettings(['idKey','name','getter','setter']);
        this.addSetting('idKeyType',this.prototype[this.idKey]);
    }

    importPrototype() {
        let defineData = {},
            define = {};
        _.each(this.prototype,(type,name) => {
            if (_.includes([String, Boolean, Number, Array, Object, Function],type)) {
                defineData[name] = type();
                define[name] = {
                    get: function () {
                        return _.isNull(this._data[name]) ? null : type(this._data[name]);
                    },
                    set: function (value) {
                        return this._data[name] = _.isNull(value) ? null : type(value);
                    },
                    enumerable :true
                }
            } else {
                define[name] = Object.assign({
                    enumerable :true
                },type);
            }
        });

        let generator =  {
            define,
            create(items) {
                if (!_.isArray(items)) {
                    items = [items];
                }

                let results = [];
                for (let item of items) {
                    results.push(Object.assign(Object.create({_data:_.clone(defineData)}, this.define), item));
                }

                return results.length > 1 ? results : results[0];
            }
        };

        this.addState('generator',generator);
        this.addState('empty',generator.create());
    }

    importUrl() {
        for (let name of ['get','create','update','delete','list']) {
            let url = this[name + 'Url'];
            url.setVariable(this.settings);
            this.addSetting(name,url.toObject());
        }
    }
}