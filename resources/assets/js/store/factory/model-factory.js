
import BaseFactory from "./base-factory";
import Store from "../base/store";
import Database from "../database/database";


export default class ModelFactory extends BaseFactory {

    constructor(modelClass, namespace = true) {
        super(namespace);
        this.model = new modelClass;

        this.importCommon();
        Database.registerTable(this.settings.name,this.settings.idKey);

        this.importUrl();
        this.importPrototype();
        this.registerMix(Store);
    }

    importCommon() {
        this.importSettings(this.model,['idKey','name','getter','setter']);
        this.addSetting('idKeyType',this.model.prototype[this.settings.idKey]);
    }

    importPrototype() {
        let define = {_data:{}};
        _.each(this.model.prototype,(type,name) => {
            if (_.includes([String, Boolean, Number, Array, Object, Function],type)) {
                define._data['_' + name] = {
                    get: function () {
                        return type(this._data[name]);
                    },
                    set: function (value) {
                        return this._data[name] = type(value);
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
            create(arg) {
                return Object.assign(Object.create(Object.prototype,this.define),arg);
            }
        };

        this.addState('generator',generator);
        this.addState('empty',generator.create());
    }

    importUrl() {
        for (let name of ['get','create','update','delete','list']) {
            let url = this.model[name + 'Url'];
            url.setVariable(this.settings);
            this.addSetting(name,url.toObject());
        }
    }
}