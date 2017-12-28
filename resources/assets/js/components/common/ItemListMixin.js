

export let ItemListMixin = {
    data() {
        return {
            items: []
        }
    },
    mounted() {
        if (_.has(this.$parent,'addItem')) {
            let self = this;

            if (this.label && this.value) {
                this.$parent.addItem({
                    label: this.label,
                    value: this.value
                });
            }

            this.items.forEach(function (item) {
                self.$parent.addItem(item);
            })
        }
    },
    methods: {
        addItem(item) {
            this.items.push(item);
        },
    }
};