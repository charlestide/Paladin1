
import PvcFieldLayout from "./FieldLayout";

let _ = require('underscore');

export {layoutMixin,validateMixin,formMixin};

let layoutMixin = {
        components: {
            PvcFieldLayout,
        },
        data() {
            return {
                layoutProps: {
                    layout: this.layout,
                    required: this.required,
                    label: this.label
                }
            }
        },
        props: {
            required: {
                type: Boolean,
                default: false
            },
            layout: {
                type: String,
                default: 'hor',
                validate: function (value) {
                    return value in {hor:'',ver:'',none:''}
                }
            }
        }
    },
    validateMixin = {
        props: {
            remote: String,
            email: Boolean,
            url: Boolean,
            date: Boolean,
            dateISO: Boolean,
            number: Boolean,
            digits: Boolean,
            equalTo: String,
            accept: String,
            creditcard: String,
            extension: String,
            require_from_group: String,
            errormsg: String
        },
        mounted() {
            // $(this.el).validate({
            //
            // });
        }
    },
    formMixin = {
        data() {
            return {
                inputEnabled: this.enabled,
                inputValue: this.value
            }
        },
        props: {
            enabled: {
                type: Boolean,
                default: true
            },
            value: String
        }
    }
;

