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
                let content = '',
                    button = null;


                self.buttons.forEach(function (buttonData) {
                    if (typeof buttonData.action === 'string') {
                        buttonData.action = self.parseAction(buttonData.action,data);
                    }

                    content += ' ' + self.createButton(buttonData)[0].outerHTML;

                });

                return content;
            };

            this.$parent.addColumn(column);
        },
        methods: {
            addButtonData: function (buttonData) {
                this.buttons.push(buttonData);
            },
            parseAction: function (action,data) {
                let expResult = action.match(/\{.+\}/g);
                if (expResult && expResult.length) {
                    expResult.forEach(function (item) {
                        let value = eval(item.replace('$model','data').replace('{','').replace('}',''));
                        action = action.replace(item,value);
                    });
                }
                return action;
            },
            createButton: function (buttonData) {
                let button = $('<a class="btn bg-color-blueDark txt-color-white"></a>');

                button.attr('href',buttonData.action);
                button.text(' ' + buttonData.title);
                // button.addClass('btn');
                button.addClass('btn-'+buttonData.size);
                // button.addClass('btn-theme');
                // button.addClass('rounded');

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