
let _ = require('underscore');

export default  {
    install(Vue, options) {

        Vue.mixin({
            data() {
                return {
                    parentByName: {},
                    parentByType: {},
                    pvcName: 'pvcName',
                    pvcType: 'pvc'
                };
            },
            methods: {
                getParentByName(name) {
                    if (name) {

                        if (_.has(this.parentByName, name)) {
                            return this.parentByName[name];
                        }

                        let parent = this.$parent;
                        while (parent) {
                            if (_.isArray(parent.pvcName)) {
                                if (_.contains(parent.pvcName,name)) {
                                    break;
                                }
                            } else {
                                if (parent.pvcName === name) {
                                    break;
                                }
                            }
                            parent = parent.$parent;
                        }
                        return parent;
                    } else {
                        return this.$parent;
                    }
                },
                getParentByType(type) {
                    if (type) {
                        if (_.has(this.parentByType, type)) {
                            return this.parentByType[type];
                        }

                        let parent = this.$parent;
                        while (parent) {
                            if (_.isArray(parent.pvcType)) {
                                if (_.contains(parent.pvcType,type)) {
                                    break;
                                }
                            } else {
                                if (parent.pvcType === type) {
                                    break;
                                }
                            }
                            parent = parent.$parent;
                        }
                        return parent;
                    } else {
                        return this.$parent;
                    }
                },
                getParentAttribute(name,attr,isType) {
                    let parent = isType ? this.getParentByType(name) : this.getParentByName(name);

                    if (parent && _.has(parent.$data,attr)) {
                        return parent[attr];
                    }

                    if (parent && _.has(parent.$props,attr)) {
                        return parent[attr];
                    }



                    return null;
                }
            }
        });
    }
};
