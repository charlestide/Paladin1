
import PvcFieldLayout from "./FieldLayout";

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
        data() {
            return {
                validationProps: {
                    remote: this.remote,
                    email: this.email,
                    url: this.url,
                    date: this.date,
                    dateISO: this.dateISO,
                    number: this.number,
                    digits: this.digits,
                    equalTo: this.equalTo,
                    accept: this.accept,
                    creditcard: this.creditcard,
                    extension: this.extension,
                    require_from_group: this.require_from_group
                }
            }
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

