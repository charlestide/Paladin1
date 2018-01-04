<template>
    <th data-class="phone" class="text-center" :name="name">
        <slot></slot>
    </th>
</template>

<script>
    export default {
        name: "data-column-action",
        props: {
            name: String,
            title: String,
            default: String,
            width: String,
        },
        data() {
            return {
                buttons: []
            };
        },
        mounted: function () {

            let column = {
                data: null,
                name: this.name,
                title: this.title,
                width: this.width,
                defaultContent: ''

            },self=this;

            column.render = function (data, type, full, meta) {
                let content = '';

                self.buttons.forEach(function (buttonData) {
                    let newButtonData = buttonData;

                    if (typeof buttonData.action === 'string') {
                        newButtonData.href = self.parseAction(buttonData.action,full);
                    }

                    content += ' ' + self.createButton(newButtonData)[0].outerHTML;

                });

                return content;
            };

            this.$parent.addColumn(column);
        },
        methods: {
            addButtonData: function (buttonData) {
                this.buttons.push(buttonData);
            },
            parseAction: function (href,data) {
                let expResult = href.match(/\{.+\}/g);

                if (expResult && expResult.length) {
                    expResult.forEach(function (item) {
                        let value = eval(item.replace('$model','data').replace('{','').replace('}',''));
                        href = href.replace(item,value);
                    });
                }

                return href;
            },
            createButton: function (buttonData) {
                let button = $('<a class="btn bg-color-blueDark txt-color-white"></a>');

                button.attr('href',buttonData.href);
                button.text(' ' + buttonData.title);
                button.addClass('btn-'+buttonData.size);

                if (buttonData.icon) {
                    let icon = $('<i class="fa"></i>');
                    icon.addClass('fa-'+buttonData.icon);
                    icon.prependTo(button);
                }

                return button;
            }
        }
    }
</script>

<style scoped>

</style>