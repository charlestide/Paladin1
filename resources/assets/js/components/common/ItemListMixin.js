

export let ItemMixin = {
        data() {
            return {
                itemField: []
            }
        },
        mounted() {
            let self = this,
                parent = this.getParentByType('item-list'),
                item = {};

            if (_.has(parent,'addItem')) {
                this.itemField.forEach(function (field) {
                    if (_.has(parent,field)) {
                        item[field] = parent[field];

                    }
                });

                if (!_.isEmpty(item)) {
                    parent.addItem(item);
                }

                this.items.forEach(function (item) {
                    self.$parent.addItem(item);
                })
            }
        },

    },
    ListMixin = {
        data() {
            return {
                items: []
            }
        },
        methods: {
            addItem(item) {
                if (_.isObject(item)) {
                    item = [item];
                }

                if (_.isArray(item)) {
                    let self = this;

                    item.forEach(function (value) {
                        self.item.push(value);
                    })
                }
            },
        },
    }
    ;